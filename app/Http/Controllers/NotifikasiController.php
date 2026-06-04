<?php
namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    // API: ambil notifikasi belum dibaca (untuk polling)
    public function unread()
    {
        $notif = Notifikasi::where("user_id", auth()->id())
            ->where("is_read", false)
            ->latest()
            ->take(10)
            ->get();

        return response()->json([
            "count" => $notif->count(),
            "items" => $notif->map(fn($n) => [
                "id"        => $n->id,
                "judul"     => $n->judul,
                "pesan"     => $n->pesan,
                "icon"      => $n->icon,
                "warna"     => $n->warna,
                "url"       => $n->url,
                "tipe"      => $n->tipe,
                "waktu"     => $n->created_at->diffForHumans(),
            ])
        ]);
    }

    // Tandai 1 notifikasi dibaca
    public function read(Notifikasi $notifikasi)
    {
        if($notifikasi->user_id === auth()->id()) {
            $notifikasi->update(["is_read" => true]);
        }
        return response()->json(["ok" => true]);
    }

    // Tandai semua dibaca
    public function readAll()
    {
        Notifikasi::where("user_id", auth()->id())
                  ->where("is_read", false)
                  ->update(["is_read" => true]);
        return response()->json(["ok" => true]);
    }

    // Halaman semua notifikasi
    public function index()
    {
        $notifikasi = Notifikasi::where("user_id", auth()->id())
            ->latest()->paginate(20);
        
        // Hapus semua notifikasi setelah dilihat (otomatis bersih)
        Notifikasi::where("user_id", auth()->id())->delete();
        
        return view("notifikasi.index", compact("notifikasi"));
    }

    // Hapus notifikasi
    public function destroy(Notifikasi $notifikasi)
    {
        if($notifikasi->user_id === auth()->id()) {
            $notifikasi->delete();
            
            // Return JSON untuk AJAX request
            if(request()->wantsJson() || request()->ajax()) {
                return response()->json([
                    "ok" => true,
                    "message" => "Notifikasi berhasil dihapus"
                ]);
            }
            
            return back()->with("success", "Notifikasi dihapus.");
        }
        
        if(request()->wantsJson() || request()->ajax()) {
            return response()->json([
                "ok" => false,
                "message" => "Unauthorized"
            ], 403);
        }
        
        return back()->with("error", "Tidak dapat menghapus notifikasi.");
    }
    
    // Auto-hide notifikasi yang sudah dibaca lebih dari 5 menit
    public function autoHide(Request $request)
    {
        $userId = $request->user_id ?? auth()->id();
        
        // Hapus notifikasi yang sudah dibaca lebih dari 5 menit
        $deleted = Notifikasi::where("user_id", $userId)
            ->where("is_read", true)
            ->where("updated_at", "<", now()->subMinutes(5))
            ->delete();
        
        return response()->json([
            "ok" => true,
            "hidden_count" => $deleted,
            "message" => "Auto-hidden {$deleted} read notifications"
        ]);
    }
    
    // Mark notification as read
    public function markAsRead($id)
    {
        $notifikasi = Notifikasi::where("id", $id)
            ->where("user_id", auth()->id())
            ->first();
        
        if ($notifikasi) {
            $notifikasi->update([
                "is_read" => true,
                "read_at" => now()
            ]);
            
            return response()->json([
                "ok" => true,
                "message" => "Notification marked as read"
            ]);
        }
        
        return response()->json([
            "ok" => false,
            "message" => "Notification not found"
        ], 404);
    }
}