@extends('layouts.app')
@section('title', 'Tambah Program Bantuan')

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
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Tambah Program Bantuan</h3>
                                <p class="page-header-subtitle">Buat program bantuan baru untuk koperasi</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('petugas.bantuan.index') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Info --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info-modern">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Informasi:</strong> Lengkapi formulir di bawah ini untuk menambahkan program bantuan baru. 
                    Pastikan semua data yang diisi sudah benar.
                </div>
            </div>
        </div>
    </div>

    {{-- Error Messages --}}
    @if ($errors->any())
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-danger-modern alert-dismissible fade show">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>Terdapat kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    <form action="{{ route('petugas.bantuan.store') }}" method="POST" class="form-modern">
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
                                <option value="">-- Pilih Jenis --</option>
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

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" 
                                      class="form-control @error('deskripsi') is-invalid @enderror"
                                      rows="4"
                                      placeholder="Jelaskan detail program bantuan ini...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                <div class="form-group">
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
                        <div class="form-group">
                            <label>Total Anggaran <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" style="background:#1a3a6e;color:white;border:none">
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
                                Masukkan total anggaran dalam Rupiah
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
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="aktif" selected>Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                            </select>
                            <small class="text-muted">
                                Status program bantuan
                            </small>
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="content-card" style="background:linear-gradient(135deg,#e0f2fe,#bae6fd);border:none">
                    <div class="content-card-body">
                        <div class="text-center">
                            <i class="fas fa-lightbulb fa-3x text-primary mb-3"></i>
                            <h6 class="font-weight-bold text-primary">Tips</h6>
                            <p class="small text-muted mb-0">
                                Pastikan data yang diisi sudah benar sebelum menyimpan. 
                                Anda dapat mengubah data ini nanti di menu edit.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="content-card">
                    <div class="content-card-body">
                        <button type="submit" class="btn btn-success-modern btn-block mb-2">
                            <i class="fas fa-save"></i> Simpan Bantuan
                        </button>
                        <button type="reset" class="btn btn-secondary btn-block mb-2">
                            <i class="fas fa-redo"></i> Reset Form
                        </button>
                        <a href="{{ route('petugas.bantuan.index') }}" class="btn btn-outline-secondary btn-block">
                            <i class="fas fa-times"></i> Batal
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
            confirmButtonText: 'Ya, Reset!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form')[0].reset();
            }
        });
    });
});
</script>
@endpush

