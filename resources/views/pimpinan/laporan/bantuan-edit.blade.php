@extends('layouts.app')
@section('title', 'Edit Program Bantuan')
@section('page-title', 'Edit Program Bantuan')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('pimpinan.laporan.index') }}">Laporan</a></li>
<li class="breadcrumb-item"><a href="{{ route('pimpinan.laporan.bantuan') }}">Bantuan</a></li>
<li class="breadcrumb-item active">Edit Program</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#667eea,#764ba2);border-radius:16px 16px 0 0;border:none">
                    <h5 class="mb-0 text-white font-weight-bold">
                        <i class="fas fa-edit mr-2"></i>Form Edit Program Bantuan
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pimpinan.laporan.bantuan.update', $bantuan) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        {{-- Informasi Program --}}
                        <h6 class="font-weight-bold mb-3" style="color:#667eea;border-bottom:2px solid #667eea;padding-bottom:8px">
                            <i class="fas fa-info-circle mr-2"></i>INFORMASI PROGRAM
                        </h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Kode Program <span class="text-danger">*</span></label>
                                <input type="text" name="kode_bantuan" class="form-control @error('kode_bantuan') is-invalid @enderror" 
                                       value="{{ old('kode_bantuan', $bantuan->kode_bantuan) }}" placeholder="Contoh: BNT-2025-001" required>
                                @error('kode_bantuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">Format: BNT-TAHUN-NOMOR</small>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Tahun <span class="text-danger">*</span></label>
                                <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror" 
                                       value="{{ old('tahun', $bantuan->tahun) }}" min="2020" max="2100" required>
                                @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label class="font-weight-600">Nama Program <span class="text-danger">*</span></label>
                                <input type="text" name="nama_bantuan" class="form-control @error('nama_bantuan') is-invalid @enderror" 
                                       value="{{ old('nama_bantuan', $bantuan->nama_bantuan) }}" placeholder="Contoh: Bantuan Modal Usaha Koperasi" required>
                                @error('nama_bantuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Jenis Bantuan <span class="text-danger">*</span></label>
                                <select name="jenis_bantuan" class="form-control @error('jenis_bantuan') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Bantuan</option>
                                    <option value="uang" {{ old('jenis_bantuan', $bantuan->jenis_bantuan) == 'uang' ? 'selected' : '' }}>Uang</option>
                                    <option value="barang" {{ old('jenis_bantuan', $bantuan->jenis_bantuan) == 'barang' ? 'selected' : '' }}>Barang</option>
                                    <option value="pelatihan" {{ old('jenis_bantuan', $bantuan->jenis_bantuan) == 'pelatihan' ? 'selected' : '' }}>Pelatihan</option>
                                </select>
                                @error('jenis_bantuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="">Pilih Status</option>
                                    <option value="aktif" {{ old('status', $bantuan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="nonaktif" {{ old('status', $bantuan->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    <option value="selesai" {{ old('status', $bantuan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label class="font-weight-600">Deskripsi Program</label>
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                                          rows="3" placeholder="Jelaskan tujuan dan detail program bantuan...">{{ old('deskripsi', $bantuan->deskripsi) }}</textarea>
                                @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        
                        {{-- Anggaran & Kuota --}}
                        <h6 class="font-weight-bold mb-3 mt-4" style="color:#667eea;border-bottom:2px solid #667eea;padding-bottom:8px">
                            <i class="fas fa-money-bill-wave mr-2"></i>ANGGARAN & KUOTA
                        </h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Total Anggaran (Rp) <span class="text-danger">*</span></label>
                                <input type="number" name="anggaran" class="form-control @error('anggaran') is-invalid @enderror" 
                                       value="{{ old('anggaran', $bantuan->anggaran) }}" min="0" step="1000" required>
                                @error('anggaran')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">Masukkan total anggaran dalam Rupiah</small>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Kuota Penerima <span class="text-danger">*</span></label>
                                <input type="number" name="kuota" class="form-control @error('kuota') is-invalid @enderror" 
                                       value="{{ old('kuota', $bantuan->kuota) }}" min="1" required>
                                @error('kuota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">Jumlah maksimal penerima bantuan</small>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Satuan (untuk bantuan barang)</label>
                                <input type="text" name="satuan" class="form-control @error('satuan') is-invalid @enderror" 
                                       value="{{ old('satuan', $bantuan->satuan) }}" placeholder="Contoh: Unit, Paket, Kg">
                                @error('satuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">Kosongkan jika bantuan berupa uang</small>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Jumlah Penerima Saat Ini</label>
                                <input type="text" class="form-control" value="{{ $bantuan->jumlah_penerima }} dari {{ $bantuan->kuota }}" readonly>
                                <small class="text-muted">Data ini tidak dapat diubah secara manual</small>
                            </div>
                        </div>
                        
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('pimpinan.laporan.bantuan') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i>Update Program
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
