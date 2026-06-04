@extends('layouts.app')
@section('title', 'Detail Anggota Koperasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px">
                <div class="card-header" style="background:linear-gradient(135deg,#667eea,#764ba2);color:white;border-radius:16px 16px 0 0">
                    <h4 class="mb-0"><i class="fas fa-user-circle mr-2"></i>Detail Anggota Koperasi</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-md-3 text-center mb-4">
                            <img src="{{ $anggotaKoperasi->foto_url }}" class="img-fluid rounded" style="max-width:200px;border:4px solid #e0e6ff;box-shadow:0 4px 15px rgba(0,0,0,0.1)">
                            <h5 class="mt-3 font-weight-bold">{{ $anggotaKoperasi->nama }}</h5>
                            <p class="text-muted mb-2">{{ $anggotaKoperasi->no_anggota }}</p>
                            @if($anggotaKoperasi->status === 'Aktif')
                            <span class="badge badge-success badge-lg">Aktif</span>
                            @elseif($anggotaKoperasi->status === 'Pending')
                            <span class="badge badge-warning badge-lg">Pending</span>
                            @else
                            <span class="badge badge-danger badge-lg">Nonaktif</span>
                            @endif
                        </div>
                        
                        <div class="col-md-9">
                            <h5 class="font-weight-bold mb-3" style="color:#667eea">
                                <i class="fas fa-id-card mr-2"></i>Informasi Pribadi
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="200"><strong>NIK</strong></td>
                                    <td>: {{ $anggotaKoperasi->nik }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat, Tgl Lahir</strong></td>
                                    <td>: {{ $anggotaKoperasi->tempat_lahir }}, {{ $anggotaKoperasi->tanggal_lahir ? $anggotaKoperasi->tanggal_lahir->format('d F Y') : '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jenis Kelamin</strong></td>
                                    <td>: {{ $anggotaKoperasi->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Agama</strong></td>
                                    <td>: {{ $anggotaKoperasi->agama ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Status Perkawinan</strong></td>
                                    <td>: {{ $anggotaKoperasi->status_perkawinan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pendidikan Terakhir</strong></td>
                                    <td>: {{ $anggotaKoperasi->pendidikan_terakhir ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Pekerjaan</strong></td>
                                    <td>: {{ $anggotaKoperasi->pekerjaan ?? '-' }}</td>
                                </tr>
                            </table>
                            
                            <h5 class="font-weight-bold mb-3 mt-4" style="color:#667eea">
                                <i class="fas fa-phone mr-2"></i>Kontak & Alamat
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="200"><strong>No. HP</strong></td>
                                    <td>: {{ $anggotaKoperasi->no_hp }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>: {{ $anggotaKoperasi->email ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Alamat</strong></td>
                                    <td>: {{ $anggotaKoperasi->alamat }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Desa</strong></td>
                                    <td>: {{ $anggotaKoperasi->desa ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Distrik</strong></td>
                                    <td>: {{ $anggotaKoperasi->distrik }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kabupaten</strong></td>
                                    <td>: {{ $anggotaKoperasi->kabupaten ?? 'Tolikara' }}</td>
                                </tr>
                            </table>
                            
                            <h5 class="font-weight-bold mb-3 mt-4" style="color:#667eea">
                                <i class="fas fa-store mr-2"></i>Informasi Koperasi
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="200"><strong>Nama Koperasi</strong></td>
                                    <td>: {{ $anggotaKoperasi->koperasi->nama_usaha ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>No. Registrasi</strong></td>
                                    <td>: {{ $anggotaKoperasi->koperasi->no_registrasi ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Usaha</strong></td>
                                    <td>: {{ $anggotaKoperasi->nama_usaha ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Bidang Usaha</strong></td>
                                    <td>: {{ $anggotaKoperasi->bidang_usaha ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Modal Usaha</strong></td>
                                    <td>: Rp {{ number_format($anggotaKoperasi->modal_usaha ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Omzet Per Bulan</strong></td>
                                    <td>: Rp {{ number_format($anggotaKoperasi->omzet_per_bulan ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                            
                            <h5 class="font-weight-bold mb-3 mt-4" style="color:#667eea">
                                <i class="fas fa-wallet mr-2"></i>Informasi Simpanan
                            </h5>
                            <table class="table table-borderless">
                                <tr>
                                    <td width="200"><strong>Simpanan Pokok</strong></td>
                                    <td>: Rp {{ number_format($anggotaKoperasi->simpanan_pokok ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Simpanan Wajib</strong></td>
                                    <td>: Rp {{ number_format($anggotaKoperasi->simpanan_wajib ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Total Simpanan</strong></td>
                                    <td>: <strong class="text-success">Rp {{ number_format($anggotaKoperasi->total_simpanan ?? 0, 0, ',', '.') }}</strong></td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Bergabung</strong></td>
                                    <td>: {{ $anggotaKoperasi->tanggal_bergabung ? \Carbon\Carbon::parse($anggotaKoperasi->tanggal_bergabung)->format('d F Y') : '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col-12">
                            <a href="{{ route('petugas.anggota-koperasi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            @if(can_edit('anggota'))
                            <a href="{{ route('petugas.anggota-koperasi.edit', $anggotaKoperasi) }}" class="btn btn-warning">
                                <i class="fas fa-edit mr-2"></i>Edit Data
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
