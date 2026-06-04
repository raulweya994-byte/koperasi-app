@extends('layouts.app')
@section('title', 'Edit Periode Bantuan')

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
                                <i class="fas fa-edit"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Edit Periode Bantuan</h3>
                                <p class="page-header-subtitle">Perbarui informasi periode bantuan</p>
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
                        <i class="fas fa-edit"></i> Form Edit Periode
                    </h5>
                </div>
                
                <div class="content-card-body">
                    <form action="{{ route('admin.periode-bantuan.update', $periodeBantuan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label>Nama Periode <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="nama_periode" 
                                   class="form-control @error('nama_periode') is-invalid @enderror" 
                                   value="{{ old('nama_periode', $periodeBantuan->nama_periode) }}"
                                   required>
                            @error('nama_periode')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" 
                                      class="form-control @error('deskripsi') is-invalid @enderror" 
                                      rows="3">{{ old('deskripsi', $periodeBantuan->deskripsi) }}</textarea>
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
                                           value="{{ old('tanggal_mulai', $periodeBantuan->tanggal_mulai->format('Y-m-d')) }}"
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
                                           value="{{ old('tanggal_selesai', $periodeBantuan->tanggal_selesai->format('Y-m-d')) }}"
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
                                           value="{{ old('kuota_penerima', $periodeBantuan->kuota_penerima) }}"
                                           min="1">
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
                                           value="{{ old('anggaran_total', $periodeBantuan->anggaran_total) }}"
                                           min="0"
                                           step="0.01">
                                    <small class="text-muted">Total anggaran yang dialokasikan (Rp)</small>
                                    @error('anggaran_total')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Perhatian:</strong> Periode ini memiliki <strong>{{ $periodeBantuan->jumlahPengajuan() }} pengajuan</strong>. 
                            Perubahan data dapat mempengaruhi pengajuan yang sudah ada.
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary-modern">
                                <i class="fas fa-save me-1"></i> Update Periode
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
