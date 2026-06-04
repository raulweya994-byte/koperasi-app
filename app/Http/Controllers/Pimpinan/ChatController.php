<?php

namespace App\Http\Controllers\Pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // Check permission
        if (!can_view('chat')) {
            return redirect()->route('pimpinan.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk mengakses Chat. Silakan hubungi Admin untuk mendapatkan akses.');
        }

        // Ambil semua user yang bisa chat dengan pimpinan (admin, petugas, koperasi, anggota)
        $users = User::whereIn('role', ['admin', 'petugas', 'koperasi', 'anggota'])
            ->where('id', '!=', Auth::id())
            ->where('is_active', 1)
            ->orderBy('name')
            ->get();

        // Ambil chat terakhir untuk setiap user
        foreach ($users as $user) {
            $user->last_message = Chat::where(function ($q) use ($user) {
                $q->where('pengirim_id', Auth::id())->where('penerima_id', $user->id);
            })->orWhere(function ($q) use ($user) {
                $q->where('pengirim_id', $user->id)->where('penerima_id', Auth::id());
            })->latest()->first();

            // Hitung unread messages
            $user->unread_count = Chat::where('pengirim_id', $user->id)
                ->where('penerima_id', Auth::id())
                ->where('is_read', 0)
                ->count();
        }

        // Sort by last message time
        $users = $users->sortByDesc(function ($user) {
            return $user->last_message ? $user->last_message->created_at : null;
        });

        return view('pimpinan.chat.index', compact('users'));
    }

    public function getMessages($userId)
    {
        $user = User::findOrFail($userId);

        // Ambil semua pesan antara pimpinan dan user
        $messages = Chat::where(function ($q) use ($userId) {
            $q->where('pengirim_id', Auth::id())->where('penerima_id', $userId);
        })->orWhere(function ($q) use ($userId) {
            $q->where('pengirim_id', $userId)->where('penerima_id', Auth::id());
        })->with(['pengirim', 'penerima'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Mark as read
        Chat::where('pengirim_id', $userId)
            ->where('penerima_id', Auth::id())
            ->where('is_read', 0)
            ->update([
                'is_read' => 1,
                'read_at' => now()
            ]);

        return response()->json([
            'success' => true,
            'messages' => $messages,
            'user' => $user
        ]);
    }

    public function send(Request $request)
    {
        // Check permission
        if (!can_create('chat')) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk mengirim pesan.'
            ], 403);
        }

        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string|max:1000'
        ]);

        $chat = Chat::create([
            'pengirim_id' => Auth::id(),
            'penerima_id' => $request->receiver_id,
            'pesan' => $request->message,
            'is_read' => 0
        ]);

        $chat->load(['pengirim', 'penerima']);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dikirim',
            'chat' => $chat
        ]);
    }

    public function update(Request $request, $id)
    {
        // Check permission
        if (!can_edit('chat')) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk mengedit pesan.'
            ], 403);
        }

        $request->validate([
            'message' => 'required|string|max:1000'
        ]);

        $chat = Chat::findOrFail($id);

        // Pastikan hanya pengirim yang bisa edit
        if ($chat->pengirim_id != Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk mengedit pesan ini'
            ], 403);
        }

        $chat->update([
            'pesan' => $request->message
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil diupdate',
            'chat' => $chat
        ]);
    }

    public function delete($id)
    {
        // Check permission
        if (!can_delete('chat')) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus pesan.'
            ], 403);
        }

        $chat = Chat::findOrFail($id);

        // Pastikan hanya pengirim yang bisa hapus
        if ($chat->pengirim_id != Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki akses untuk menghapus pesan ini'
            ], 403);
        }

        $chat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil dihapus'
        ]);
    }
}
