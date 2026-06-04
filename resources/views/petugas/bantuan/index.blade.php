@extends('layouts.app')
@section('title', 'Data Bantuan')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#2c5aa0,#1e3a70)">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center">
                            <div style="width:70px;height:70px;background:rgba(255,255,255,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin-right:20px">
                                <i class="fas fa-hand-holding-usd fa-2x"></i>
                            </div>
                            <div>
                                <h3 class="mb-1 font-weight-bold">Data Bantuan</h3>
                                <p class="mb-0" style="opacity:0.9">Daftar program bantuan untuk koperasi</p>
                            </div>
                        </div>
                        <div class="text-right">
                            @if(can_create('bantuan'))
                                <a href="{{ route('petugas.bantuan.create') }}" 
                                   class="btn btn-light btn-lg mb-2" 
                                   style="border-radius:12px;padding:12px 24px;font-weight:600;box-shadow:0 4px 12px rgba(0,0,0,0.15)">
                                    <i class="fas fa-plus-circle mr-2"></i>Tambah Bantuan Baru
                                </a>
                            @endif
                            <div class="mt-2">
                                <h2 class="mb-0 font-weight-bold">{{ $bantuan->total() }}</h2>
                                <small style="opacity:0.9">Total Program</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="border-radius:16px;overflow:hidden">
                            <thead style="background:linear-gradient(135deg,#34495e,#2c3e50)">
                                <tr>
                                    <th style="padding:20px;border:none;width:50px;text-align:center;color:#ffffff">
                                        <i class="fas fa-hashtag"></i>
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff">
                                        <i class="fas fa-barcode mr-2"></i>Kode
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff">
                                        <i class="fas fa-gift mr-2"></i>Nama Program
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff">
                                        <i class="fas fa-calendar mr-2"></i>Tahun
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff">
                                        <i class="fas fa-users mr-2"></i>Kuota
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff">
                                        <i class="fas fa-check-circle mr-2"></i>Penerima
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff">
                                        <i class="fas fa-info-circle mr-2"></i>Status
                                    </th>
                                    <th style="padding:20px;border:none;font-weight:700;color:#ffffff;text-align:center">
                                        <i class="fas fa-cog mr-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bantuan as $index => $item)
                                <tr style="border-bottom:1px solid #f3f4f6">
                                    <td style="padding:20px;text-align:center;color:#6b7280;font-weight:600">
                                        {{ $bantuan->firstItem() + $index }}
                                    </td>
                                    <td style="padding:20px">
                                        <span class="badge badge-success" style="padding:8px 16px;border-radius:20px;font-size:13px;font-weight:600">
                                            {{ $item->kode_bantuan }}
                                        </span>
                                    </td>
                                    <td style="padding:20px">
                                        <div style="max-width:300px">
                                            <h6 class="mb-0 font-weight-bold" style="color:#1f2937">
                                                {{ $item->nama_bantuan }}
                                            </h6>
                                        </div>
                                    </td>
                                    <td style="padding:20px">
                                        <div class="font-weight-bold" style="color:#1f2937;font-size:14px">
                                            {{ $item->tahun }}
                                        </div>
                                    </td>
                                    <td style="padding:20px">
                                        <div class="font-weight-bold" style="color:#1f2937;font-size:14px">
                                            {{ $item->kuota }} Koperasi
                                        </div>
                                    </td>
                                    <td style="padding:20px">
                                        <span class="badge badge-{{ $item->jumlah_penerima >= $item->kuota ? 'danger' : 'success' }}" 
                                              style="padding:8px 16px;border-radius:20px;font-size:13px;font-weight:600">
                                            {{ $item->jumlah_penerima }}/{{ $item->kuota }}
                                        </span>
                                    </td>
                                    <td style="padding:20px">
                                        @if($item->status === 'aktif')
                                            <span class="badge badge-success" style="padding:8px 16px;border-radius:20px;font-size:12px;font-weight:600">
                                                <i class="fas fa-check-circle mr-1"></i>AKTIF
                                            </span>
                                        @elseif($item->status === 'selesai')
                                            <span class="badge badge-secondary" style="padding:8px 16px;border-radius:20px;font-size:12px;font-weight:600">
                                                <i class="fas fa-flag-checkered mr-1"></i>SELESAI
                                            </span>
                                        @else
                                            <span class="badge badge-danger" style="padding:8px 16px;border-radius:20px;font-size:12px;font-weight:600">
                                                <i class="fas fa-times-circle mr-1"></i>NONAKTIF
                                            </span>
                                        @endif
                                    </td>
                                    <td style="padding:20px;text-align:center">
                                        <div class="btn-group" role="group">
                                            @if(can_view('bantuan'))
                                                <a href="{{ route('petugas.bantuan.show', $item->id) }}" 
                                                   class="btn btn-sm btn-info" 
                                                   style="border-radius:6px 0 0 6px;padding:8px 12px"
                                                   title="Lihat Detail">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            @endif
                                            
                                            <a href="{{ route('petugas.bantuan.konfirmasi', $item->id) }}"
                                                   class="btn btn-sm btn-success"
                                                   style="border-radius:0;padding:8px 12px"
                                                   title="Konfirmasi Penyaluran">
                                                    <i class="fas fa-clipboard-check"></i> Konfirmasi
                                                </a>

                                            @if(can_edit('bantuan'))
                                                <a href="{{ route('petugas.bantuan.edit', $item->id) }}" 
                                                   class="btn btn-sm btn-warning" 
                                                   style="border-radius:0;padding:8px 12px"
                                                   title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @endif
                                            
                                            @if(can_delete('bantuan'))
                                                <form action="{{ route('petugas.bantuan.destroy', $item->id) }}" 
                                                      method="POST" 
                                                      style="display:inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus program bantuan ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger" 
                                                            style="border-radius:0 6px 6px 0;padding:8px 12px"
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" style="padding:60px;text-align:center">
                                        <i class="fas fa-inbox fa-4x text-muted mb-3" style="display:block"></i>
                                        <h5 class="text-muted">Tidak ada program bantuan</h5>
                                        <p class="text-muted mb-0">Belum ada program bantuan yang tersedia saat ini</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                
                {{-- Pagination --}}
                @if($bantuan->hasPages())
                <div class="card-footer" style="background:#f8f9fa;border:none;padding:20px">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted" style="font-size:14px">
                            Menampilkan {{ $bantuan->firstItem() }} - {{ $bantuan->lastItem() }} dari {{ $bantuan->total() }} program
                        </div>
                        <div>
                            {{ $bantuan->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.table-hover tbody tr:hover {
    background: linear-gradient(135deg, #ecf0f1, #d5dbdb);
    transform: scale(1.01);
    transition: all 0.2s;
}

.btn-group .btn {
    transition: all 0.2s;
}

.btn-group .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    z-index: 1;
}

.btn-info {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    border: none;
    color: white;
}

.btn-warning {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    border: none;
    color: white;
}

.btn-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    border: none;
    color: white;
}

.badge {
    transition: all 0.2s;
}

tr:hover .badge {
    transform: scale(1.05);
}

.btn-light {
    transition: all 0.3s;
}

.btn-light:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.2) !important;
}
</style>

@push('scripts')
@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false,
        customClass: {
            popup: 'swal-modern'
        }
    });
</script>
@endif

@if(session('error'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}',
        confirmButtonColor: '#10b981',
        customClass: {
            popup: 'swal-modern'
        }
    });
</script>
@endif
@endpush
@endsection
