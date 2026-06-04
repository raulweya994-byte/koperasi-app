@extends('layouts.app')
@section('title','Detail Pelatihan')
@section('page-title','Detail Pelatihan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.pelatihan.index') }}">Pelatihan</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

<div class="row">
    <!-- Informasi Pelatihan -->
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle mr-2"></i>Informasi Pelatihan</h3>
                <div class="card-tools">
                    @if($pelatihan->status === 'dibuka')
                        <span class="badge badge-success badge-lg">Dibuka</span>
                    @elseif($pelatihan->status === 'berlangsung')
                        <span class="badge badge-primary badge-lg">Berlangsung</span>
                    @elseif($pelatihan->status === 'ditutup')
                        <span class="badge badge-warning badge-lg">Ditutup</span>
                    @else
                        <span class="badge badge-secondary badge-lg">Selesai</span>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @if($pelatihan->foto)
                <div class="text-center mb-4">
                    <img src="{{ $pelatihan->foto_url }}" class="img-fluid rounded" style="max-height: 300px;" alt="{{ $pelatihan->judul }}">
                </div>
                @endif

                <h4 class="mb-3">{{ $pelatihan->judul }}</h4>

                <table class="table table-borderless">
                    <tr>
                        <td width="200"><i class="fas fa-building text-primary mr-2"></i><strong>Penyelenggara</strong></td>
                        <td>: {{ $pelatihan->penyelenggara ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar text-primary mr-2"></i><strong>Tanggal Mulai</strong></td>
                        <td>: {{ $pelatihan->tanggal_mulai->format('d F Y') }}</td>
                    </tr>
                    <tr>
                        <td><i class="far fa-calendar-check text-primary mr-2"></i><strong>Tanggal Selesai</strong></td>
                        <td>: {{ $pelatihan->tanggal_selesai ? $pelatihan->tanggal_selesai->format('d F Y') : '-' }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-map-marker-alt text-primary mr-2"></i><strong>Lokasi</strong></td>
                        <td>: {{ $pelatihan->lokasi ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-users text-primary mr-2"></i><strong>Kuota Peserta</strong></td>
                        <td>: {{ $pelatihan->kuota }} orang</td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-user-check text-primary mr-2"></i><strong>Peserta Terdaftar</strong></td>
                        <td>: <span class="badge badge-info">{{ $pelatihan->pendaftaran_count }} orang</span></td>
                    </tr>
                    <tr>
                        <td><i class="fas fa-chart-line text-primary mr-2"></i><strong>Sisa Kuota</strong></td>
                        <td>: <span class="badge badge-{{ $pelatihan->sisa_kuota > 0 ? 'success' : 'danger' }}">{{ $pelatihan->sisa_kuota }} orang</span></td>
                    </tr>
                </table>

                @if($pelatihan->deskripsi)
                <div class="mt-4">
                    <h5><i class="fas fa-align-left text-primary mr-2"></i>Deskripsi</h5>
                    <div class="border-left border-primary pl-3">
                        <p class="text-justify">{{ $pelatihan->deskripsi }}</p>
                    </div>
                </div>
                @endif

                @if($pelatihan->syarat)
                <div class="mt-4">
                    <h5><i class="fas fa-clipboard-list text-primary mr-2"></i>Syarat Peserta</h5>
                    <div class="border-left border-primary pl-3">
                        <p class="text-justify" style="white-space: pre-line;">{{ $pelatihan->syarat }}</p>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-footer">
                <a href="{{ route('admin.pelatihan.edit', $pelatihan) }}" class="btn btn-warning">
                    <i class="fas fa-edit mr-1"></i>Edit Pelatihan
                </a>
                <a href="javascript:history.back()" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i>Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="col-md-4">
        <!-- Statistik -->
        <div class="card card-info card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-chart-pie mr-2"></i>Statistik</h3>
            </div>
            <div class="card-body">
                <div class="info-box bg-light">
                    <span class="info-box-icon bg-info"><i class="fas fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Pendaftar</span>
                        <span class="info-box-number">{{ $pelatihan->pendaftaran_count }}</span>
                    </div>
                </div>

                <div class="info-box bg-light">
                    <span class="info-box-icon bg-success"><i class="fas fa-user-check"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Diterima</span>
                        <span class="info-box-number">{{ $pesertaDiterima }}</span>
                    </div>
                </div>

                <div class="info-box bg-light">
                    <span class="info-box-icon bg-warning"><i class="fas fa-clock"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Menunggu</span>
                        <span class="info-box-number">{{ $pesertaMenunggu }}</span>
                    </div>
                </div>

                <div class="info-box bg-light">
                    <span class="info-box-icon bg-danger"><i class="fas fa-user-times"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Ditolak</span>
                        <span class="info-box-number">{{ $pesertaDitolak }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card card-success card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-bolt mr-2"></i>Aksi Cepat</h3>
            </div>
            <div class="card-body">
                <a href="{{ route('admin.pelatihan.peserta', $pelatihan) }}" class="btn btn-block btn-info">
                    <i class="fas fa-users mr-2"></i>Kelola Peserta
                </a>
                <a href="{{ route('admin.pelatihan.edit', $pelatihan) }}" class="btn btn-block btn-warning">
                    <i class="fas fa-edit mr-2"></i>Edit Pelatihan
                </a>
                <button type="button" class="btn btn-block btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash mr-2"></i>Hapus Pelatihan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Form Delete -->
<form id="delete-form" method="POST" action="{{ route('admin.pelatihan.destroy', $pelatihan) }}" style="display:none">
    @csrf @method('DELETE')
</form>
@endsection

@push('scripts')
<script>
function confirmDelete() {
    if(confirm('Apakah Anda yakin ingin menghapus pelatihan ini?\n\nSemua data peserta yang terdaftar juga akan terhapus.')) {
        document.getElementById('delete-form').submit();
    }
}
</script>
@endpush
