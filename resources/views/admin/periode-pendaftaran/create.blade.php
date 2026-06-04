@extends('layouts.app')
@section('title', 'Buat Periode Pendaftaran')
@section('page-title', 'Buat Periode Pendaftaran')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Pengaturan</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.periode-pendaftaran.index') }}">Periode Pendaftaran</a></li>
    <li class="breadcrumb-item active">Buat Baru</li>
@endsection

@push('styles')
<style>
.form-control:focus {
    border-color: #10b981;
    box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.15);
}
.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4) !important;
}
</style>
@endpush

@section('content')
{{-- Header Actions --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <a href="{{ route('admin.periode-pendaftaran.index') }}" class="btn btn-secondary" style="border-radius:10px;padding:10px 24px;font-weight:600">
        <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
</div>
<div class="card" style="border-radius:16px;box-shadow:0 8px 30px rgba(0,0,0,.08);border:none">
    <div class="card-header" style="background:linear-gradient(135deg,#10b981,#059669);border-radius:16px 16px 0 0;padding:20px">
        <h3 class="card-title" style="color:#fff;font-weight:700;font-size:18px">
            <i class="fas fa-plus-circle mr-2"></i>Form Periode Baru
        </h3>
    </div>
    
    <form action="{{ route('admin.periode-pendaftaran.store') }}" method="POST">
        @csrf
        
        <div class="card-body" style="padding:30px">
            {{-- Nama Periode --}}
            <div class="form-group">
                <label for="nama_periode" style="font-weight:700;color:#1a3a6e;font-size:14px">
                    <i class="fas fa-tag mr-1" style="color:#f5a623"></i>Nama Periode <span class="text-danger">*</span>
                </label>
                <input type="text" 
                       class="form-control @error('nama_periode') is-invalid @enderror" 
                       id="nama_periode" 
                       name="nama_periode" 
                       value="{{ old('nama_periode') }}"
                       placeholder="Contoh: Pendaftaran Anggota Gelombang 1"
                       style="border-radius:10px;padding:12px 16px;border:2px solid #e9ecef;font-size:14px"
                       required>
                @error('nama_periode')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">
                    <i class="fas fa-info-circle mr-1"></i>Masukkan nama periode pendaftaran yang jelas
                </small>
            </div>

            {{-- Tahun Ajaran --}}
            <div class="form-group">
                <label for="tahun_ajaran" style="font-weight:700;color:#1a3a6e;font-size:14px">
                    <i class="fas fa-calendar-alt mr-1" style="color:#f5a623"></i>Tahun Ajaran <span class="text-danger">*</span>
                </label>
                <input type="text" 
                       class="form-control @error('tahun_ajaran') is-invalid @enderror" 
                       id="tahun_ajaran" 
                       name="tahun_ajaran" 
                       value="{{ old('tahun_ajaran') }}"
                       placeholder="Contoh: 2026/2027"
                       style="border-radius:10px;padding:12px 16px;border:2px solid #e9ecef;font-size:14px"
                       required>
                @error('tahun_ajaran')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">
                    <i class="fas fa-info-circle mr-1"></i>Format: YYYY/YYYY (contoh: 2026/2027)
                </small>
            </div>

            <div class="row">
                {{-- Tanggal Mulai --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_mulai" style="font-weight:700;color:#1a3a6e;font-size:14px">
                            <i class="fas fa-calendar-check mr-1" style="color:#10b981"></i>Tanggal Mulai <span class="text-danger">*</span>
                        </label>
                        <input type="date" 
                               class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                               id="tanggal_mulai" 
                               name="tanggal_mulai" 
                               value="{{ old('tanggal_mulai') }}"
                               style="border-radius:10px;padding:12px 16px;border:2px solid #e9ecef;font-size:14px"
                               required>
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Selesai --}}
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_selesai" style="font-weight:700;color:#1a3a6e;font-size:14px">
                            <i class="fas fa-calendar-times mr-1" style="color:#dc3545"></i>Tanggal Selesai <span class="text-danger">*</span>
                        </label>
                        <input type="date" 
                               class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                               id="tanggal_selesai" 
                               name="tanggal_selesai" 
                               value="{{ old('tanggal_selesai') }}"
                               style="border-radius:10px;padding:12px 16px;border:2px solid #e9ecef;font-size:14px"
                               required>
                        @error('tanggal_selesai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            {{-- Kuota --}}
            <div class="form-group">
                <label for="kuota" style="font-weight:700;color:#1a3a6e;font-size:14px">
                    <i class="fas fa-users mr-1" style="color:#f5a623"></i>Kuota Pendaftar
                </label>
                <input type="number" 
                       class="form-control @error('kuota') is-invalid @enderror" 
                       id="kuota" 
                       name="kuota" 
                       value="{{ old('kuota') }}"
                       placeholder="Contoh: 100"
                       min="1"
                       style="border-radius:10px;padding:12px 16px;border:2px solid #e9ecef;font-size:14px">
                @error('kuota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">
                    <i class="fas fa-info-circle mr-1"></i>Kosongkan jika tidak ada batasan kuota
                </small>
            </div>

            {{-- Deskripsi --}}
            <div class="form-group">
                <label for="deskripsi" style="font-weight:700;color:#1a3a6e;font-size:14px">
                    <i class="fas fa-align-left mr-1" style="color:#f5a623"></i>Deskripsi
                </label>
                <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                          id="deskripsi" 
                          name="deskripsi" 
                          rows="4"
                          placeholder="Masukkan deskripsi atau keterangan tambahan tentang periode pendaftaran ini..."
                          style="border-radius:10px;padding:12px 16px;border:2px solid #e9ecef;font-size:14px">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Info --}}
            <div class="alert" style="background:linear-gradient(135deg,#fff8f0,#fef3e8);border:2px solid #f5a623;border-radius:12px;padding:16px">
                <div style="display:flex;align-items:center;gap:12px">
                    <i class="fas fa-info-circle" style="font-size:24px;color:#f5a623"></i>
                    <div>
                        <strong style="color:#1a3a6e;font-size:14px">Informasi:</strong>
                        <p style="margin:8px 0 0;color:#6c757d;font-size:13px">
                            Periode yang baru dibuat akan berstatus <strong>NONAKTIF</strong>. Anda dapat mengaktifkannya setelah periode dibuat.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer" style="background:#f8f9fa;border-radius:0 0 16px 16px;padding:20px">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.periode-pendaftaran.index') }}" class="btn btn-secondary" style="border-radius:10px;padding:10px 24px;font-weight:600">
                    <i class="fas fa-times mr-1"></i> Batal
                </a>
                <button type="submit" class="btn btn-success" style="background:linear-gradient(135deg,#10b981,#059669);border:none;border-radius:10px;padding:10px 24px;font-weight:600;box-shadow:0 4px 15px rgba(16,185,129,.3)">
                    <i class="fas fa-save mr-1"></i> Simpan Periode
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Validasi tanggal selesai harus lebih besar dari tanggal mulai
    $('#tanggal_selesai').on('change', function() {
        var tanggalMulai = new Date($('#tanggal_mulai').val());
        var tanggalSelesai = new Date($(this).val());
        
        if (tanggalSelesai <= tanggalMulai) {
            alert('Tanggal selesai harus lebih besar dari tanggal mulai!');
            $(this).val('');
        }
    });
});
</script>
@endpush
