<?php
namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use App\Models\Anggota;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $petugasId = auth()->id();

        // Admin & Pimpinan
        $adminPimpinan = User::whereIn('role', ['admin', 'pimpinan'])
            ->where('is_active', 1)
            ->get()
            ->map(function($user) use ($petugasId) {
                $lastMessage = Chat::between($petugasId, $user->id)->latest()->first();
                $unreadCount = Chat::where('pengirim_id', $user->id)->where('penerima_id', $petugasId)->where('is_read', 0)->count();
                $user->last_message = $lastMessage;
                $user->unread_count = $unreadCount;
                $user->anggota_info = null;
                return $user;
            })
            ->sortByDesc(fn($u) => $u->last_message ? $u->last_message->created_at->timestamp : 0);

        // Semua user koperasi & anggota aktif
        $conversations = User::whereIn('role', ['koperasi', 'anggota'])
            ->where('is_active', 1)
            ->where('id', '!=', $petugasId)
            ->get()
            ->map(function($user) use ($petugasId) {
                $lastMessage = Chat::between($petugasId, $user->id)->latest()->first();
                $unreadCount = Chat::where('pengirim_id', $user->id)->where('penerima_id', $petugasId)->where('is_read', 0)->count();
                $user->last_message = $lastMessage;
                $user->unread_count = $unreadCount;
                $user->has_conversation = $lastMessage ? true : false;
                $user->anggota_info = Anggota::where('user_id', $user->id)->first();
                return $user;
            })
            ->sortByDesc(fn($u) => $u->last_message ? $u->last_message->created_at->timestamp : 0);

        $totalUnread = Chat::where('penerima_id', $petugasId)->where('is_read', 0)->count();

        return view('petugas.chat.index', compact('conversations', 'totalUnread', 'adminPimpinan'));
    }

    public function show($userId)
    {
        $petugasId = auth()->id();
        $user = User::findOrFail($userId);
        $user->anggota_info = Anggota::where('user_id', $userId)->first();

        $messages = Chat::between($petugasId, $userId)
            ->with(['pengirim', 'penerima'])
            ->orderBy('created_at', 'asc')
            ->get();

        Chat::where('pengirim_id', $userId)
            ->where('penerima_id', $petugasId)
            ->where('is_read', 0)
            ->update(['is_read' => 1, 'read_at' => now()]);

        return response()->json(['success' => true, 'user' => $user, 'messages' => $messages]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'penerima_id' => 'required|exists:users,id',
            'pesan' => 'required|string',
            'file' => 'nullable|file|max:10240'
        ]);

        $data = [
            'pengirim_id' => auth()->id(),
            'penerima_id' => $request->penerima_id,
            'pesan' => $request->pesan
        ];

        if ($request->hasFile('file')) {
            $data['file'] = $request->file('file')->store('chat-files', 'public');
            $data['original_filename'] = $request->file('file')->getClientOriginalName();
        }

        $chat = Chat::create($data);

        return response()->json(['success' => true, 'message' => 'Pesan berhasil dikirim', 'data' => $chat->load(['pengirim', 'penerima'])]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['pesan' => 'required|string']);
        $chat = Chat::findOrFail($id);

        if ($chat->pengirim_id != auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        $chat->update(['pesan' => $request->pesan]);
        return response()->json(['success' => true, 'message' => 'Pesan diupdate', 'data' => $chat]);
    }

    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);

        if ($chat->pengirim_id != auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }

        if ($chat->file) \Storage::disk('public')->delete($chat->file);
        $chat->delete();

        return response()->json(['success' => true, 'message' => 'Pesan dihapus']);
    }
}