@extends('layouts.app')
@section('title', 'Edit Anggota Koperasi')
@section('page-title', 'Edit Anggota Koperasi')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('pimpinan.anggota-koperasi.index') }}">Data Anggota</a></li>
<li class="breadcrumb-item active">Edit Anggota</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#667eea,#764ba2);border-radius:16px 16px 0 0;border:none">
                    <h5 class="mb-0 text-white font-weight-bold">
                        <i class="fas fa-edit mr-2"></i>Form Edit Anggota Koperasi
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('pimpinan.anggota-koperasi.update', $anggota) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- Data Pribadi --}}
                        <h6 class="font-weight-bold mb-3" style="color:#667eea;border-bottom:2px solid #667eea;padding-bottom:8px">
                            <i class="fas fa-user mr-2"></i>DATA PRIBADI
                        </h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                                       value="{{ old('nama', $anggota->nama ?? $anggota->nama_lengkap) }}" required>
                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">NIK <span class="text-danger">*</span></label>
                                <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                                       value="{{ old('nik', $anggota->nik) }}" maxlength="16" required>
                                @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" 
                                       value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}" required>
                                @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                       value="{{ old('tanggal_lahir', $anggota->tanggal_lahir) }}" required>
                                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Status Perkawinan</label>
                                <select name="status_perkawinan" class="form-control @error('status_perkawinan') is-invalid @enderror">
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Kawin" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                    <option value="Kawin" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                    <option value="Cerai Hidup" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                    <option value="Cerai Mati" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                </select>
                                @error('status_perkawinan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Pendidikan Terakhir</label>
                                <select name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror">
                                    <option value="">Pilih Pendidikan</option>
                                    <option value="SD" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="D3" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'D3' ? 'selected' : '' }}>D3</option>
                                    <option value="S1" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>S2</option>
                                    <option value="S3" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'S3' ? 'selected' : '' }}>S3</option>
                                </select>
                                @error('pendidikan_terakhir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Agama</label>
                                <select name="agama" class="form-control @error('agama') is-invalid @enderror">
                                    <option value="">Pilih Agama</option>
                                    <option value="Islam" {{ old('agama', $anggota->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ old('agama', $anggota->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ old('agama', $anggota->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ old('agama', $anggota->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ old('agama', $anggota->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                    <option value="Konghucu" {{ old('agama', $anggota->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                </select>
                                @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">No. HP <span class="text-danger">*</span></label>
                                <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                                       value="{{ old('no_hp', $anggota->no_hp) }}" required>
                                @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Email</label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                       value="{{ old('email', $anggota->email) }}">
                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Distrik <span class="text-danger">*</span></label>
                                <select name="distrik" class="form-control @error('distrik') is-invalid @enderror" required>
                                    <option value="">Pilih Distrik</option>
                                    @foreach($distrikList as $distrik)
                                    <option value="{{ $distrik }}" {{ old('distrik', $anggota->distrik) == $distrik ? 'selected' : '' }}>{{ $distrik }}</option>
                                    @endforeach
                                </select>
                                @error('distrik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-12 mb-3">
                                <label class="font-weight-600">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea name="alamat_lengkap" class="form-control @error('alamat_lengkap') is-invalid @enderror" 
                                          rows="3" required>{{ old('alamat_lengkap', $anggota->alamat_lengkap ?? $anggota->alamat) }}</textarea>
                                @error('alamat_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        
                        {{-- Data Koperasi & Usaha --}}
                        <h6 class="font-weight-bold mb-3 mt-4" style="color:#667eea;border-bottom:2px solid #667eea;padding-bottom:8px">
                            <i class="fas fa-building mr-2"></i>DATA KOPERASI & USAHA
                        </h6>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Koperasi</label>
                                <select name="koperasi_id" class="form-control @error('koperasi_id') is-invalid @enderror">
                                    <option value="">Pilih Koperasi</option>
                                    @foreach($koperasiList as $kop)
                                    <option value="{{ $kop->id }}" {{ old('koperasi_id', $anggota->koperasi_id) == $kop->id ? 'selected' : '' }}>
                                        {{ $kop->nama_usaha }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('koperasi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Nama Usaha</label>
                                <input type="text" name="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror" 
                                       value="{{ old('nama_usaha', $anggota->nama_usaha) }}">
                                @error('nama_usaha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Bidang Usaha</label>
                                <input type="text" name="bidang_usaha" class="form-control @error('bidang_usaha') is-invalid @enderror" 
                                       value="{{ old('bidang_usaha', $anggota->bidang_usaha) }}">
                                @error('bidang_usaha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Simpanan Pokok (Rp)</label>
                                <input type="number" name="simpanan_pokok" class="form-control @error('simpanan_pokok') is-invalid @enderror" 
                                       value="{{ old('simpanan_pokok', $anggota->simpanan_pokok ?? 0) }}" min="0">
                                @error('simpanan_pokok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Simpanan Wajib (Rp)</label>
                                <input type="number" name="simpanan_wajib" class="form-control @error('simpanan_wajib') is-invalid @enderror" 
                                       value="{{ old('simpanan_wajib', $anggota->simpanan_wajib ?? 0) }}" min="0">
                                @error('simpanan_wajib')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Aktif" {{ old('status', $anggota->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Pending" {{ old('status', $anggota->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Nonaktif" {{ old('status', $anggota->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Tanggal Bergabung</label>
                                <input type="date" name="tanggal_bergabung" class="form-control @error('tanggal_bergabung') is-invalid @enderror" 
                                       value="{{ old('tanggal_bergabung', $anggota->tanggal_bergabung) }}">
                                @error('tanggal_bergabung')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-600">Foto</label>
                                @if($anggota->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $anggota->foto) }}" alt="Foto" class="img-thumbnail" style="max-width:150px">
                                    <p class="text-muted small mb-0">Foto saat ini</p>
                                </div>
                                @endif
                                <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                                @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted">Format: JPG, PNG. Max: 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
                            </div>
                        </div>
                        
                        <div class="mt-4 d-flex justify-content-between">
                            <a href="{{ route('pimpinan.anggota-koperasi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left mr-1"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i>Update Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
