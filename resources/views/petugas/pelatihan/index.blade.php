@extends('layouts.app')
@section('title','Pelatihan')
@section('page-title','Manajemen Pelatihan')
@section('breadcrumb')
    <li class="breadcrumb-item active">Pelatihan</li>
@endsection
@section('content')
@if(session('success'))<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button>{{ session('success') }}</div>@endif
<div class="card card-primary card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-chalkboard-teacher mr-2"></i>Daftar Pelatihan</h3>
        <a href="{{ route('petugas.pelatihan.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus mr-1"></i>Tambah Pelatihan</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead style="background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);">
                <tr>
                    <th style="color: #ffffff !important;">Judul</th>
                    <th style="color: #ffffff !important;">Tanggal</th>
                    <th style="color: #ffffff !important;">Lokasi</th>
                    <th style="color: #ffffff !important;">Kuota</th>
                    <th style="color: #ffffff !important;">Peserta</th>
                    <th style="color: #ffffff !important;">Status</th>
                    <th style="color: #ffffff !important;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($pelatihan as $p)
            <tr>
                <td><strong>{{ $p->judul }}</strong><br><small class="text-muted">{{ $p->penyelenggara }}</small></td>
                <td><small>{{ $p->tanggal_mulai->format('d M Y') }}@if($p->tanggal_selesai) — {{ $p->tanggal_selesai->format('d M Y') }}@endif</small></td>
                <td><small>{{ $p->lokasi }}</small></td>
                <td class="text-center">{{ $p->kuota }}</td>
                <td class="text-center"><span class="badge badge-info">{{ $p->pendaftaran_count }}</span></td>
                <td>
                    <span class="badge badge-{{ $p->status==='aktif'?'success':($p->status==='selesai'?'secondary':'danger') }}">{{ ucfirst($p->status) }}</span>
                </td>
                <td>
                    <a href="{{ route('petugas.pelatihan.peserta', $p) }}" class="btn btn-xs btn-info" title="Peserta"><i class="fas fa-users"></i></a>
                    <a href="{{ route('petugas.pelatihan.edit', $p) }}" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                    <form method="POST" action="{{ route('petugas.pelatihan.destroy', $p) }}" style="display:inline" onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center py-4 text-muted">Belum ada pelatihan</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection