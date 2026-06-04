<?php

namespace App\Http\Controllers\Anggota;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $anggotaId = auth()->id();
        
        // Ambil semua Admin, Pimpinan, dan Petugas yang aktif
        $allStaff = User::whereIn('role', ['admin', 'pimpinan', 'petugas'])
            ->where('is_active', 1)
            ->get()
            ->map(function($user) use ($anggotaId) {
                // Cek apakah ada pesan terakhir
                $lastMessage = Chat::between($anggotaId, $user->id)
                    ->latest()
                    ->first();
                
                // Hitung pesan yang belum dibaca dari user ini
                $unreadCount = Chat::where('pengirim_id', $user->id)
                    ->where('penerima_id', $anggotaId)
                    ->unread()
                    ->count();
                
                $user->last_message = $lastMessage;
                $user->unread_count = $unreadCount;
                $user->has_conversation = $lastMessage ? true : false;
                
                return $user;
            })
            ->sortByDesc(function($user) {
                // Urutkan: yang punya pesan terakhir di atas, lalu yang belum pernah chat
                if ($user->last_message) {
                    return $user->last_message->created_at->timestamp;
                }
                return 0; // User yang belum pernah chat di bawah
            });
        
        // Total pesan belum dibaca
        $totalUnread = Chat::where('penerima_id', $anggotaId)
            ->unread()
            ->count();
        
        return view('anggota.chat.index', compact('allStaff', 'totalUnread'));
    }

    public function show($userId)
    {
        $anggotaId = auth()->id();
        $user = User::findOrFail($userId);
        
        // Ambil semua pesan
        $messages = Chat::between($anggotaId, $userId)
            ->with(['pengirim', 'penerima'])
            ->orderBy('created_at', 'asc')
            ->get();
        
        // Tandai sebagai sudah dibaca
        Chat::where('pengirim_id', $userId)
            ->where('penerima_id', $anggotaId)
            ->where('is_read', 0)
            ->update([
                'is_read' => 1,
                'read_at' => now()
            ]);
        
        return response()->json([
            'success' => true,
            'user' => $user,
            'messages' => $messages
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'penerima_id' => 'required|exists:users,id',
            'pesan' => 'required|string',
            'file' => 'nullable|file|max:10240' // 10MB max, semua jenis file
        ]);
        
        $data = [
            'pengirim_id' => auth()->id(),
            'penerima_id' => $request->penerima_id,
            'pesan' => $request->pesan
        ];
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $filePath = $file->store('chat-files', 'public');
            
            $data['file'] = $filePath;
            $data['original_filename'] = $originalName;
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
        
        $fileName = $chat->original_filename ?? basename($chat->file);
        
        return response()->download($filePath, $fileName);
    }

    public function viewFile($id)
    {
        $chat = Chat::findOrFail($id);
        
        if (!$chat->file) {
            abort(404, 'File tidak ditemukan');
        }
        
        $filePath = storage_path('app/public/' . $chat->file);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }
        
        $fileName = $chat->original_filename ?? basename($chat->file);
        $mimeType = mime_content_type($filePath);
        
        return response()->file($filePath, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . $fileName . '"'
        ]);
    }
}
