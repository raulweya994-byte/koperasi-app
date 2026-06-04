<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Koperasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    // ── Login ─────────────────────────────────────────────────
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // Cek apakah user aktif
            if (!$user->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda telah dinonaktifkan. Hubungi administrator.'
                ]);
            }

            // Cek status anggota jika role = anggota (HANYA BLOKIR YANG NONAKTIF)
            if ($user->role === 'anggota') {
                $anggota = $user->anggota;
                
                // NONAKTIF - Tidak bisa login
                if ($anggota && $anggota->status === 'Nonaktif') {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Akun anggota Anda sudah tidak aktif. Hubungi administrator untuk informasi lebih lanjut.'
                    ]);
                }
                
                // PENDING, AKTIF, DITOLAK - SEMUA BISA LOGIN
                // Jika ditolak, bisa lengkapi data di dashboard
            }

            $request->session()->regenerate();

            ActivityLog::create([
                'user_id' => $user->id,
                'action' => 'login',
                'module' => 'Auth',
                'description' => $user->name . ' melakukan login',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return redirect()->intended($user->getDashboardRoute());
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        if (auth()->check()) {
            ActivityLog::create([
                'user_id' => auth()->id(),
                'action' => 'logout',
                'module' => 'Auth',
                'description' => auth()->user()->name . ' melakukan logout',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda berhasil logout.');
    }

    // ── Register (untuk KOPERASI) ──────────────────────────────────
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'koperasi',
            'is_active' => true,
        ]);

        // Buat data koperasi dasar
        Koperasi::create([
            'user_id' => $user->id,
            'no_registrasi' => Koperasi::generateNoRegistrasi(),
            'nama_pemilik' => $request->name,
            'nama_usaha' => $request->name . ' - Koperasi',
            'email' => $request->email,
            'kategori' => 'mikro',
            'status_verifikasi' => 'pending',
            'status_usaha' => 'aktif',
        ]);

        Auth::login($user);

        ActivityLog::create([
            'user_id' => $user->id,
            'action' => 'register',
            'module' => 'Auth',
            'description' => $user->name . ' melakukan registrasi akun koperasi',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('koperasi.dashboard')
            ->with('success', 'Pendaftaran berhasil! Silahkan lengkapi data koperasi Anda.');
    }

    // ── Forgot Password ───────────────────────────────────────
    public function showForgotForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'Link reset password telah dikirim ke email Anda.')
            : back()->withErrors(['email' => 'Email tidak ditemukan.']);
    }

    public function showResetForm(Request $request, string $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill(['password' => Hash::make($password)])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('success', 'Password berhasil direset. Silahkan login.')
            : back()->withErrors(['email' => 'Token tidak valid atau sudah kedaluwarsa.']);
    }
}