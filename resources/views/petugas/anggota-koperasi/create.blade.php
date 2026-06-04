@extends('layouts.app')
@section('title', 'Tambah Anggota Koperasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px">
                <div class="card-header" style="background:linear-gradient(135deg,#10b981,#059669);color:white;border-radius:16px 16px 0 0">
                    <h4 class="mb-0"><i class="fas fa-user-plus mr-2"></i>Tambah Anggota Koperasi Baru</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('petugas.anggota-koperasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- Pilih Koperasi --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#10b981">
                                <i class="fas fa-store mr-2"></i>Pilih Koperasi
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Koperasi <span class="text-danger">*</span></label>
                                        <select name="koperasi_id" class="form-control @error('koperasi_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih Koperasi --</option>
                                            @foreach($koperasiList as $kop)
                                            <option value="{{ $kop->id }}" {{ old('koperasi_id') == $kop->id ? 'selected' : '' }}>
                                                {{ $kop->nama_usaha }} ({{ $kop->no_registrasi }})
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('koperasi_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Data Pribadi --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#10b981">
                                <i class="fas fa-id-card mr-2"></i>Data Pribadi
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">NIK <span class="text-danger">*</span></label>
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" required>
                                        @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                                        @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir') }}" required>
                                        @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir') }}" required>
                                        @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Agama</label>
                                        <select name="agama" class="form-control @error('agama') is-invalid @enderror">
                                            <option value="">-- Pilih --</option>
                                            <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                            <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                            <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                            <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                        </select>
                                        @error('agama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Status Perkawinan</label>
                                        <select name="status_perkawinan" class="form-control @error('status_perkawinan') is-invalid @enderror">
                                            <option value="">-- Pilih --</option>
                                            <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                                            <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                                            <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                            <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                        </select>
                                        @error('status_perkawinan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Pendidikan Terakhir</label>
                                        <select name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror">
                                            <option value="">-- Pilih --</option>
                                            <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
                                            <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP</option>
                                            <option value="SMA/SMK" {{ old('pendidikan_terakhir') == 'SMA/SMK' ? 'selected' : '' }}>SMA/SMK</option>
                                            <option value="D3" {{ old('pendidikan_terakhir') == 'D3' ? 'selected' : '' }}>D3</option>
                                            <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                                            <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>S2</option>
                                            <option value="S3" {{ old('pendidikan_terakhir') == 'S3' ? 'selected' : '' }}>S3</option>
                                        </select>
                                        @error('pendidikan_terakhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan') }}">
                                        @error('pekerjaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Kontak & Alamat --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#10b981">
                                <i class="fas fa-phone mr-2"></i>Kontak & Alamat
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">No. HP <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                                        @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Desa</label>
                                        <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror" value="{{ old('desa') }}">
                                        @error('desa')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Distrik <span class="text-danger">*</span></label>
                                        <select name="distrik" class="form-control @error('distrik') is-invalid @enderror" required>
                                            <option value="">-- Pilih Distrik --</option>
                                            @foreach($distrikList as $dist)
                                            <option value="{{ $dist }}" {{ old('distrik') == $dist ? 'selected' : '' }}>{{ $dist }}</option>
                                            @endforeach
                                        </select>
                                        @error('distrik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Kabupaten</label>
                                        <input type="text" name="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror" value="{{ old('kabupaten', 'Tolikara') }}">
                                        @error('kabupaten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Data Usaha --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#10b981">
                                <i class="fas fa-briefcase mr-2"></i>Data Usaha (Opsional)
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nama Usaha</label>
                                        <input type="text" name="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror" value="{{ old('nama_usaha') }}">
                                        @error('nama_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Bidang Usaha</label>
                                        <input type="text" name="bidang_usaha" class="form-control @error('bidang_usaha') is-invalid @enderror" value="{{ old('bidang_usaha') }}">
                                        @error('bidang_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Modal Usaha (Rp)</label>
                                        <input type="number" name="modal_usaha" class="form-control @error('modal_usaha') is-invalid @enderror" value="{{ old('modal_usaha', 0) }}" min="0">
                                        @error('modal_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Omzet Per Bulan (Rp)</label>
                                        <input type="number" name="omzet_per_bulan" class="form-control @error('omzet_per_bulan') is-invalid @enderror" value="{{ old('omzet_per_bulan', 0) }}" min="0">
                                        @error('omzet_per_bulan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Simpanan --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#10b981">
                                <i class="fas fa-wallet mr-2"></i>Data Simpanan
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Simpanan Pokok (Rp)</label>
                                        <input type="number" name="simpanan_pokok" class="form-control @error('simpanan_pokok') is-invalid @enderror" value="{{ old('simpanan_pokok', 0) }}" min="0">
                                        @error('simpanan_pokok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Simpanan Wajib (Rp)</label>
                                        <input type="number" name="simpanan_wajib" class="form-control @error('simpanan_wajib') is-invalid @enderror" value="{{ old('simpanan_wajib', 0) }}" min="0">
                                        @error('simpanan_wajib')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Upload Foto --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#10b981">
                                <i class="fas fa-camera mr-2"></i>Upload Foto
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Foto Anggota</label>
                                        <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror" accept="image/*">
                                        <small class="text-muted">Format: JPG, JPEG, PNG. Max: 2MB</small>
                                        @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Foto KTP</label>
                                        <input type="file" name="foto_ktp" class="form-control-file @error('foto_ktp') is-invalid @enderror" accept="image/*">
                                        <small class="text-muted">Format: JPG, JPEG, PNG. Max: 2MB</small>
                                        @error('foto_ktp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-save mr-2"></i>Simpan Data
                            </button>
                            <a href="{{ route('petugas.anggota-koperasi.index') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times mr-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
