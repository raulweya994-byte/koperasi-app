<?php
namespace App\Http\Controllers\Koperasi;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Ambil Admin & Petugas untuk dihubungi
        $contacts = User::whereIn('role', ['admin', 'petugas', 'pimpinan'])
            ->where('is_active', 1)
            ->get()
            ->map(function($user) use ($userId) {
                $lastMessage = Chat::between($userId, $user->id)->latest()->first();
                $unreadCount = Chat::where('pengirim_id', $user->id)
                    ->where('penerima_id', $userId)
                    ->where('is_read', 0)->count();
                $user->last_message = $lastMessage;
                $user->unread_count = $unreadCount;
                return $user;
            })
            ->sortByDesc(fn($u) => $u->last_message ? $u->last_message->created_at->timestamp : 0);

        $totalUnread = Chat::where('penerima_id', $userId)->where('is_read', 0)->count();

        return view('koperasi.chat.index', compact('contacts', 'totalUnread'));
    }

    public function show($userId)
    {
        $myId = auth()->id();
        $user = User::findOrFail($userId);

        $messages = Chat::between($myId, $userId)
            ->with(['pengirim', 'penerima'])
            ->orderBy('created_at', 'asc')
            ->get();

        Chat::where('pengirim_id', $userId)
            ->where('penerima_id', $myId)
            ->where('is_read', 0)
            ->update(['is_read' => 1, 'read_at' => now()]);

        return response()->json(['success' => true, 'user' => $user, 'messages' => $messages]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'penerima_id' => 'required|exists:users,id',
            'pesan'       => 'required|string',
        ]);

        $chat = Chat::create([
            'pengirim_id' => auth()->id(),
            'penerima_id' => $request->penerima_id,
            'pesan'       => $request->pesan,
        ]);

        return response()->json(['success' => true, 'data' => $chat->load(['pengirim', 'penerima'])]);
    }

    public function update(Request $request, $id)
    {
        $chat = Chat::findOrFail($id);
        if ($chat->pengirim_id != auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }
        $chat->update(['pesan' => $request->pesan]);
        return response()->json(['success' => true, 'data' => $chat]);
    }

    public function destroy($id)
    {
        $chat = Chat::findOrFail($id);
        if ($chat->pengirim_id != auth()->id()) {
            return response()->json(['success' => false, 'message' => 'Akses ditolak'], 403);
        }
        if ($chat->file) \Storage::disk('public')->delete($chat->file);
        $chat->delete();
        return response()->json(['success' => true]);
    }
}