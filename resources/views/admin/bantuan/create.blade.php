@extends('layouts.app')
@section('title', 'Tambah Program Bantuan')

@push('styles')
<style>
    /* Page Header Card */
    .page-header-card {
        background: linear-gradient(135deg, #1a3a6e 0%, #2c5282 100%);
        border-radius: 16px;
        border: none;
        box-shadow: 0 8px 24px rgba(26, 58, 110, 0.3);
        margin-bottom: 24px;
    }
    
    .page-header-icon {
        width: 70px;
        height: 70px;
        background: rgba(255,255,255,0.2);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin-right: 20px;
        backdrop-filter: blur(10px);
    }
    
    .page-header-title {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 4px;
        color: white;
    }
    
    .page-header-subtitle {
        font-size: 14px;
        opacity: 0.9;
        margin-bottom: 0;
        color: white;
    }
    
    /* Alert Modern */
    .alert-info-modern {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border: none;
        border-left: 4px solid #3b82f6;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: start;
        gap: 12px;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
    }
    
    .alert-info-modern i {
        color: #1e40af;
        font-size: 20px;
        margin-top: 2px;
    }
    
    .alert-danger-modern {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border: none;
        border-left: 4px solid #ef4444;
        border-radius: 12px;
        padding: 16px 20px;
        display: flex;
        align-items: start;
        gap: 12px;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.1);
    }
    
    .alert-danger-modern i {
        color: #991b1b;
        font-size: 20px;
        margin-top: 2px;
    }
    
    /* Content Card */
    .content-card {
        background: white;
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        margin-bottom: 24px;
        overflow: hidden;
    }
    
    .content-card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 20px 24px;
        border-bottom: 2px solid #e9ecef;
    }
    
    .content-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .content-card-title i {
        color: #1a3a6e;
    }
    
    .content-card-body {
        padding: 24px;
    }
    
    /* Form Modern */
    .form-modern label {
        font-weight: 600;
        color: #475569;
        font-size: 14px;
        margin-bottom: 8px;
    }
    
    .form-modern .form-control,
    .form-modern .form-select {
        border-radius: 10px;
        border: 2px solid #e2e8f0;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .form-modern .form-control:focus,
    .form-modern .form-select:focus {
        border-color: #1a3a6e;
        box-shadow: 0 0 0 4px rgba(26, 58, 110, 0.1);
        outline: none;
    }
    
    .form-modern .form-control::placeholder {
        color: #94a3b8;
    }
    
    .form-modern textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }
    
    .form-modern .input-group-text {
        background: #1a3a6e;
        color: white;
        border: none;
        border-radius: 10px 0 0 10px;
        font-weight: 600;
        padding: 12px 16px;
    }
    
    .form-modern .input-group .form-control {
        border-radius: 0 10px 10px 0;
    }
    
    /* Buttons */
    .btn-modern {
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        border: none;
    }
    
    .btn-success-modern {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .btn-success-modern:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
        color: white;
    }
    
    .btn-secondary {
        background: #6b7280;
        color: white;
    }
    
    .btn-secondary:hover {
        background: #4b5563;
        color: white;
    }
    
    .btn-outline-secondary {
        border: 2px solid #e2e8f0;
        color: #64748b;
        background: white;
    }
    
    .btn-outline-secondary:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #475569;
    }
    
    /* Info Box */
    .info-box-tips {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
        border: none;
        border-radius: 16px;
        padding: 24px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.1);
        margin-bottom: 24px;
    }
    
    .info-box-tips i {
        color: #1e40af;
        margin-bottom: 16px;
    }
    
    .info-box-tips h6 {
        color: #1e40af;
        font-weight: 700;
        margin-bottom: 12px;
    }
    
    .info-box-tips p {
        color: #475569;
        font-size: 13px;
        line-height: 1.6;
    }
    
    /* Invalid Feedback */
    .invalid-feedback {
        font-size: 13px;
        margin-top: 6px;
    }
    
    /* Small Text */
    .text-muted {
        font-size: 13px;
        color: #64748b;
    }
    
    /* Required Star */
    .text-danger {
        color: #ef4444;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row">
        <div class="col-12">
            <div class="card page-header-card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="page-header-icon">
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Tambah Program Bantuan</h3>
                                <p class="page-header-subtitle">Buat program bantuan baru untuk koperasi</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('admin.bantuan.index') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Info --}}
    <div class="row">
        <div class="col-12">
            <div class="alert-info-modern">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Informasi:</strong> Lengkapi formulir di bawah ini untuk menambahkan program bantuan baru. 
                    Pastikan semua data yang diisi sudah benar sebelum menyimpan.
                </div>
            </div>
        </div>
    </div>

    {{-- Error Messages --}}
    @if ($errors->any())
    <div class="row">
        <div class="col-12">
            <div class="alert-danger-modern alert-dismissible fade show">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>Terdapat kesalahan!</strong>
                    <ul class="mb-0 mt-2" style="padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="close" data-dismiss="alert" style="position: absolute; right: 20px; top: 16px;">
                    <span>&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('admin.bantuan.store') }}" method="POST" class="form-modern">
        @csrf
        
        <div class="row">
            {{-- Kolom Kiri --}}
            <div class="col-lg-8">
                {{-- Informasi Dasar --}}
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title mb-0">
                            <i class="fas fa-file-alt"></i> Informasi Dasar
                        </h5>
                    </div>
                    <div class="content-card-body">
                        <div class="form-group">
                            <label>Nama Bantuan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_bantuan" 
                                   class="form-control @error('nama_bantuan') is-invalid @enderror"
                                   value="{{ old('nama_bantuan') }}" 
                                   placeholder="Contoh: Bantuan Modal Usaha"
                                   required>
                            @error('nama_bantuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis Bantuan <span class="text-danger">*</span></label>
                            <select name="jenis_bantuan" 
                                    class="form-control @error('jenis_bantuan') is-invalid @enderror" 
                                    required>
                                <option value="">-- Pilih Jenis Bantuan --</option>
                                <option value="tunai" {{ old('jenis_bantuan') == 'tunai' ? 'selected' : '' }}>
                                    💰 Tunai
                                </option>
                                <option value="barang" {{ old('jenis_bantuan') == 'barang' ? 'selected' : '' }}>
                                    📦 Barang
                                </option>
                                <option value="pelatihan" {{ old('jenis_bantuan') == 'pelatihan' ? 'selected' : '' }}>
                                    🎓 Pelatihan
                                </option>
                                <option value="lainnya" {{ old('jenis_bantuan') == 'lainnya' ? 'selected' : '' }}>
                                    📋 Lainnya
                                </option>
                            </select>
                            @error('jenis_bantuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" 
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Jelaskan detail program bantuan ini...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Opsional - Jelaskan tujuan dan manfaat program bantuan
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Periode & Kuota --}}
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title mb-0">
                            <i class="fas fa-calendar-alt"></i> Periode & Kuota
                        </h5>
                    </div>
                    <div class="content-card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tahun <span class="text-danger">*</span></label>
                                    <input type="number" name="tahun" 
                                           class="form-control @error('tahun') is-invalid @enderror"
                                           value="{{ old('tahun', date('Y')) }}" 
                                           min="2020" max="2099" required>
                                    @error('tahun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Periode <span class="text-danger">*</span></label>
                                    <input type="text" name="periode" 
                                           class="form-control @error('periode') is-invalid @enderror"
                                           value="{{ old('periode') }}" 
                                           placeholder="Semester 1 / Triwulan I" 
                                           required>
                                    @error('periode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-0">
                                    <label>Kuota <span class="text-danger">*</span></label>
                                    <input type="number" name="kuota" 
                                           class="form-control @error('kuota') is-invalid @enderror"
                                           value="{{ old('kuota') }}" 
                                           min="1" placeholder="Jumlah penerima"
                                           required>
                                    @error('kuota')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Anggaran --}}
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title mb-0">
                            <i class="fas fa-money-bill-wave"></i> Anggaran
                        </h5>
                    </div>
                    <div class="content-card-body">
                        <div class="form-group mb-0">
                            <label>Total Anggaran <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Rp
                                    </span>
                                </div>
                                <input type="number" name="anggaran" 
                                       class="form-control @error('anggaran') is-invalid @enderror"
                                       value="{{ old('anggaran') }}" 
                                       min="0" step="1000" placeholder="0"
                                       required>
                                @error('anggaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Masukkan total anggaran dalam Rupiah (contoh: 50000000 untuk 50 juta)
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan --}}
            <div class="col-lg-4">
                {{-- Status --}}
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title mb-0">
                            <i class="fas fa-cog"></i> Pengaturan
                        </h5>
                    </div>
                    <div class="content-card-body">
                        <div class="form-group mb-0">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="aktif" selected>✅ Aktif</option>
                                <option value="nonaktif">⏸️ Nonaktif</option>
                            </select>
                            <small class="text-muted">
                                Status program bantuan saat ini
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="info-box-tips">
                    <i class="fas fa-lightbulb fa-3x"></i>
                    <h6>Tips</h6>
                    <p class="mb-0">
                        Pastikan data yang diisi sudah benar sebelum menyimpan. 
                        Anda dapat mengubah data ini nanti melalui menu edit program bantuan.
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="content-card">
                    <div class="content-card-body">
                        <button type="submit" class="btn btn-success-modern btn-block mb-2">
                            <i class="fas fa-save mr-2"></i>Simpan Bantuan
                        </button>
                        <button type="reset" class="btn btn-secondary btn-block mb-2">
                            <i class="fas fa-redo mr-2"></i>Reset Form
                        </button>
                        <a href="{{ route('admin.bantuan.index') }}" class="btn btn-outline-secondary btn-block">
                            <i class="fas fa-times mr-2"></i>Batal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Konfirmasi sebelum reset
    $('button[type="reset"]').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Reset Form?',
            text: "Semua input akan dikosongkan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#6b7280',
            cancelButtonColor: '#3b82f6',
            confirmButtonText: '<i class="fas fa-redo mr-2"></i>Ya, Reset!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form')[0].reset();
                Swal.fire({
                    icon: 'success',
                    title: 'Form Direset!',
                    text: 'Semua input telah dikosongkan',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        });
    });
    
    // Format angka pada input anggaran
    $('input[name="anggaran"]').on('input', function() {
        var value = $(this).val();
        if (value) {
            // Remove non-numeric characters
            value = value.replace(/\D/g, '');
            $(this).val(value);
        }
    });
    
    // Konfirmasi sebelum submit
    $('form.form-modern').on('submit', function(e) {
        e.preventDefault();
        var form = this;
        
        Swal.fire({
            title: 'Simpan Program Bantuan?',
            text: "Pastikan semua data sudah benar!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#10b981',
            cancelButtonColor: '#6b7280',
            confirmButtonText: '<i class="fas fa-save mr-2"></i>Ya, Simpan!',
            cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endpush
