@extends('layouts.app')
@section('title','Pelatihan')
@section('page-title','Manajemen Pelatihan')
@section('breadcrumb')
    <li class="breadcrumb-item active">Pelatihan</li>
@endsection
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
</div>
@endif

<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-chalkboard-teacher mr-2"></i>Daftar Pelatihan</h3>
        <div class="card-tools">
            <a href="{{ route('admin.pelatihan.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus mr-1"></i>Tambah Pelatihan
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="thead-light">
                    <tr>
                        <th style="width: 30%">Judul</th>
                        <th style="width: 15%">Tanggal</th>
                        <th style="width: 12%">Lokasi</th>
                        <th class="text-center" style="width: 8%">Kuota</th>
                        <th class="text-center" style="width: 8%">Peserta</th>
                        <th class="text-center" style="width: 10%">Status</th>
                        <th class="text-center" style="width: 17%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($pelatihan as $p)
                <tr>
                    <td>
                        <strong>{{ $p->judul }}</strong>
                        <br><small class="text-muted"><i class="fas fa-building mr-1"></i>{{ $p->penyelenggara }}</small>
                    </td>
                    <td>
                        <small>
                            <i class="far fa-calendar mr-1"></i>{{ $p->tanggal_mulai->format('d M Y') }}
                            @if($p->tanggal_selesai)
                            <br><i class="fas fa-arrow-right mr-1"></i>{{ $p->tanggal_selesai->format('d M Y') }}
                            @endif
                        </small>
                    </td>
                    <td><small><i class="fas fa-map-marker-alt mr-1"></i>{{ $p->lokasi ?? '-' }}</small></td>
                    <td class="text-center"><span class="badge badge-secondary">{{ $p->kuota }}</span></td>
                    <td class="text-center">
                        <span class="badge badge-info">{{ $p->pendaftaran_count }}</span>
                    </td>
                    <td class="text-center">
                        @if($p->status === 'dibuka')
                            <span class="badge badge-success">Dibuka</span>
                        @elseif($p->status === 'berlangsung')
                            <span class="badge badge-primary">Berlangsung</span>
                        @elseif($p->status === 'ditutup')
                            <span class="badge badge-warning">Ditutup</span>
                        @else
                            <span class="badge badge-secondary">Selesai</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.pelatihan.show', $p) }}" class="btn btn-info" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pelatihan.edit', $p) }}" class="btn btn-warning" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $p->id }})" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                        <form id="delete-form-{{ $p->id }}" method="POST" action="{{ route('admin.pelatihan.destroy', $p) }}" style="display:none">
                            @csrf @method('DELETE')
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="fas fa-inbox fa-3x mb-3 d-block"></i>
                        <p>Belum ada data pelatihan</p>
                    </td>
                </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function confirmDelete(id) {
    if(confirm('Apakah Anda yakin ingin menghapus pelatihan ini?\n\nData peserta yang terdaftar juga akan terhapus.')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endpush