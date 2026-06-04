@extends('layouts.app')
@section('title', 'Detail Log Aktivitas')

@section('content')
<div class="container-fluid">
    {{-- Back Button --}}
    <div class="row mb-3">
        <div class="col-12">
            <a href="{{ route('petugas.activity-log.index') }}" class="btn btn-secondary" style="border-radius:8px">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    {{-- Detail Card --}}
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-sm" style="border-radius:16px;border:none;overflow:hidden">
                {{-- Header --}}
                <div class="card-header border-0" style="background:linear-gradient(135deg,#06b6d4,#0891b2);padding:30px">
                    <div class="text-center text-white">
                        <div style="margin-bottom:15px">
                            <div style="width:70px;height:70px;margin:0 auto;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center">
                                <i class="fas fa-history fa-2x"></i>
                            </div>
                        </div>
                        <h6 class="text-uppercase mb-2" style="letter-spacing:2px;opacity:0.9">LOG AKTIVITAS</h6>
                        <h3 class="font-weight-bold mb-0">Detail Aktivitas</h3>
                    </div>
                </div>

                {{-- Content --}}
                <div class="card-body p-4" style="padding:40px !important">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="info-box" style="background:#f8f9fa;padding:20px;border-radius:12px;border-left:4px solid #06b6d4">
                                <label style="font-size:12px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px">
                                    <i class="fas fa-user mr-2"></i>Pengguna
                                </label>
                                <div style="font-size:16px;font-weight:700;color:#1f2937">
                                    {{ $log->user->name ?? 'System' }}
                                </div>
                                <div style="font-size:13px;color:#6b7280;margin-top:4px">
                                    <i class="fas fa-user-tag mr-1"></i>{{ ucfirst($log->user->role ?? 'system') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-box" style="background:#f8f9fa;padding:20px;border-radius:12px;border-left:4px solid #10b981">
                                <label style="font-size:12px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px">
                                    <i class="fas fa-bolt mr-2"></i>Aksi
                                </label>
                                <div>
                                    <span class="badge badge-{{ $log->action == 'create' ? 'success' : ($log->action == 'update' ? 'warning' : ($log->action == 'delete' ? 'danger' : 'info')) }}" 
                                          style="padding:10px 20px;border-radius:20px;font-size:14px;font-weight:700">
                                        <i class="fas {{ $log->action == 'create' ? 'fa-plus' : ($log->action == 'update' ? 'fa-edit' : ($log->action == 'delete' ? 'fa-trash' : 'fa-eye')) }} mr-2"></i>
                                        {{ strtoupper($log->action) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-box" style="background:#f8f9fa;padding:20px;border-radius:12px;border-left:4px solid #f59e0b">
                                <label style="font-size:12px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px">
                                    <i class="fas fa-network-wired mr-2"></i>IP Address
                                </label>
                                <div style="font-size:16px;font-weight:700;color:#1f2937">
                                    {{ $log->ip_address }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <div class="info-box" style="background:#f8f9fa;padding:20px;border-radius:12px;border-left:4px solid #8b5cf6">
                                <label style="font-size:12px;color:#6b7280;font-weight:600;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:8px">
                                    <i class="fas fa-clock mr-2"></i>Waktu
                                </label>
                                <div style="font-size:16px;font-weight:700;color:#1f2937">
                                    {{ $log->created_at->format('d F Y, H:i') }} WIT
                                </div>
                                <div style="font-size:13px;color:#6b7280;margin-top:4px">
                                    {{ $log->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label style="font-size:14px;color:#374151;font-weight:700;margin-bottom:12px">
                            <i class="fas fa-info-circle mr-2 text-info"></i>Deskripsi Aktivitas
                        </label>
                        <div style="background:#f8f9fa;padding:20px;border-radius:12px;border:1px solid #e5e7eb">
                            <p style="font-size:15px;line-height:1.8;color:#374151;margin:0">
                                {{ $log->description }}
                            </p>
                        </div>
                    </div>

                    {{-- User Agent --}}
                    <div class="mb-4">
                        <label style="font-size:14px;color:#374151;font-weight:700;margin-bottom:12px">
                            <i class="fas fa-desktop mr-2 text-secondary"></i>User Agent
                        </label>
                        <div style="background:#f8f9fa;padding:15px;border-radius:12px;border:1px solid #e5e7eb">
                            <code style="font-size:12px;color:#6b7280;word-break:break-all">{{ $log->user_agent }}</code>
                        </div>
                    </div>

                    {{-- Additional Data --}}
                    @if($log->data)
                    <div class="mb-4">
                        <label style="font-size:14px;color:#374151;font-weight:700;margin-bottom:12px">
                            <i class="fas fa-database mr-2 text-primary"></i>Data Tambahan
                        </label>
                        <div style="background:#1f2937;padding:20px;border-radius:12px;overflow-x:auto">
                            <pre style="color:#10b981;margin:0;font-size:12px;line-height:1.6">{{ json_encode(json_decode($log->data), JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="card-footer" style="background:#f8f9fa;border-top:1px solid #e5e7eb;padding:20px">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-muted">
                                <i class="fas fa-fingerprint mr-1"></i>
                                Log ID: <strong>{{ $log->id }}</strong>
                            </small>
                        </div>
                        <div>
                            <a href="{{ route('petugas.activity-log.index') }}" class="btn btn-secondary" style="border-radius:8px">
                                <i class="fas fa-list mr-2"></i>Lihat Semua Log
                            </a>
                            <form action="{{ route('petugas.activity-log.destroy', $log->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus log ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="border-radius:8px">
                                    <i class="fas fa-trash mr-2"></i>Hapus Log
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.info-box {
    transition: all 0.3s ease;
}

.info-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
</style>
@endsection
