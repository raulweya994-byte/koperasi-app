<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Koperasi;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(["pembuat", "petugas"])->latest("tanggal");
        if ($request->jenis)
            $query->where("jenis", $request->jenis);
        if ($request->status)
            $query->where("status", $request->status);
          $jadwal = $query->paginate(15)->withQueryString();     
                 $petugas = User::where('role','petugas')->get();
        return view("admin.jadwal.index", compact("jadwal", "petugas"));
    }

    public function create()
    {
        $petugas = User::where("role", "petugas")->get();
        $koperasiList = Koperasi::where("status_verifikasi", "terverifikasi")->get();
        return view("admin.jadwal.create", compact("petugas", "koperasiList"));
    }

    public function store(Request $request)
    {
        $request->validate(["judul" => "required|string|max:255", "jenis" => "required", "tanggal" => "required|date", "jam_mulai" => "required"]);
        $jadwal = Jadwal::create([
            "judul" => "$request->judul",
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
        return redirect()->route("admin.jadwal.index")->with("success", "Jadwal berhasil dibuat!");
    }

    public function show(Jadwal $jadwal)
    {
        $jadwal->load(["pembuat", "petugas", "koperasiList"]);
        return view("admin.jadwal.show", compact("jadwal"));
    }

    public function edit(Jadwal $jadwal)
    {
        $petugas = User::where("role", "petugas")->get();
        $koperasiList = Koperasi::where("status_verifikasi", "terverifikasi")->get();
        $jadwal->load("koperasiList");
        return view("admin.jadwal.edit", compact("jadwal", "petugas", "koperasiList"));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
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
        return redirect()->route("admin.jadwal.index")->with("success", "Jadwal berhasil diupdate!");
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->koperasiList()->detach();
        $jadwal->delete();
        return back()->with("success", "Jadwal dihapus.");
    }

    public function updateStatus(Request $request, Jadwal $jadwal)
    {
        $jadwal->update(["status" => $request->status]);
        return back()->with("success", "Status diupdate!");
    }
}