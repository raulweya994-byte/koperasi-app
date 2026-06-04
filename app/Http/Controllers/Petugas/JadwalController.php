<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Koperasi;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        if (!can_view('jadwal')) {
            return redirect()->route('petugas.dashboard')
                ->with('error', 'Anda tidak memiliki izin untuk melihat jadwal');
        }
        
        $query = Jadwal::with(["pembuat", "petugas"])->latest("tanggal");
        if ($request->jenis)
            $query->where("jenis", $request->jenis);
        if ($request->status)
            $query->where("status", $request->status);
        $jadwal = $query->paginate(15)->withQueryString();     
        $petugas = User::where('role','petugas')->get();
        return view("petugas.jadwal.index", compact("jadwal", "petugas"));
    }

    public function create()
    {
        if (!can_create('jadwal')) {
            return redirect()->route('petugas.jadwal.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat jadwal');
        }
        
        $petugas = User::where("role", "petugas")->get();
        $koperasiList = Koperasi::where("status_verifikasi", "diverifikasi")->get();
        return view("petugas.jadwal.create", compact("petugas", "koperasiList"));
    }

    public function store(Request $request)
    {
        if (!can_create('jadwal')) {
            return redirect()->route('petugas.jadwal.index')
                ->with('error', 'Anda tidak memiliki izin untuk membuat jadwal');
        }
        
        $request->validate(["judul" => "required|string|max:255", "jenis" => "required", "tanggal" => "required|date", "jam_mulai" => "required"]);
        $jadwal = Jadwal::create([
            "judul" => $request->judul,
            "deskripsi" => $request->deskripsi,
            "jenis" => $request->jenis,
            "tanggal" => $request->tanggal,
            "jam_mulai" => $request->jam_mulai,
            "jam_selesai" => $request->jam_selesai,
            "lokasi" => $request->lokasi,
            "status" => $request->status ?? "dijadwalkan",
            "is_publik" => $request->has("is_publik"),
            "catatan" => $request->catatan,
            "created_by" => auth()->id(),
            "petugas_id" => $request->petugas_id,
        ]);
        if ($request->koperasi_ids)
            $jadwal->koperasiList()->attach($request->koperasi_ids);
            
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'module' => 'Jadwal',
            'description' => 'Membuat jadwal: ' . $jadwal->judul,
            'ip_address' => $request->ip(),
        ]);
        
        return redirect()->route("petugas.jadwal.index")->with("success", "Jadwal berhasil dibuat!");
    }

    public function show(Jadwal $jadwal)
    {
        if (!can_view('jadwal')) {
            return redirect()->route('petugas.jadwal.index')
                ->with('error', 'Anda tidak memiliki izin untuk melihat detail jadwal');
        }
        
        $jadwal->load(["pembuat", "petugas", "koperasiList"]);
        return view("petugas.jadwal.show", compact("jadwal"));
    }

    public function edit(Jadwal $jadwal)
    {
        if (!can_edit('jadwal')) {
            return redirect()->route('petugas.jadwal.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit jadwal');
        }
        
        $petugas = User::where("role", "petugas")->get();
        $koperasiList = Koperasi::where("status_verifikasi", "diverifikasi")->get();
        $jadwal->load("koperasiList");
        return view("petugas.jadwal.edit", compact("jadwal", "petugas", "koperasiList"));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        if (!can_edit('jadwal')) {
            return redirect()->route('petugas.jadwal.index')
                ->with('error', 'Anda tidak memiliki izin untuk mengedit jadwal');
        }
        
        $request->validate(["judul" => "required|string|max:255", "jenis" => "required", "tanggal" => "required|date", "jam_mulai" => "required"]);
        $jadwal->update([
            "judul" => $request->judul,
            "deskripsi" => $request->deskripsi,
            "jenis" => $request->jenis,
            "tanggal" => $request->tanggal,
            "jam_mulai" => $request->jam_mulai,
            "jam_selesai" => $request->jam_selesai,
            "lokasi" => $request->lokasi,
            "status" => $request->status,
            "is_publik" => $request->has("is_publik"),
            "catatan" => $request->catatan,
            "petugas_id" => $request->petugas_id,
        ]);
        if ($request->koperasi_ids !== null)
            $jadwal->koperasiList()->sync($request->koperasi_ids ?? []);
            
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'module' => 'Jadwal',
            'description' => 'Mengupdate jadwal: ' . $jadwal->judul,
            'ip_address' => $request->ip(),
        ]);
        
        return redirect()->route("petugas.jadwal.index")->with("success", "Jadwal berhasil diupdate!");
    }

    public function destroy(Jadwal $jadwal)
    {
        if (!can_delete('jadwal')) {
            return redirect()->route('petugas.jadwal.index')
                ->with('error', 'Anda tidak memiliki izin untuk menghapus jadwal');
        }
        
        $judul = $jadwal->judul;
        $jadwal->koperasiList()->detach();
        $jadwal->delete();
        
        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'module' => 'Jadwal',
            'description' => 'Menghapus jadwal: ' . $judul,
            'ip_address' => request()->ip(),
        ]);
        
        return back()->with("success", "Jadwal dihapus.");
    }

    public function updateStatus(Request $request, Jadwal $jadwal)
    {
        $jadwal->update(["status" => $request->status]);
        return back()->with("success", "Status diupdate!");
    }
}
