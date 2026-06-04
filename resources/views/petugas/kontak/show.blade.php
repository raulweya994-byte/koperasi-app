@extends('layouts.app')
@section('title', 'Detail Pesan')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card page-header-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center">
                            <div class="page-header-icon">
                                <i class="fas fa-envelope-open"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Detail Pesan</h3>
                                <p class="page-header-subtitle">{{ $pesan->subjek }}</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('petugas.kontak.index') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Message Content --}}
    <div class="row">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <i class="fas fa-comment-alt"></i> Isi Pesan
                    </h5>
                </div>
                <div class="content-card-body">
                    {{-- Sender Info --}}
                    <div class="d-flex align-items-start mb-4 pb-4" style="border-bottom:2px solid #f0f4ff">
                        <div style="width:60px;height:60px;border-radius:50%;background:linear-gradient(135deg,#3b82f6,#2563eb);display:flex;align-items:center;justify-content:center;color:white;font-size:24px;font-weight:700;margin-right:20px">
                            {{ strtoupper(substr($pesan->nama, 0, 1)) }}
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-1 font-weight-bold" style="color:#1a3a6e">{{ $pesan->nama }}</h5>
                            <div class="text-muted" style="font-size:14px">
                                <div class="mb-1">
                                    <i class="fas fa-envelope mr-2"></i>
                                    <a href="mailto:{{ $pesan->email }}" style="color:#3b82f6">{{ $pesan->email }}</a>
                                </div>
                                @if($pesan->telepon)
                                <div class="mb-1">
                                    <i class="fas fa-phone mr-2"></i>
                                    <a href="tel:{{ $pesan->telepon }}" style="color:#3b82f6">{{ $pesan->telepon }}</a>
                                </div>
                                @endif
                                <div>
                                    <i class="far fa-clock mr-2"></i>
                                    {{ \Carbon\Carbon::parse($pesan->created_at)->format('d F Y, H:i') }} WIT
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Message Body --}}
                    <div class="mb-4">
                        <label class="font-weight-bold mb-3" style="color:#1a3a6e;font-size:15px">
                            <i class="fas fa-comment-dots mr-2"></i>Pesan:
                        </label>
                        <div class="p-4" style="background:#f8f9ff;border-radius:12px;border-left:4px solid #3b82f6;white-space:pre-wrap;line-height:1.8;color:#374151">{{ $pesan->pesan }}</div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-2" style="gap:12px">
                        <a href="mailto:{{ $pesan->email }}?subject=Re: {{ $pesan->subjek }}" 
                           class="btn btn-primary-modern">
                            <i class="fas fa-reply"></i> Balas via Email
                        </a>
                        <a href="{{ route('petugas.kontak.index') }}" 
                           class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <form method="POST" action="{{ route('petugas.kontak.destroy', $pesan->id) }}" 
                              style="display:inline" 
                              onsubmit="return confirmDelete(event)">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger-modern">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Info --}}
        <div class="col-lg-4">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <i class="fas fa-info-circle"></i> Informasi Pesan
                    </h5>
                </div>
                <div class="content-card-body">
                    <div class="mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;font-weight:600;text-transform:uppercase">Status</label>
                        <div>
                            @if($pesan->dibaca)
                            <span class="status-badge status-active">
                                <i class="fas fa-check-circle"></i> Sudah Dibaca
                            </span>
                            @else
                            <span class="status-badge status-pending">
                                <i class="fas fa-circle"></i> Belum Dibaca
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;font-weight:600;text-transform:uppercase">Subjek</label>
                        <div class="font-weight-bold" style="color:#1a3a6e">{{ $pesan->subjek }}</div>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;font-weight:600;text-transform:uppercase">Tanggal Diterima</label>
                        <div>{{ \Carbon\Carbon::parse($pesan->created_at)->format('d F Y') }}</div>
                        <small class="text-muted">{{ \Carbon\Carbon::parse($pesan->created_at)->format('H:i') }} WIT</small>
                    </div>

                    <div class="mb-3">
                        <label class="text-muted mb-1" style="font-size:12px;font-weight:600;text-transform:uppercase">Waktu Berlalu</label>
                        <div>{{ \Carbon\Carbon::parse($pesan->created_at)->diffForHumans() }}</div>
                    </div>

                    <hr style="border-color:#e5e7eb">

                    <div class="alert alert-info-modern">
                        <i class="fas fa-lightbulb"></i>
                        <div>
                            <strong>Tips:</strong>
                            <p class="mb-0" style="font-size:13px">Balas pesan ini melalui email untuk memberikan respon kepada pengirim.</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick Actions --}}
            <div class="content-card mt-3">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <i class="fas fa-bolt"></i> Aksi Cepat
                    </h5>
                </div>
                <div class="content-card-body">
                    <a href="mailto:{{ $pesan->email }}" 
                       class="btn btn-block btn-info-modern mb-2">
                        <i class="fas fa-envelope"></i> Kirim Email
                    </a>
                    @if($pesan->telepon)
                    <a href="tel:{{ $pesan->telepon }}" 
                       class="btn btn-block btn-success-modern mb-2">
                        <i class="fas fa-phone"></i> Hubungi via Telepon
                    </a>
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $pesan->telepon) }}" 
                       target="_blank"
                       class="btn btn-block btn-success-modern mb-2">
                        <i class="fab fa-whatsapp"></i> Chat WhatsApp
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(event) {
    event.preventDefault();
    const form = event.target;
    
    Swal.fire({
        title: 'Hapus Pesan?',
        text: "Pesan akan dihapus permanen dan tidak dapat dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
    
    return false;
}
</script>
@endpush
