@extends('layouts.app')
@section('title', 'Verifikasi Pendaftaran Anggota')

@section('content')

{{-- Stats Cards --}}
<div class="row mb-4">
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card border-0" style="border-radius: 12px; background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%); box-shadow: 0 2px 10px rgba(251, 191, 36, 0.3);">
            <div class="card-body text-white p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-1 fw-bold">{{ $stats['pending'] }}</h2>
                        <p class="mb-0" style="font-size: 14px; opacity: 0.95;">Menunggu Verifikasi</p>
                    </div>
                    <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-clock fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card border-0" style="border-radius: 12px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); box-shadow: 0 2px 10px rgba(16, 185, 129, 0.3);">
            <div class="card-body text-white p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-1 fw-bold">{{ $stats['aktif'] }}</h2>
                        <p class="mb-0" style="font-size: 14px; opacity: 0.95;">Anggota Aktif</p>
                    </div>
                    <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-check-circle fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="card border-0" style="border-radius: 12px; background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); box-shadow: 0 2px 10px rgba(6, 182, 212, 0.3);">
            <div class="card-body text-white p-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="mb-1 fw-bold">{{ $stats['total'] }}</h2>
                        <p class="mb-0" style="font-size: 14px; opacity: 0.95;">Total Pendaftar</p>
                    </div>
                    <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filter & Search --}}
<div class="card mb-4" style="border-radius: 12px; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
    <div class="card-header bg-white" style="padding: 20px 24px; border-bottom: 2px solid #f0f0f0;">
        <h5 class="mb-0 fw-semibold" style="color: #1e293b;">
            <i class="fas fa-filter me-2" style="color: #667eea;"></i>Filter Data
        </h5>
    </div>
    <div class="card-body" style="padding: 24px;">
        <form method="GET" action="{{ route('admin.anggota.verifikasi') }}">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold" style="font-size: 13px; color: #374151;">Status</label>
                    <select name="status" class="form-select" style="border-radius: 8px; border: 1.5px solid #e5e7eb;">
                        <option value="">Semua Status</option>
                        <option value="Pending" {{ request('status')=='Pending'?'selected':'' }}>Pending</option>
                        <option value="Aktif" {{ request('status')=='Aktif'?'selected':'' }}>Diterima</option>
                        <option value="Ditolak" {{ request('status')=='Ditolak'?'selected':'' }}>Ditolak</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="font-size: 13px; color: #374151;">Cari Anggota</label>
                    <input type="text" name="search" class="form-control" placeholder="Nama atau No. Anggota" value="{{ request('search') }}" style="border-radius: 8px; border: 1.5px solid #e5e7eb;">
                </div>
                <div class="col-md-2">
                    <label class="form-label fw-semibold" style="font-size: 13px; color: #374151;">&nbsp;</label>
                    <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; font-weight: 600;">
                        <i class="fas fa-search me-1"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Data Anggota dalam Tabel --}}
<div class="card" style="border-radius: 12px; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.06);">
    <div class="card-header bg-white" style="padding: 20px 24px; border-bottom: 2px solid #f0f0f0;">
        <h5 class="mb-0 fw-semibold" style="color: #1e293b;">
            <i class="fas fa-list me-2" style="color: #667eea;"></i>Daftar Anggota
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" style="font-size: 13px;">
                <thead style="background: #f8f9fa; border-bottom: 2px solid #e5e7eb;">
                    <tr>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">NO. ANGGOTA</th>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">FOTO</th>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">NAMA LENGKAP</th>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">TEMPAT, TGL LAHIR</th>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">JENIS KELAMIN</th>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">KONTAK</th>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">DESA</th>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">NAMA USAHA</th>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">MODAL USAHA</th>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">TOTAL SIMPANAN</th>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px;">STATUS</th>
                        <th style="padding: 14px 16px; font-weight: 600; color: #374151; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; text-align: center;">AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($anggota as $a)
                    <tr style="border-bottom: 1px solid #f0f0f0; transition: all 0.2s;">
                        <td style="padding: 14px 16px;">
                            <span class="badge" style="background: linear-gradient(135deg, #667eea, #764ba2); color: white; font-size: 11px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                                {{ $a->no_anggota }}
                            </span>
                        </td>
                        <td style="padding: 14px 16px;">
                            <img src="{{ $a->foto_url }}" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover; border: 3px solid #e0e6ff; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                        </td>
                        <td style="padding: 14px 16px;">
                            <div style="font-weight: 600; color: #1e293b; font-size: 13px;">{{ $a->nama }}</div>
                            <small class="text-muted" style="font-size: 11px;">NIK: {{ $a->nik }}</small>
                        </td>
                        <td style="padding: 14px 16px;">
                            <div style="font-size: 12px; color: #475569;">{{ $a->tempat_lahir }}</div>
                            <small class="text-muted" style="font-size: 11px;">{{ $a->tanggal_lahir ? \Carbon\Carbon::parse($a->tanggal_lahir)->format('d M Y') : '-' }}</small>
                        </td>
                        <td style="padding: 14px 16px;">
                            @if($a->jenis_kelamin == 'L')
                            <span class="badge" style="background: #dbeafe; color: #1e40af; font-size: 11px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                                <i class="fas fa-mars" style="font-size: 10px;"></i> Laki-laki
                            </span>
                            @else
                            <span class="badge" style="background: #fce7f3; color: #be185d; font-size: 11px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                                <i class="fas fa-venus" style="font-size: 10px;"></i> Perempuan
                            </span>
                            @endif
                        </td>
                        <td style="padding: 14px 16px;">
                            <div style="font-size: 12px; color: #475569;">
                                <i class="fab fa-whatsapp text-success" style="font-size: 11px;"></i> {{ $a->no_hp }}
                            </div>
                            @if($a->email)
                            <small class="text-muted" style="font-size: 11px;">
                                <i class="fas fa-envelope" style="font-size: 10px;"></i> {{ Str::limit($a->email, 20) }}
                            </small>
                            @endif
                        </td>
                        <td style="padding: 14px 16px;">
                            <small style="font-size: 12px; color: #475569;">{{ $a->desa ?? '-' }}</small>
                        </td>
                        <td style="padding: 14px 16px;">
                            <div style="font-size: 12px; color: #475569;">
                                <i class="fas fa-store text-muted" style="font-size: 10px;"></i> {{ Str::limit($a->nama_usaha, 20) }}
                            </div>
                        </td>
                        <td style="padding: 14px 16px;">
                            <span class="text-success" style="font-weight: 600; font-size: 12px;">
                                Rp {{ number_format($a->modal_usaha ?? 0, 0, ',', '.') }}
                            </span>
                        </td>
                        <td style="padding: 14px 16px;">
                            <span class="text-primary" style="font-weight: 600; font-size: 12px;">
                                Rp {{ number_format($a->total_simpanan ?? 0, 0, ',', '.') }}
                            </span>
                        </td>
                        <td style="padding: 14px 16px;">
                            @if($a->status == 'Pending')
                            <span class="badge bg-warning text-dark" style="font-size: 11px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                                <i class="fas fa-clock" style="font-size: 10px;"></i> Pending
                            </span>
                            @elseif($a->status == 'Aktif')
                            <span class="badge bg-success" style="font-size: 11px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                                <i class="fas fa-check-circle" style="font-size: 10px;"></i> Aktif
                            </span>
                            @elseif($a->status == 'Ditolak')
                            <span class="badge bg-danger" style="font-size: 11px; font-weight: 600; padding: 6px 12px; border-radius: 6px;">
                                <i class="fas fa-times-circle" style="font-size: 10px;"></i> Nonaktif
                            </span>
                            @endif
                        </td>
                        <td style="padding: 14px 16px; text-align: center;">
                            <div class="btn-group" role="group">
                                <a href="{{ route('admin.anggota.show', $a) }}" 
                                   class="btn btn-sm" 
                                   style="font-size: 11px; padding: 6px 12px; border-radius: 6px 0 0 6px; background: #06b6d4; color: white; border: none;"
                                   title="Lihat Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.anggota.edit', $a) }}" 
                                   class="btn btn-sm" 
                                   style="font-size: 11px; padding: 6px 12px; border-radius: 0; background: #f59e0b; color: white; border: none;"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                        class="btn btn-sm" 
                                        style="font-size: 11px; padding: 6px 12px; border-radius: 0 6px 6px 0; background: #ef4444; color: white; border: none;"
                                        onclick="confirmDelete({{ $a->id }}, '{{ $a->nama }}')"
                                        title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center" style="padding: 60px 20px;">
                            <i class="fas fa-inbox fa-4x text-muted mb-3" style="opacity: 0.3;"></i>
                            <h5 style="color: #64748b; font-weight: 600;">Tidak ada data pendaftaran</h5>
                            <p class="text-muted mb-0" style="font-size: 14px;">Belum ada anggota yang mendaftar atau sesuai dengan filter yang dipilih.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($anggota->hasPages())
    <div class="card-footer bg-white" style="padding: 20px 24px; border-top: 2px solid #f0f0f0;">
        <div class="d-flex justify-content-center">
            {{ $anggota->links() }}
        </div>
    </div>
    @endif
</div>

{{-- Modal Terima --}}
<div class="modal fade" id="modalTerima" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px;">
            <form id="formTerima" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-check-circle me-2"></i>Terima Pendaftaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin <strong>MENERIMA</strong> pendaftaran anggota:</p>
                    <div class="alert alert-success">
                        <h5 id="namaAnggotaTerima" class="mb-0"></h5>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Catatan (Opsional)</label>
                        <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Tambahkan catatan jika diperlukan..."></textarea>
                    </div>
                    <input type="hidden" name="status" value="Aktif">
                    <div class="alert alert-info">
                        <i class="fas fa-bell me-2"></i>
                        <small>Notifikasi otomatis akan dikirim ke anggota bahwa pendaftaran mereka <strong>LULUS</strong>.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i> Ya, Terima
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Tolak --}}
<div class="modal fade" id="modalTolak" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 12px;">
            <form id="formTolak" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title"><i class="fas fa-times-circle me-2"></i>Tolak Pendaftaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin <strong>MENOLAK</strong> pendaftaran anggota:</p>
                    <div class="alert alert-danger">
                        <h5 id="namaAnggotaTolak" class="mb-0"></h5>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                        <textarea name="catatan_admin" class="form-control" rows="3" placeholder="Jelaskan alasan penolakan..." required></textarea>
                        <small class="text-muted">Alasan ini akan dikirim ke anggota melalui notifikasi.</small>
                    </div>
                    <input type="hidden" name="status" value="Ditolak">
                    <div class="alert alert-warning">
                        <i class="fas fa-bell me-2"></i>
                        <small>Notifikasi otomatis akan dikirim ke anggota bahwa pendaftaran mereka <strong>TIDAK LULUS</strong> dengan alasan yang Anda berikan. Anggota dapat mengakses menu <strong>"Lengkapi Data"</strong> untuk memperbaiki data dan submit ulang.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times me-1"></i> Ya, Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function terimaAnggota(id, nama) {
    document.getElementById('namaAnggotaTerima').textContent = nama;
    document.getElementById('formTerima').action = '/admin/anggota/' + id + '/status';
    new bootstrap.Modal(document.getElementById('modalTerima')).show();
}

function tolakAnggota(id, nama) {
    document.getElementById('namaAnggotaTolak').textContent = nama;
    document.getElementById('formTolak').action = '/admin/anggota/' + id + '/status';
    new bootstrap.Modal(document.getElementById('modalTolak')).show();
}

function confirmDelete(id, nama) {
    Swal.fire({
        title: 'Hapus Data Anggota?',
        html: `Apakah Anda yakin ingin menghapus anggota:<br><strong>"${nama}"</strong>?<br><br><small class="text-danger">Data yang dihapus tidak dapat dikembalikan!</small>`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-trash-alt mr-1"></i> Ya, Hapus!',
        cancelButtonText: '<i class="fas fa-times mr-1"></i> Batal',
        reverseButtons: true,
        customClass: {
            popup: 'swal-modern',
            confirmButton: 'btn-modern',
            cancelButton: 'btn-modern'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Menghapus...',
                html: 'Mohon tunggu sebentar',
                allowOutsideClick: false,
                allowEscapeKey: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Submit delete form
            const form = document.getElementById('deleteForm');
            form.action = `/admin/anggota/${id}`;
            form.submit();
        }
    });
}

// Success message
@if(session('success'))
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
@endif
</script>

<style>
.swal-modern {
    border-radius: 16px;
    padding: 20px;
}
.swal2-title {
    color: #1a3a6e;
    font-size: 22px;
    font-weight: 700;
}
.swal2-html-container {
    font-size: 14px;
    color: #64748b;
}
.btn-modern {
    border-radius: 8px;
    padding: 10px 24px;
    font-weight: 600;
    font-size: 14px;
}
</style>

{{-- Delete Form (Hidden) --}}
<form id="deleteForm" method="POST" style="display:none">
    @csrf
    @method('DELETE')
</form>
@endpush
