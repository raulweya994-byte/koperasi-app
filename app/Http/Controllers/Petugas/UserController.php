<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!can_view('user')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat User. Hubungi Administrator untuk mendapatkan akses.');
        }

        $query = User::query();
        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%');
        }
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }
        $users = $query->latest()->paginate(15)->appends($request->query());
        return view('petugas.users.index', compact('users'));
    }

    public function create()
    {
        if (!can_create('user')) {
            return redirect()->route('petugas.user.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat User. Hubungi Administrator untuk mendapatkan akses.');
        }

        return view('petugas.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'required|in:admin,petugas,pimpinan,koperasi',
            'password' => 'required|string|min:8|confirmed',
            'phone'    => 'nullable|string|max:20',
        ]);

        User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'role'      => $request->role,
            'password'  => Hash::make($request->password),
            'phone'     => $request->phone,
            'is_active' => true,
        ]);

        return redirect()->route('petugas.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        if (!can_edit('user')) {
            return redirect()->route('petugas.user.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit User. Hubungi Administrator untuk mendapatkan akses.');
        }

        return view('petugas.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,'.$user->id,
            'role'     => 'required|in:admin,petugas,pimpinan,koperasi',
            'phone'    => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $data = $request->only(['name','email','role','phone']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return redirect()->route('petugas.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    public function toggleActive(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menonaktifkan akun sendiri.');
        }
        $user->update(['is_active' => !$user->is_active]);
        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return back()->with('success', "User berhasil {$status}.");
    }

    public function destroy(User $user)
    {
        if (!can_delete('user')) {
            return redirect()->route('petugas.user.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus User. Hubungi Administrator untuk mendapatkan akses.');
        }

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }
        $user->delete();
        return redirect()->route('petugas.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    public function activityLog(Request $request)
    {
        $query = ActivityLog::with('user');
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }
        if ($request->filled('module')) {
            $query->where('module', $request->module);
        }
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }
        $logs    = $query->latest()->paginate(20)->appends($request->query());
        $users   = User::orderBy('name')->get();
        $modules = ActivityLog::distinct()->pluck('module');
        return view('petugas.users.activity-log', compact('logs', 'users', 'modules'));
    }

    public function activityLogDetail($id)
    {
        $log = ActivityLog::with('user')->findOrFail($id);
        
        return response()->json([
            'id' => $log->id,
            'user_name' => $log->user->name ?? '-',
            'user_role' => $log->user->role ?? '-',
            'action' => $log->action,
            'module' => $log->module,
            'description' => $log->description,
            'ip_address' => $log->ip_address,
            'user_agent' => $log->user_agent,
            'created_at' => $log->created_at->format('d M Y, H:i:s'),
        ]);
    }

    public function activityLogDestroy($id)
    {
        try {
            $log = ActivityLog::findOrFail($id);
            $log->delete();
            
            // Jika request AJAX, return JSON
            if (request()->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Activity log berhasil dihapus.'
                ]);
            }
            
            // Jika bukan AJAX, redirect biasa
            return redirect()->route('petugas.users.activityLog')
                ->with('success', 'Activity log berhasil dihapus.');
                
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menghapus activity log.'
                ], 500);
            }
            
            return redirect()->route('petugas.users.activityLog')
                ->with('error', 'Gagal menghapus activity log.');
        }
    }

    public function profile()
    {
        $user = auth()->user();
        return view('petugas.users.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,'.$user->id,
            'phone'         => 'nullable|string|max:20',
            'password'      => 'nullable|string|min:8|confirmed',
            'profile_photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $data = $request->only(['name','email','phone']);
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($user->profile_photo);
            }
            // Upload foto baru
            $data['profile_photo'] = $request->file('profile_photo')->store('foto_profil','public');
        }
        if ($request->filled('password')) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($request->password);
        }
        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
