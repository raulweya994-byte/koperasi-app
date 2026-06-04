@extends('layouts.app')
@section('title','Laporan Bantuan')
@section('page-title','Laporan Bantuan')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('pimpinan.laporan.index') }}">Laporan</a></li>
<li class="breadcrumb-item active">Bantuan</li>
@endsection

@section('content')
<div class="container-fluid">
    {{-- DEBUG: Permission Status --}}
    @php
        $canView = can_view('laporan');
        $canCreate = can_create('laporan');
        $canEdit = can_edit('laporan');
        $canDelete = can_delete('laporan');
        $hasAnyPermission = $canView || $canCreate || $canEdit || $canDelete;
        
        // Debug info
        \Log::info('Bantuan Page - User: ' . auth()->user()->name);
        \Log::info('Bantuan Page - Role: ' . auth()->user()->role);
        \Log::info('Bantuan Page - can_view: ' . ($canView ? 'YES' : 'NO'));
        \Log::info('Bantuan Page - can_create: ' . ($canCreate ? 'YES' : 'NO'));
        \Log::info('Bantuan Page - can_edit: ' . ($canEdit ? 'YES' : 'NO'));
        \Log::info('Bantuan Page - can_delete: ' . ($canDelete ? 'YES' : 'NO'));
    @endphp

    {{-- Permission Status Alert --}}
    @if(!$hasAnyPermission)
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-warning" style="border-radius:12px;border:none;box-shadow:0 4px 12px rgba(0,0,0,0.08);background:linear-gradient(135deg,#fff3cd,#ffe69c);border-left:5px solid #ffc107">
                <div class="d-flex align-items-center">
                    <div style="font-size:48px;color:#ffc107;margin-right:20px">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div>
                        <h5 class="alert-heading mb-2" style="color:#856404;font-weight:700">
                            <i class="fas fa-lock mr-2"></i>Akses Terbatas
                        </h5>
                        <p class="mb-2" style="color:#856404;font-size:14px">
                            Anda belum memiliki izin untuk mengelola Laporan Bantuan. 
                            Silakan hubungi <strong>Administrator</strong> untuk mendapatkan akses berikut:
                        </p>
                        <ul class="mb-0" style="color:#856404;font-size:13px">
                            <li><i class="fas fa-eye mr-1"></i> Lihat Detail Bantuan</li>
                            <li><i class="fas fa-plus mr-1"></i> Tambah Program Bantuan</li>
                            <li><i class="fas fa-edit mr-1"></i> Edit Data Bantuan</li>
                            <li><i class="fas fa-trash mr-1"></i> Hapus Data Bantuan</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="row mb-3">
        <div class="col-12">
            <div class="alert alert-info" style="border-radius:12px;border:none;box-shadow:0 4px 12px rgba(0,0,0,0.08);background:linear-gradient(135deg,#d1ecf1,#bee5eb);border-left:5px solid #17a2b8">
                <div class="d-flex align-items-center">
                    <div style="font-size:32px;color:#17a2b8;margin-right:15px">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div style="flex:1">
                        <h6 class="mb-2" style="color:#0c5460;font-weight:700">
                            <i class="fas fa-check-circle mr-1"></i>Status Izin Akses Anda
                        </h6>
                        <div class="row" style="font-size:13px">
                            <div class="col-md-3">
                                @if($canView)
                                    <span class="badge badge-success mr-1"><i class="fas fa-check"></i></span>
                                    <span style="color:#0c5460;font-weight:600"><i class="fas fa-eye mr-1"></i>Lihat Detail</span>
                                @else
                                    <span class="badge badge-secondary mr-1"><i class="fas fa-times"></i></span>
                                    <span style="color:#6c757d"><i class="fas fa-eye mr-1"></i>Lihat Detail</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if($canCreate)
                                    <span class="badge badge-success mr-1"><i class="fas fa-check"></i></span>
                                    <span style="color:#0c5460;font-weight:600"><i class="fas fa-plus mr-1"></i>Tambah Bantuan</span>
                                @else
                                    <span class="badge badge-secondary mr-1"><i class="fas fa-times"></i></span>
                                    <span style="color:#6c757d"><i class="fas fa-plus mr-1"></i>Tambah Bantuan</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if($canEdit)
                                    <span class="badge badge-success mr-1"><i class="fas fa-check"></i></span>
                                    <span style="color:#0c5460;font-weight:600"><i class="fas fa-edit mr-1"></i>Edit Data</span>
                                @else
                                    <span class="badge badge-secondary mr-1"><i class="fas fa-times"></i></span>
                                    <span style="color:#6c757d"><i class="fas fa-edit mr-1"></i>Edit Data</span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                @if($canDelete)
                                    <span class="badge badge-success mr-1"><i class="fas fa-check"></i></span>
                                    <span style="color:#0c5460;font-weight:600"><i class="fas fa-trash mr-1"></i>Hapus Data</span>
                                @else
                                    <span class="badge badge-secondary mr-1"><i class="fas fa-times"></i></span>
                                    <span style="color:#6c757d"><i class="fas fa-trash mr-1"></i>Hapus Data</span>
                                @endif
                            </div>
                        </div>
                        <p class="mb-0 mt-2" style="color:#0c5460;font-size:12px">
                            <i class="fas fa-info-circle mr-1"></i>
                            Tombol yang tidak diizinkan tidak akan tampil di tabel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Data Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border-radius:16px 16px 0 0;border:none;padding:20px">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 font-weight-bold" style="color:#1a3a6e">
                                <i class="fas fa-list mr-2"></i>Daftar Program Bantuan
                            </h5>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="badge badge-primary mr-2" style="font-size:13px;padding:8px 16px">
                                {{ $bantuan->total() }} Program
                            </span>
                            @if($canCreate)
                            <button onclick="createBantuan()" class="btn btn-primary" style="border-radius:10px">
                                <i class="fas fa-plus mr-1"></i>Tambah Program
                            </button>
                            @else
                            <span class="badge badge-secondary" style="font-size:12px;padding:8px 16px">
                                <i class="fas fa-lock mr-1"></i>Tidak Ada Izin Tambah
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background:#f8f9fa">
                                <tr>
                                    <th style="padding:15px;width:50px">#</th>
                                    <th style="width:150px">Kode Program</th>
                                    <th>Nama Program</th>
                                    <th style="width:100px">Tahun</th>
                                    <th style="width:180px">Anggaran</th>
                                    <th style="width:120px">Penerima</th>
                                    <th style="width:100px">Status</th>
                                    <th style="width:120px" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bantuan as $i => $b)
                                <tr style="border-bottom:1px solid #e5e7eb">
                                    <td style="padding:15px">{{ $bantuan->firstItem()+$i }}</td>
                                    <td>
                                        <span class="badge badge-secondary" style="font-size:11px;padding:6px 12px">
                                            {{ $b->kode_bantuan }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="font-weight-600" style="color:#1f2937;font-size:14px">
                                            {{ $b->nama_bantuan }}
                                        </div>
                                        <small class="text-muted">
                                            <i class="fas fa-tag mr-1"></i>{{ ucfirst($b->jenis_bantuan) }}
                                        </small>
                                    </td>
                                    <td>
                                        <span class="badge badge-info" style="font-size:11px;padding:6px 12px">
                                            <i class="fas fa-calendar mr-1"></i>{{ $b->tahun }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="font-weight-bold" style="color:#10b981;font-size:14px">
                                            Rp {{ number_format($b->anggaran, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="progress" style="height:25px;border-radius:8px">
                                            @php
                                                $percentage = $b->kuota > 0 ? ($b->jumlah_penerima / $b->kuota * 100) : 0;
                                                $progressColor = $percentage >= 80 ? 'success' : ($percentage >= 50 ? 'warning' : 'info');
                                            @endphp
                                            <div class="progress-bar bg-{{ $progressColor }}" 
                                                 role="progressbar" 
                                                 style="width: {{ $percentage }}%;font-size:11px;font-weight:600"
                                                 aria-valuenow="{{ $percentage }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                {{ $b->jumlah_penerima }}/{{ $b->kuota }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($b->status == 'aktif')
                                            <span class="badge badge-success" style="font-size:11px;padding:6px 12px">
                                                <i class="fas fa-check-circle mr-1"></i>Aktif
                                            </span>
                                        @elseif($b->status == 'selesai')
                                            <span class="badge badge-secondary" style="font-size:11px;padding:6px 12px">
                                                <i class="fas fa-flag-checkered mr-1"></i>Selesai
                                            </span>
                                        @else
                                            <span class="badge badge-warning" style="font-size:11px;padding:6px 12px">
                                                <i class="fas fa-clock mr-1"></i>{{ ucfirst($b->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $hasView = can_view('laporan');
                                            $hasEdit = can_edit('laporan');
                                            $hasDelete = can_delete('laporan');
                                            $hasAnyAction = $hasView || $hasEdit || $hasDelete;
                                        @endphp
                                        
                                        @if($hasAnyAction)
                                        <div class="btn-group" role="group">
                                            @if($hasView)
                                            <button class="btn btn-sm btn-info detail-btn" 
                                                    style="border-radius:{{ $hasEdit || $hasDelete ? '8px 0 0 8px' : '8px' }};padding:6px 12px"
                                                    data-toggle="modal" 
                                                    data-target="#detailModal{{ $b->id }}"
                                                    title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            @endif
                                            
                                            @if($hasEdit)
                                            <button onclick="editBantuan({{ $b->id }})" 
                                                    class="btn btn-sm btn-warning" 
                                                    style="border-radius:{{ !$hasView && $hasDelete ? '8px 0 0 8px' : (!$hasView && !$hasDelete ? '8px' : '0') }};padding:6px 12px"
                                                    title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            @endif
                                            
                                            @if($hasDelete)
                                            <button onclick="deleteBantuan({{ $b->id }})" 
                                                    class="btn btn-sm btn-danger" 
                                                    style="border-radius:{{ $hasView || $hasEdit ? '0 8px 8px 0' : '8px' }};padding:6px 12px"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            @endif
                                        </div>
                                        @else
                                        <span class="badge badge-secondary" style="font-size:11px;padding:6px 12px">
                                            <i class="fas fa-lock mr-1"></i>Tidak Ada Akses
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="fas fa-inbox fa-3x text-muted mb-3 d-block" style="opacity:0.3"></i>
                                        <p class="text-muted mb-0">Tidak ada data bantuan</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($bantuan->hasPages())
                <div class="card-footer" style="background:white;border-radius:0 0 16px 16px;padding:20px">
                    {{ $bantuan->links('pagination::bootstrap-4') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Detail Modals --}}
@foreach($bantuan as $b)
<div class="modal fade" id="detailModal{{ $b->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="border-radius:16px;border:none">
            <div class="modal-header" style="background:linear-gradient(135deg,#667eea,#764ba2);border-radius:16px 16px 0 0;border:none">
                <h5 class="modal-title text-white font-weight-bold">
                    <i class="fas fa-info-circle mr-2"></i>Detail Program Bantuan
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Kode Program</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">{{ $b->kode_bantuan }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Tahun</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">{{ $b->tahun }}</p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Nama Program</label>
                        <p class="mb-0 font-weight-600" style="font-size:16px;color:#1a3a6e">{{ $b->nama_bantuan }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Jenis Bantuan</label>
                        <p class="mb-0">
                            <span class="badge badge-info" style="font-size:13px;padding:6px 14px">
                                {{ ucfirst($b->jenis_bantuan) }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Status</label>
                        <p class="mb-0">
                            @if($b->status == 'aktif')
                                <span class="badge badge-success" style="font-size:13px;padding:6px 14px">Aktif</span>
                            @elseif($b->status == 'selesai')
                                <span class="badge badge-secondary" style="font-size:13px;padding:6px 14px">Selesai</span>
                            @else
                                <span class="badge badge-warning" style="font-size:13px;padding:6px 14px">{{ ucfirst($b->status) }}</span>
                            @endif
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Anggaran</label>
                        <p class="mb-0 font-weight-bold" style="font-size:18px;color:#10b981">
                            Rp {{ number_format($b->anggaran, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Kuota Penerima</label>
                        <p class="mb-0 font-weight-600" style="font-size:15px">
                            <i class="fas fa-users mr-2 text-primary"></i>{{ $b->kuota }} Penerima
                        </p>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Progress Penyaluran</label>
                        <div class="progress" style="height:30px;border-radius:10px">
                            @php
                                $percentage = $b->kuota > 0 ? ($b->jumlah_penerima / $b->kuota * 100) : 0;
                                $progressColor = $percentage >= 80 ? 'success' : ($percentage >= 50 ? 'warning' : 'info');
                            @endphp
                            <div class="progress-bar bg-{{ $progressColor }}" 
                                 role="progressbar" 
                                 style="width: {{ $percentage }}%;font-size:13px;font-weight:600"
                                 aria-valuenow="{{ $percentage }}" 
                                 aria-valuemin="0" 
                                 aria-valuemax="100">
                                {{ number_format($percentage, 1) }}% ({{ $b->jumlah_penerima }}/{{ $b->kuota }})
                            </div>
                        </div>
                    </div>
                    @if($b->deskripsi)
                    <div class="col-12 mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Deskripsi</label>
                        <div class="alert alert-info mb-0" style="border-radius:10px">
                            {{ $b->deskripsi }}
                        </div>
                    </div>
                    @endif
                    @if($b->penerima && $b->penerima->count() > 0)
                    <div class="col-12">
                        <label class="text-muted mb-2" style="font-size:12px;text-transform:uppercase;letter-spacing:0.5px">Daftar Penerima</label>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead style="background:#f8f9fa">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Koperasi</th>
                                        <th>Jumlah Diterima</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($b->penerima->take(5) as $index => $p)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $p->koperasi->nama_usaha ?? '-' }}</td>
                                        <td>
                                            @if($b->jenis_bantuan == 'uang')
                                                Rp {{ number_format($p->jumlah_diterima, 0, ',', '.') }}
                                            @else
                                                {{ $p->jumlah_diterima }} {{ $b->satuan }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($p->status == 'diterima')
                                                <span class="badge badge-success">Diterima</span>
                                            @else
                                                <span class="badge badge-warning">{{ ucfirst($p->status) }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @if($b->penerima->count() > 5)
                            <small class="text-muted">Menampilkan 5 dari {{ $b->penerima->count() }} penerima</small>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer" style="border:none;padding:20px">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:10px">
                    <i class="fas fa-times mr-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
.animate-card {
    animation: slideUp 0.5s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table-hover tbody tr:hover {
    background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
    transform: scale(1.01);
    transition: all 0.3s;
}

.detail-btn {
    transition: all 0.3s ease;
}

.detail-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.pagination {
    margin-bottom: 0;
}

.page-link {
    border-radius: 8px;
    margin: 0 3px;
    border: none;
    color: #1a3a6e;
}

.page-item.active .page-link {
    background: linear-gradient(135deg, #667eea, #764ba2);
    border: none;
}
</style>

@push('scripts')
<script>
// Create Bantuan
function createBantuan() {
    window.location.href = '{{ route("pimpinan.laporan.bantuan.create") }}';
}

// Edit Bantuan
function editBantuan(id) {
    window.location.href = `/pimpinan/laporan/bantuan/${id}/edit`;
}

// Delete Bantuan
function deleteBantuan(id) {
    Swal.fire({
        title: 'Hapus Program Bantuan?',
        text: "Data program bantuan akan dihapus permanen dari sistem!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: '<i class="fas fa-trash mr-1"></i>Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times mr-1"></i>Batal',
        customClass: {
            confirmButton: 'btn btn-danger btn-lg',
            cancelButton: 'btn btn-secondary btn-lg'
        },
        buttonsStyling: false
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                text: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // AJAX request untuk delete
            $.ajax({
                url: `/pimpinan/laporan/bantuan/${id}`,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false,
                            customClass: {
                                popup: 'animated bounceIn'
                            }
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message,
                            confirmButtonText: 'OK',
                            customClass: {
                                confirmButton: 'btn btn-primary'
                            },
                            buttonsStyling: false
                        });
                    }
                },
                error: function(xhr) {
                    let message = 'Terjadi kesalahan saat menghapus data';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: message,
                        confirmButtonText: 'OK',
                        customClass: {
                            confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                }
            });
        }
    });
}
</script>
@endpush

@endsection
