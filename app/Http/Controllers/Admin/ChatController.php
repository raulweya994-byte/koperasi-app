<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        $adminId = auth()->id();
        
        // Ambil SEMUA user dari semua role (kecuali admin sendiri)
        $users = User::whereIn('role', ['pimpinan', 'petugas', 'koperasi', 'anggota'])
            ->where('id', '!=', $adminId)
            ->where('is_active', 1)
            ->with('anggota')
            ->orderBy('name')
            ->get()
            ->map(function($user) use ($adminId) {
                // Ambil pesan terakhir
                $lastMessage = Chat::where(function($q) use ($user, $adminId) {
                    $q->where('pengirim_id', $adminId)->where('penerima_id', $user->id);
                })->orWhere(function($q) use ($user, $adminId) {
                    $q->where('pengirim_id', $user->id)->where('penerima_id', $adminId);
                })->latest()->first();
                
                // Hitung unread messages
                $unreadCount = Chat::where('pengirim_id', $user->id)
                    ->where('penerima_id', $adminId)
                    ->where('is_read', 0)
                    ->count();
                
                $user->last_message = $lastMessage;
                $user->unread_count = $unreadCount;
                return $user;
            })
            ->sortByDesc(function($user) {
                // Sort: yang ada pesan terakhir di atas, sisanya alphabetical
                return $user->last_message ? $user->last_message->created_at->timestamp : 0;
            });
        
        // Total pesan belum dibaca
        $totalUnread = Chat::where('penerima_id', $adminId)
            ->where('is_read', 0)
            ->count();
        
        return view('admin.chat.index', compact('users', 'totalUnread'));
    }

    public function show($userId)
    {
        $adminId = auth()->id();
        $user = User::with('anggota')->findOrFail($userId);
        
        // Ambil semua pesan antara admin dan user
        $messages = Chat::between($adminId, $userId)
            ->with(['pengirim', 'penerima'])
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Tandai pesan sebagai sudah dibaca
        Chat::where('pengirim_id', $userId)
            ->where('penerima_id', $adminId)
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);
        
        return view('admin.chat.show', compact('user', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penerima_id' => 'required|exists:users,id',
            'pesan' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:5120'
        ]);
        
        $data = [
            'pengirim_id' => auth()->id(),
            'penerima_id' => $request->penerima_id,
            'pesan' => $request->pesan
        ];
        
        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('chat-files', 'public');
        }
        
        $chat = Chat::create($data);
        
        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim',
            'data' => $chat->load(['pengirim', 'penerima'])
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pesan' => 'required|string'
        ]);
        
        $chat = Chat::findOrFail($id);
        
        // Pastikan hanya pengirim yang bisa edit
        if ($chat->pengirim_id != auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk mengedit pesan ini'
            ], 403);
        }
        
        $chat->update([
            'pesan' => $request->pesan
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil diupdate',
            'data' => $chat
        ]);
    }

    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);
        
        // Pastikan hanya pengirim yang bisa hapus
        if ($chat->pengirim_id != auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk menghapus pesan ini'
            ], 403);
        }
        
        // Hapus file jika ada
        if ($chat->file) {
            \Storage::disk('public')->delete($chat->file);
        }
        
        $chat->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus'
        ]);
    }

    public function getMessages($userId)
    {
        $adminId = auth()->id();
        
        $messages = Chat::between($adminId, $userId)
            ->with(['pengirim', 'penerima'])
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Tandai sebagai sudah dibaca
        Chat::where('pengirim_id', $userId)
            ->where('penerima_id', $adminId)
            ->where('is_read', 0)
            ->update([
                'is_read' => 1,
                'read_at' => now()
            ]);
        
        return response()->json([
            'success' => true,
            'data' => $messages
        ]);
    }

    public function searchUsers(Request $request)
    {
        $search = $request->get('q');
        
        $users = User::whereIn('role', ['pimpinan', 'petugas', 'koperasi', 'anggota'])
            ->where('id', '!=', auth()->id())
            ->where(function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
            })
            ->with('anggota')
            ->limit(10)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function downloadFile($id)
    {
        $chat = Chat::findOrFail($id);
        
        if (!$chat->file) {
            abort(404, 'File tidak ditemukan');
        }
        
        $filePath = storage_path('app/public/' . $chat->file);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }
        
        // Get original filename or use a default
        $fileName = basename($chat->file);
        
        return response()->download($filePath, $fileName);
    }
}
