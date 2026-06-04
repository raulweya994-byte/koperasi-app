@extends('layouts.app')
@section('title', 'Detail Pengumuman')

@section('content')
<div class="container-fluid">
    {{-- Action Buttons --}}
    <div class="row mb-3">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <a href="javascript:history.back()" class="btn btn-secondary" style="border-radius:8px">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
                <div>
                    <button onclick="printPengumuman()" class="btn btn-success mr-2" style="border-radius:8px">
                        <i class="fas fa-print mr-2"></i>Print
                    </button>
                    <a href="{{ route('admin.pengumuman.download', $pengumuman->id) }}" class="btn btn-primary" style="border-radius:8px">
                        <i class="fas fa-download mr-2"></i>Download PDF
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Pengumuman Detail --}}
    <div class="row">
        <div class="col-lg-10 mx-auto">
            <div class="card shadow-sm" id="printArea" style="border-radius:16px;border:none;overflow:hidden">
                {{-- Kop Surat (Print Only) --}}
                <div class="kop-surat print-only" style="display:none;text-align:center;padding:30px 40px;border-bottom:3px solid #000;margin-bottom:20px">
                    <div style="margin-bottom:10px">
                        <img src="{{ asset('logo.png') }}" alt="Logo Kabupaten Tolikara" style="width:90px;height:90px;object-fit:contain">
                    </div>
                    <div>
                        <h3 style="font-size:16pt;font-weight:bold;margin:0 0 3px 0;text-transform:uppercase;color:#000">PEMERINTAH KABUPATEN TOLIKARA</h3>
                        <h4 style="font-size:14pt;font-weight:bold;margin:0 0 8px 0;color:#000">DINAS PERINDUSTRIAN, PERDAGANGAN DAN KOPERASI</h4>
                        <p style="font-size:10pt;margin:2px 0;line-height:1.3;color:#333">Jl. Gatot Subroto No. 1 Karubaga, Kabupaten Tolikara</p>
                        <p style="font-size:10pt;margin:2px 0;color:#333">Provinsi Papua Pegunungan</p>
                        <p style="font-size:10pt;margin:2px 0;color:#333">Email: disperindagkop@tolikara.go.id | Telp: (0969) 12345</p>
                    </div>
                </div>

                {{-- Header Pengumuman (Print Only) --}}
                <div class="print-only" style="display:none;text-align:center;margin:15px 0">
                    <h1 style="font-size:14pt;font-weight:bold;text-transform:uppercase;letter-spacing:1px;margin:0 0 8px 0;text-decoration:underline;color:#000">PENGUMUMAN</h1>
                    <h2 style="font-size:13pt;font-weight:bold;margin:5px 0;color:#1a3a6e">{{ $pengumuman->judul }}</h2>
                    <span style="display:inline-block;padding:3px 12px;border-radius:15px;font-size:9pt;font-weight:bold;text-transform:uppercase;background:#3b82f6;color:white">
                        {{ strtoupper($pengumuman->jenis) }}
                    </span>
                </div>
                
                {{-- Header (Web Only) --}}
                <div class="card-header border-0 no-print" style="background:{{ $pengumuman->jenis == 'info' ? 'linear-gradient(135deg,#3b82f6,#2563eb)' : ($pengumuman->jenis == 'warning' ? 'linear-gradient(135deg,#f59e0b,#d97706)' : ($pengumuman->jenis == 'success' ? 'linear-gradient(135deg,#10b981,#059669)' : 'linear-gradient(135deg,#ef4444,#dc2626)')) }};padding:40px">
                    <div class="text-center text-white">
                        <div style="margin-bottom:20px">
                            <div style="width:80px;height:80px;margin:0 auto;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center">
                                <i class="fas {{ $pengumuman->jenis == 'info' ? 'fa-info-circle' : ($pengumuman->jenis == 'warning' ? 'fa-exclamation-triangle' : ($pengumuman->jenis == 'success' ? 'fa-check-circle' : 'fa-exclamation-circle')) }} fa-3x"></i>
                            </div>
                        </div>
                        <h6 class="text-uppercase mb-2" style="letter-spacing:2px;opacity:0.9">PENGUMUMAN</h6>
                        <h3 class="font-weight-bold mb-0">{{ $pengumuman->judul }}</h3>
                    </div>
                </div>

                {{-- Meta Info --}}
                <div class="card-body" style="background:#f8f9fa;border-bottom:1px solid #e5e7eb;padding:20px">
                    <div class="row no-print">
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <div style="width:50px;height:50px;background:linear-gradient(135deg,#3b82f6,#2563eb);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                                    <i class="far fa-calendar text-white fa-lg"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size:11px">Tanggal</small>
                                    <strong style="font-size:14px">{{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d M Y') }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <div style="width:50px;height:50px;background:linear-gradient(135deg,#10b981,#059669);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                                    <i class="far fa-clock text-white fa-lg"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size:11px">Waktu</small>
                                    <strong style="font-size:14px">{{ $pengumuman->hari }}, {{ $pengumuman->jam }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3 mb-md-0">
                            <div class="d-flex align-items-center">
                                <div style="width:50px;height:50px;background:linear-gradient(135deg,#f59e0b,#d97706);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                                    <i class="far fa-calendar-alt text-white fa-lg"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size:11px">Tahun</small>
                                    <strong style="font-size:14px">{{ $pengumuman->tahun }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center">
                                <div style="width:50px;height:50px;background:linear-gradient(135deg,#8b5cf6,#7c3aed);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:15px">
                                    <i class="far fa-user text-white fa-lg"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block" style="font-size:11px">Dibuat oleh</small>
                                    <strong style="font-size:14px">{{ $pengumuman->user->name ?? 'Admin' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Meta Info for Print --}}
                    <div class="print-only" style="display:none;background:#f8f9fa;padding:10px 15px;border-radius:5px">
                        <table style="width:100%;border-collapse:collapse">
                            <tr>
                                <td style="padding:3px 8px;font-size:10pt;font-weight:bold;width:120px">Tanggal</td>
                                <td style="padding:3px 8px;font-size:10pt">: {{ \Carbon\Carbon::parse($pengumuman->tanggal)->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 8px;font-size:10pt;font-weight:bold">Hari</td>
                                <td style="padding:3px 8px;font-size:10pt">: {{ $pengumuman->hari }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 8px;font-size:10pt;font-weight:bold">Jam</td>
                                <td style="padding:3px 8px;font-size:10pt">: {{ $pengumuman->jam }} WIT</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 8px;font-size:10pt;font-weight:bold">Tahun</td>
                                <td style="padding:3px 8px;font-size:10pt">: {{ $pengumuman->tahun }}</td>
                            </tr>
                            <tr>
                                <td style="padding:3px 8px;font-size:10pt;font-weight:bold">Dibuat oleh</td>
                                <td style="padding:3px 8px;font-size:10pt">: {{ $pengumuman->user->name ?? 'Admin' }} ({{ ucfirst($pengumuman->user->role ?? 'admin') }})</td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Content --}}
                <div class="card-body p-5">
                    <div class="pengumuman-content" style="font-size:16px;line-height:2;color:#374151;text-align:justify">
                        {!! nl2br(e($pengumuman->isi)) !!}
                    </div>

                    @if($pengumuman->pembuat)
                    <div class="mt-5 pt-4 signature" style="border-top:2px solid #e5e7eb">
                        <div class="text-right">
                            <p class="mb-2 text-muted" style="font-size:14px">Hormat kami,</p>
                            <p class="mb-0 font-weight-bold name" style="font-size:18px;color:#1f2937;margin-top:50px;text-decoration:underline">{{ $pengumuman->pembuat }}</p>
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Footer Info --}}
                <div class="card-footer no-print" style="background:#f8f9fa;border-top:1px solid #e5e7eb;padding:20px">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted">
                                <i class="fas fa-tag mr-2"></i>
                                <strong>Jenis:</strong> 
                                <span class="badge badge-{{ $pengumuman->jenis == 'info' ? 'primary' : ($pengumuman->jenis == 'warning' ? 'warning' : ($pengumuman->jenis == 'success' ? 'success' : 'danger')) }}">
                                    {{ strtoupper($pengumuman->jenis) }}
                                </span>
                            </small>
                        </div>
                        <div class="col-md-6 text-right">
                            <small class="text-muted">
                                <i class="far fa-clock mr-2"></i>
                                Dibuat: {{ $pengumuman->created_at->format('d M Y, H:i') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Action Cards --}}
            <div class="row mt-4 no-print">
                @if($pengumuman->user && $pengumuman->user->role == 'admin')
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm" style="border-radius:12px;border:none">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-edit fa-3x text-warning mb-3"></i>
                            <h5 class="font-weight-bold mb-2">Edit Pengumuman</h5>
                            <p class="text-muted mb-3">Ubah isi atau informasi pengumuman</p>
                            <a href="{{ route('admin.pengumuman.edit', $pengumuman->id) }}" class="btn btn-warning btn-block" style="border-radius:8px">
                                <i class="fas fa-edit mr-2"></i>Edit Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm" style="border-radius:12px;border:none">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-trash fa-3x text-danger mb-3"></i>
                            <h5 class="font-weight-bold mb-2">Hapus Pengumuman</h5>
                            <p class="text-muted mb-3">Hapus pengumuman secara permanen</p>
                            <form action="{{ route('admin.pengumuman.destroy', $pengumuman->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-block" style="border-radius:8px">
                                    <i class="fas fa-trash mr-2"></i>Hapus Sekarang
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="col-12">
                    <div class="alert alert-info" style="border-radius:12px;border:none;border-left:4px solid #3b82f6">
                        <i class="fas fa-info-circle mr-2"></i>
                        <strong>Info:</strong> Pengumuman ini dibuat oleh {{ ucfirst($pengumuman->user->role ?? 'user lain') }}. Anda tidak dapat mengedit atau menghapusnya.
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    @page {
        margin: 1.5cm 2cm;
        size: A4 portrait;
    }
    
    body {
        background: white !important;
        font-size: 11pt;
        line-height: 1.6;
    }
    
    .no-print {
        display: none !important;
    }
    
    .print-only {
        display: block !important;
    }
    
    .card {
        box-shadow: none !important;
        border: none !important;
        border-radius: 0 !important;
        page-break-inside: avoid;
    }
    
    .card-body {
        padding: 15px !important;
        background: white !important;
    }
    
    .kop-surat {
        page-break-inside: avoid;
        margin-bottom: 15px !important;
        padding-bottom: 15px !important;
    }
    
    .pengumuman-content {
        font-size: 11pt !important;
        line-height: 1.8 !important;
        margin: 15px 0 !important;
    }
    
    .signature {
        margin-top: 25px !important;
    }
    
    .signature .name {
        margin-top: 45px !important;
    }
}

.pengumuman-content {
    min-height: 200px;
}

.pengumuman-content p {
    margin-bottom: 1rem;
}
</style>

@push('scripts')
<script>
function printPengumuman() {
    window.print();
}

// Keyboard shortcut
document.addEventListener('keydown', function(e) {
    // Ctrl+P untuk print
    if (e.ctrlKey && e.key === 'p') {
        e.preventDefault();
        printPengumuman();
    }
    // ESC untuk kembali
    if (e.key === 'Escape') {
        window.location.href = '{{ route("admin.pengumuman.index") }}';
    }
});
</script>
@endpush
@endsection
