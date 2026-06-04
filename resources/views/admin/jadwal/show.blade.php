
@extends("layouts.app")
@section("title","Detail Jadwal")
@section("page-title","Detail Jadwal")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{ route('admin.jadwal.index') }}">Jadwal</a></li>
<li class="breadcrumb-item active">Detail</li>
@endsection
@section("content")
@if(session("success"))
<div class="alert alert-success alert-dismissible fade show">{{ session("success") }}<button type="button" class="close" data-dismiss="alert"><span>&times;</span></button></div>
@endif
<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">{{ $jadwal->judul }}</h3>
                <div>
                    <span class="badge badge-{{ $jadwal->jenis_color }} mr-1">{{ $jadwal->jenis_label }}</span>
                    <span class="badge badge-{{ $jadwal->status_color }}">{{ $jadwal->status_label }}</span>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-6">
                        <small class="text-muted">Tanggal</small>
                        <div class="font-weight-bold">{{ $jadwal->tanggal->format("d F Y") }}</div>
                    </div>
                    <div class="col-6">
                        <small class="text-muted">Waktu</small>
                        <div class="font-weight-bold">{{ substr($jadwal->jam_mulai,0,5) }}{{ $jadwal->jam_selesai ? " - ".substr($jadwal->jam_selesai,0,5) : "" }}</div>
                    </div>
                </div>
                @if($jadwal->lokasi)
                <div class="mb-3">
                    <small class="text-muted">Lokasi</small>
                    <div class="font-weight-bold"><i class="fas fa-map-marker-alt mr-1 text-danger"></i>{{ $jadwal->lokasi }}</div>
                </div>
                @endif
                @if($jadwal->deskripsi)
                <div class="mb-3">
                    <small class="text-muted">Deskripsi</small>
                    <div>{{ $jadwal->deskripsi }}</div>
                </div>
                @endif
                @if($jadwal->catatan)
                <div class="alert alert-light border-left border-warning">
                    <small class="text-muted d-block">Catatan</small>{{ $jadwal->catatan }}
                </div>
                @endif
            </div>
        </div>
        @if($jadwal->koperasiList->count())
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-store mr-2"></i>Koperasi Terlibat ({{ $jadwal->koperasiList->count() }})</h3>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="thead-light"><tr><th>Nama Usaha</th><th>Pemilik</th><th>Status Hadir</th></tr></thead>
                    <tbody>
                    @foreach($jadwal->koperasiList as $u)
                    <tr>
                        <td>{{ $u->nama_usaha }}</td>
                        <td>{{ $u->pemilik }}</td>
                        <td>
                            @php $h = $u->pivot->status_hadir @endphp
                            <span class="badge badge-{{ $h=="hadir"?"success":($h=="tidak_hadir"?"danger":"secondary") }}">
                                {{ $h=="hadir"?"Hadir":($h=="tidak_hadir"?"Tidak Hadir":"Belum") }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-header"><h3 class="card-title">Info & Aksi</h3></div>
            <div class="card-body">
                <div class="mb-2"><small class="text-muted">Dibuat Oleh</small><div class="font-weight-bold">{{ $jadwal->pembuat->name ?? "-" }}</div></div>
                <div class="mb-2"><small class="text-muted">Petugas</small><div class="font-weight-bold">{{ $jadwal->petugas->name ?? "Belum ditugaskan" }}</div></div>
                <div class="mb-3"><small class="text-muted">Visibilitas</small><div>
                    @if($jadwal->is_publik)<span class="badge badge-success">Publik</span>
                    @else<span class="badge badge-secondary">Internal</span>@endif
                </div></div>
                <hr>
                <form action="{{ route('admin.jadwal.updateStatus',$jadwal) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="font-weight-bold">Update Status</label>
                        <select name="status" class="form-control form-control-sm">
                            <option value="dijadwalkan" {{ $jadwal->status=="dijadwalkan"?"selected":"" }}>Dijadwalkan</option>
                            <option value="berlangsung" {{ $jadwal->status=="berlangsung"?"selected":"" }}>Berlangsung</option>
                            <option value="selesai"     {{ $jadwal->status=="selesai"?"selected":"" }}>Selesai</option>
                            <option value="dibatalkan"  {{ $jadwal->status=="dibatalkan"?"selected":"" }}>Dibatalkan</option>
                        </select>
                    </div>
                    <button class="btn btn-sm btn-primary w-100 mb-2">Update Status</button>
                </form>
                <a href="{{ route('admin.jadwal.edit',$jadwal) }}" class="btn btn-warning btn-sm w-100 mb-2"><i class="fas fa-edit mr-1"></i>Edit</a>
                <form action="{{ route('admin.jadwal.destroy',$jadwal) }}" method="POST" onsubmit="return confirm('Hapus?')">
                    @csrf @method("DELETE")
                    <button class="btn btn-danger btn-sm w-100"><i class="fas fa-trash mr-1"></i>Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
