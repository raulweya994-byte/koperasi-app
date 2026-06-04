<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Simpanan;
use App\Models\Anggota;
use Illuminate\Http\Request;

class SimpananController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id'     => 'required|exists:anggotas,id',
            'jenis_simpanan' => 'required|string',
            'jumlah'         => 'required|integer|min:1',
            'tanggal'        => 'required|date',
            'keterangan'     => 'nullable|string',
        ]);

        Simpanan::create($request->only([
            'anggota_id', 'jenis_simpanan', 'jumlah', 'tanggal', 'keterangan'
        ]));

        $anggota = Anggota::find($request->anggota_id);
        $anggota->total_simpanan = Simpanan::where('anggota_id', $anggota->id)->sum('jumlah');
        $anggota->save();

        return redirect()
            ->route('admin.anggota.show', $request->anggota_id)
            ->with('success', 'Simpanan berhasil ditambahkan!');
    }
}
