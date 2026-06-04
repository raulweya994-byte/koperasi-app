@extends('layouts.app')
@section('title','Struktur Organisasi')
@section('page-title','Struktur Organisasi')
@section('breadcrumb')
    <li class="breadcrumb-item active">Struktur Organisasi</li>
@endsection
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    {{ session('success') }}
</div>
@endif

<div class="card card-primary card-outline">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="fas fa-sitemap mr-2"></i>Daftar Pegawai per Bidang</h3>
        <a href="{{ route('petugas.struktur.bagan') }}" class="btn btn-info btn-sm mr-2"><i class="fas fa-image mr-1"></i> Upload Bagan</a>
        <a href="{{ route('petugas.struktur.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Tambah Pegawai
        </a>
    </div>
    <div class="card-body">
        @php
        $bidangLabels = [
            'kepala_dinas'=>['label'=>'Kepala Dinas','color'=>'primary','icon'=>'fas fa-user-tie'],
            'sekretariat'=>['label'=>'Sekretariat','color'=>'info','icon'=>'fas fa-building'],
            'perindustrian'=>['label'=>'Bidang Perindustrian','color'=>'danger','icon'=>'fas fa-industry'],
            'perdagangan'=>['label'=>'Bidang Perdagangan','color'=>'success','icon'=>'fas fa-shopping-cart'],
            'koperasi'=>['label'=>'Bidang Koperasi','color'=>'warning','icon'=>'fas fa-handshake'],
            'koperasi'=>['label'=>'Bidang Koperasi','color'=>'secondary','icon'=>'fas fa-store'],
            'uptd'=>['label'=>'UPTD','color'=>'dark','icon'=>'fas fa-network-wired'],
        ];
        @endphp

        @foreach($bidangLabels as $key => $bl)
        @if(isset($data[$key]) && $data[$key]->count() > 0)
        <div class="card card-{{ $bl['color'] }} card-outline mb-3">
            <div class="card-header">
                <h6 class="card-title mb-0"><i class="{{ $bl['icon'] }} mr-2"></i>{{ $bl['label'] }}</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm table-hover mb-0">
                    <thead style="background: linear-gradient(135deg, #34495e 0%, #2c3e50 100%);">
                        <tr>
                            <th width="60" style="color: #ffffff !important;">Foto</th>
                            <th style="color: #ffffff !important;">Nama</th>
                            <th style="color: #ffffff !important;">Jabatan</th>
                            <th style="color: #ffffff !important;">NIP</th>
                            <th width="80" style="color: #ffffff !important;">Urutan</th>
                            <th width="80" style="color: #ffffff !important;">Status</th>
                            <th width="120" style="color: #ffffff !important;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data[$key]->sortBy('urutan') as $s)
                        <tr>
                            <td>
                                <img src="{{ $s->foto ? asset('storage/'.$s->foto) : asset('images/default-avatar.png') }}" class="img-circle" width="35" height="35" style="object-fit:cover;" onerror="this.src='https://ui-avatars.com/api/?name='+encodeURIComponent('{{ $s->nama }}')">
                            </td>
                            <td>
                                <strong>{{ $s->nama ?? '-' }}</strong>
                                @if($s->sub_jabatan)<br><small class="text-muted">{{ $s->sub_jabatan }}</small>@endif
                            </td>
                            <td>{{ $s->jabatan }}</td>
                            <td><small class="text-muted">{{ $s->nip ?? '-' }}</small></td>
                            <td class="text-center">{{ $s->urutan }}</td>
                            <td>
                                @if($s->is_active)
                                <span class="badge badge-success">Aktif</span>
                                @else
                                <span class="badge badge-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('petugas.struktur.edit', $s->id) }}" class="btn btn-xs btn-warning"><i class="fas fa-edit"></i></a>
                                <form method="POST" action="{{ route('petugas.struktur.destroy', $s->id) }}" style="display:inline" onsubmit="return confirm('Hapus?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>

<div class="text-center mt-3">
    <a href="{{ route('public.halaman', 'struktur') }}" target="_blank" class="btn btn-info">
        <i class="fas fa-eye mr-1"></i> Lihat di Publik
    </a>
</div>
@endsection