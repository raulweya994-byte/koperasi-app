@extends('layouts.app')
@section('title', 'Tambah Periode Bantuan')

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
                                <h3 class="page-header-title">Tambah Periode Bantuan</h3>
                                <p class="page-header-subtitle">Buat periode baru untuk penerimaan pengajuan bantuan</p>
                            </div>
                        </div>
                        <div>
                            <a href="{{ route('admin.periode-bantuan.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <i class="fas fa-edit"></i> Form Periode Bantuan
                    </h5>
                </div>
                
                <div class="content-card-body">
                    <form action="{{ route('admin.periode-bantuan.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label>Nama Periode <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="nama_periode" 
                                   class="form-control @error('nama_periode') is-invalid @enderror" 
                                   value="{{ old('nama_periode') }}"
                                   placeholder="Contoh: Periode Bantuan Januari 2026"
                                   required>
                            @error('nama_periode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" 
                                      class="form-control @error('deskripsi') is-invalid @enderror" 
                                      rows="3"
                                      placeholder="Deskripsi singkat tentang periode bantuan ini...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Mulai <span class="text-danger">*</span></label>
                                    <input type="date" 
                                           name="tanggal_mulai" 
                                           class="form-control @error('tanggal_mulai') is-invalid @enderror" 
                                           value="{{ old('tanggal_mulai') }}"
                                           required>
                                    @error('tanggal_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tanggal Selesai <span class="text-danger">*</span></label>
                                    <input type="date" 
                                           name="tanggal_selesai" 
                                           class="form-control @error('tanggal_selesai') is-invalid @enderror" 
                                           value="{{ old('tanggal_selesai') }}"
                                           required>
                                    @error('tanggal_selesai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kuota Penerima</label>
                                    <input type="number" 
                                           name="kuota_penerima" 
                                           class="form-control @error('kuota_penerima') is-invalid @enderror" 
                                           value="{{ old('kuota_penerima') }}"
                                           min="1"
                                           placeholder="Kosongkan jika tidak terbatas">
                                    <small class="text-muted">Jumlah maksimal penerima bantuan</small>
                                    @error('kuota_penerima')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Anggaran Total</label>
                                    <input type="number" 
                                           name="anggaran_total" 
                                           class="form-control @error('anggaran_total') is-invalid @enderror" 
                                           value="{{ old('anggaran_total') }}"
                                           min="0"
                                           step="0.01"
                                           placeholder="0">
                                    <small class="text-muted">Total anggaran yang dialokasikan (Rp)</small>
                                    @error('anggaran_total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Catatan:</strong> Periode akan dibuat dengan status <strong>Nonaktif</strong>. 
                            Anda dapat mengaktifkannya setelah periode dibuat.
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary-modern">
                                <i class="fas fa-save me-1"></i> Simpan Periode
                            </button>
                            <a href="{{ route('admin.periode-bantuan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
