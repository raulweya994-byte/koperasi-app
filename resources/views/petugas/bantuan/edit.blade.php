@extends('layouts.app')
@section('title', 'Edit Program Bantuan')

@push('styles')
<style>
    /* Header Card */
    .edit-header-card {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        border-radius: 16px;
        border: none;
        box-shadow: 0 8px 24px rgba(245, 158, 11, 0.3);
        margin-bottom: 24px;
        overflow: hidden;
    }
    
    .edit-header-content {
        padding: 30px;
        color: white;
    }
    
    .edit-header-icon {
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
    
    /* Form Card */
    .form-card {
        background: white;
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .form-card-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 20px 24px;
        border-bottom: 2px solid #e9ecef;
    }
    
    .form-card-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .form-card-body {
        padding: 30px;
    }
    
    /* Form Groups */
    .form-group-modern {
        margin-bottom: 24px;
    }
    
    .form-label-modern {
        font-weight: 600;
        color: #475569;
        font-size: 14px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .form-label-modern i {
        color: #94a3b8;
        font-size: 13px;
    }
    
    .required-star {
        color: #ef4444;
        margin-left: 4px;
    }
    
    .form-control-modern {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.3s ease;
        background: #f8fafc;
    }
    
    .form-control-modern:focus {
        border-color: #f59e0b;
        box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1);
        background: white;
    }
    
    .form-control-modern:disabled {
        background: #f1f5f9;
        color: #94a3b8;
        cursor: not-allowed;
    }
    
    .form-text-modern {
        font-size: 12px;
        color: #64748b;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .form-text-modern i {
        font-size: 11px;
    }
    
    /* Select Modern */
    select.form-control-modern {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 16px center;
        padding-right: 40px;
    }
    
    /* Textarea Modern */
    textarea.form-control-modern {
        resize: vertical;
        min-height: 120px;
    }
    
    /* Input Group */
    .input-group-modern {
        position: relative;
    }
    
    .input-group-text-modern {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 14px;
        pointer-events: none;
        z-index: 10;
    }
    
    .input-group-modern .form-control-modern {
        padding-left: 45px;
    }
    
    /* Alert Modern */
    .alert-modern {
        border-radius: 12px;
        border: none;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: start;
        gap: 12px;
    }
    
    .alert-danger-modern {
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        color: #991b1b;
        border-left: 4px solid #ef4444;
    }
    
    .alert-danger-modern i {
        font-size: 20px;
        margin-top: 2px;
    }
    
    .alert-danger-modern ul {
        margin-bottom: 0;
        padding-left: 20px;
    }
    
    /* Buttons */
    .btn-save-modern {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        padding: 12px 32px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .btn-save-modern:hover {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
        color: white;
    }
    
    .btn-cancel-modern {
        background: white;
        color: #64748b;
        border: 2px solid #e2e8f0;
        padding: 12px 32px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-cancel-modern:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #475569;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .btn-back-modern {
        background: white;
        color: #64748b;
        border: 2px solid #e2e8f0;
        padding: 10px 24px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-back-modern:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        color: #475569;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    /* Invalid Feedback */
    .invalid-feedback-modern {
        color: #ef4444;
        font-size: 12px;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    
    .is-invalid-modern {
        border-color: #ef4444 !important;
        background: #fef2f2 !important;
    }
    
    /* Info Box */
    .info-box-modern {
        background: linear-gradient(135deg, #dbeafe 0%, #bfdbfe 100%);
        border-left: 4px solid #3b82f6;
        border-radius: 10px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: flex;
        align-items: start;
        gap: 12px;
    }
    
    .info-box-modern i {
        color: #1e40af;
        font-size: 20px;
        margin-top: 2px;
    }
    
    .info-box-modern .info-content {
        flex: 1;
    }
    
    .info-box-modern .info-title {
        font-weight: 600;
        color: #1e40af;
        margin-bottom: 4px;
        font-size: 14px;
    }
    
    .info-box-modern .info-text {
        color: #1e3a8a;
        font-size: 13px;
        margin-bottom: 0;
    }
    
    /* Disabled Badge */
    .disabled-badge {
        background: #f1f5f9;
        color: #64748b;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="edit-header-card">
        <div class="edit-header-content">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <div class="edit-header-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div>
                        <h3 class="mb-1" style="font-size: 28px; font-weight: 700;">Edit Program Bantuan</h3>
                        <p class="mb-0" style="font-size: 14px; opacity: 0.9;">
                            <i class="fas fa-tag mr-2"></i>{{ $bantuan->kode_bantuan }}
                            <span class="mx-2">•</span>
                            {{ $bantuan->nama_bantuan }}
                        </p>
                    </div>
                </div>
                <div class="d-none d-md-block">
                    <a href="{{ route('petugas.bantuan.show', $bantuan) }}" class="btn btn-back-modern">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Errors --}}
    @if ($errors->any())
    <div class="alert-modern alert-danger-modern">
        <i class="fas fa-exclamation-circle"></i>
        <div>
            <strong>Terdapat kesalahan pada form:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    {{-- Info Box --}}
    <div class="info-box-modern">
        <i class="fas fa-info-circle"></i>
        <div class="info-content">
            <div class="info-title">Informasi Penting</div>
            <p class="info-text">
                Pastikan data yang Anda masukkan sudah benar. Kode bantuan tidak dapat diubah setelah dibuat.
                @if($bantuan->penerima->count() > 0)
                    Kuota minimal harus sama dengan jumlah penerima yang sudah ada ({{ $bantuan->penerima->count() }} koperasi).
                @endif
            </p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="form-card">
        <div class="form-card-header">
            <h5 class="form-card-title">
                <i class="fas fa-file-alt text-warning"></i>
                Form Edit Program Bantuan
            </h5>
        </div>
        <div class="form-card-body">
            <form action="{{ route('petugas.bantuan.update', $bantuan) }}" method="POST" id="editForm">
                @csrf
                @method('PUT')

                <div class="row">
                    {{-- Nama Bantuan --}}
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-file-signature"></i>
                                Nama Bantuan
                                <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   name="nama_bantuan"
                                   class="form-control form-control-modern @error('nama_bantuan') is-invalid-modern @enderror"
                                   value="{{ old('nama_bantuan', $bantuan->nama_bantuan) }}" 
                                   placeholder="Masukkan nama program bantuan"
                                   required>
                            @error('nama_bantuan')
                                <div class="invalid-feedback-modern">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Jenis Bantuan --}}
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-layer-group"></i>
                                Jenis Bantuan
                                <span class="required-star">*</span>
                            </label>
                            <select name="jenis_bantuan"
                                    class="form-control form-control-modern @error('jenis_bantuan') is-invalid-modern @enderror" 
                                    required>
                                <option value="">Pilih Jenis Bantuan</option>
                                @foreach (['tunai', 'barang', 'pelatihan', 'lainnya'] as $jenis)
                                    <option value="{{ $jenis }}"
                                        @selected(old('jenis_bantuan', $bantuan->jenis_bantuan) == $jenis)>
                                        {{ ucfirst($jenis) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_bantuan')
                                <div class="invalid-feedback-modern">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tahun --}}
                    <div class="col-md-3">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-calendar"></i>
                                Tahun
                                <span class="required-star">*</span>
                            </label>
                            <input type="number" 
                                   name="tahun"
                                   class="form-control form-control-modern @error('tahun') is-invalid-modern @enderror"
                                   value="{{ old('tahun', $bantuan->tahun) }}"
                                   min="2020" 
                                   max="2099" 
                                   placeholder="2026"
                                   required>
                            @error('tahun')
                                <div class="invalid-feedback-modern">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Periode --}}
                    <div class="col-md-3">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-clock"></i>
                                Periode
                                <span class="required-star">*</span>
                            </label>
                            <input type="text" 
                                   name="periode"
                                   class="form-control form-control-modern @error('periode') is-invalid-modern @enderror"
                                   value="{{ old('periode', $bantuan->periode) }}"
                                   placeholder="Semester 1"
                                   required>
                            @error('periode')
                                <div class="invalid-feedback-modern">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text-modern">
                                <i class="fas fa-info-circle"></i>
                                Contoh: Semester 1, Triwulan I, dll
                            </div>
                        </div>
                    </div>

                    {{-- Kuota --}}
                    <div class="col-md-3">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-users"></i>
                                Kuota
                                <span class="required-star">*</span>
                            </label>
                            <input type="number" 
                                   name="kuota"
                                   class="form-control form-control-modern @error('kuota') is-invalid-modern @enderror"
                                   value="{{ old('kuota', $bantuan->kuota) }}"
                                   min="{{ $bantuan->penerima->count() ?: 1 }}"
                                   placeholder="1232"
                                   required>
                            @error('kuota')
                                <div class="invalid-feedback-modern">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            @if($bantuan->penerima->count() > 0)
                            <div class="form-text-modern">
                                <i class="fas fa-info-circle"></i>
                                Minimal {{ $bantuan->penerima->count() }} (jumlah penerima saat ini)
                            </div>
                            @endif
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="col-md-3">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-toggle-on"></i>
                                Status
                                <span class="required-star">*</span>
                            </label>
                            <select name="status"
                                    class="form-control form-control-modern @error('status') is-invalid-modern @enderror" 
                                    required>
                                <option value="">Pilih Status</option>
                                @foreach (['aktif', 'nonaktif'] as $status)
                                    <option value="{{ $status }}"
                                        @selected(old('status', $bantuan->status) == $status)>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback-modern">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Anggaran --}}
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-money-bill-wave"></i>
                                Anggaran (Rp)
                                <span class="required-star">*</span>
                            </label>
                            <div class="input-group-modern">
                                <span class="input-group-text-modern">Rp</span>
                                <input type="number" 
                                       name="anggaran"
                                       class="form-control form-control-modern @error('anggaran') is-invalid-modern @enderror"
                                       value="{{ old('anggaran', $bantuan->anggaran) }}"
                                       min="0" 
                                       step="1000"
                                       placeholder="8000"
                                       required>
                            </div>
                            @error('anggaran')
                                <div class="invalid-feedback-modern">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    {{-- Kode Bantuan (Disabled) --}}
                    <div class="col-md-6">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-barcode"></i>
                                Kode Bantuan
                            </label>
                            <input type="text" 
                                   class="form-control form-control-modern" 
                                   value="{{ $bantuan->kode_bantuan }}" 
                                   disabled>
                            <div class="form-text-modern">
                                <i class="fas fa-lock"></i>
                                Kode tidak dapat diubah
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-12">
                        <div class="form-group-modern">
                            <label class="form-label-modern">
                                <i class="fas fa-align-left"></i>
                                Deskripsi Program
                            </label>
                            <textarea name="deskripsi"
                                      class="form-control form-control-modern @error('deskripsi') is-invalid-modern @enderror"
                                      placeholder="Masukkan deskripsi program bantuan (opsional)">{{ old('deskripsi', $bantuan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback-modern">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex gap-3 mt-4 pt-4" style="border-top: 2px solid #f1f5f9;">
                    <button type="submit" class="btn-save-modern">
                        <i class="fas fa-save"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('petugas.bantuan.show', $bantuan) }}" class="btn-cancel-modern">
                        <i class="fas fa-times"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Format number input for anggaran
    $('input[name="anggaran"]').on('input', function() {
        var value = $(this).val();
        // Remove non-numeric characters except for decimal point
        value = value.replace(/[^0-9]/g, '');
        $(this).val(value);
    });
    
    // Form validation
    $('#editForm').on('submit', function(e) {
        var isValid = true;
        
        // Check required fields
        $(this).find('[required]').each(function() {
            if (!$(this).val()) {
                isValid = false;
                $(this).addClass('is-invalid-modern');
            } else {
                $(this).removeClass('is-invalid-modern');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Form Tidak Lengkap',
                text: 'Mohon lengkapi semua field yang wajib diisi',
                confirmButtonColor: '#ef4444'
            });
        }
    });
    
    // Remove invalid class on input
    $('.form-control-modern').on('input change', function() {
        $(this).removeClass('is-invalid-modern');
    });
});
</script>
@endpush

