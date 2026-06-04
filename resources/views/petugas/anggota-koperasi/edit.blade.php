@extends('layouts.app')
@section('title', 'Edit Anggota Koperasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px">
                <div class="card-header" style="background:linear-gradient(135deg,#f59e0b,#d97706);color:white;border-radius:16px 16px 0 0">
                    <h4 class="mb-0"><i class="fas fa-user-edit mr-2"></i>Edit Anggota Koperasi</h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('petugas.anggota-koperasi.update', $anggotaKoperasi) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        {{-- Pilih Koperasi --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#f59e0b">
                                <i class="fas fa-store mr-2"></i>Pilih Koperasi
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Koperasi <span class="text-danger">*</span></label>
                                        <select name="koperasi_id" class="form-control @error('koperasi_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih Koperasi --</option>
                                            @foreach($koperasiList as $kop)
                                            <option value="{{ $kop->id }}" {{ (old('koperasi_id', $anggotaKoperasi->koperasi_id) == $kop->id) ? 'selected' : '' }}>
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
                            <h5 class="font-weight-bold mb-3" style="color:#f59e0b">
                                <i class="fas fa-id-card mr-2"></i>Data Pribadi
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">NIK <span class="text-danger">*</span></label>
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik', $anggotaKoperasi->nik) }}" required>
                                        @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $anggotaKoperasi->nama) }}" required>
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
                                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir', $anggotaKoperasi->tempat_lahir) }}" required>
                                        @error('tempat_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" value="{{ old('tanggal_lahir', $anggotaKoperasi->tanggal_lahir ? $anggotaKoperasi->tanggal_lahir->format('Y-m-d') : '') }}" required>
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
                                            <option value="L" {{ old('jenis_kelamin', $anggotaKoperasi->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin', $anggotaKoperasi->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                                            @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'] as $agama)
                                            <option value="{{ $agama }}" {{ old('agama', $anggotaKoperasi->agama) == $agama ? 'selected' : '' }}>{{ $agama }}</option>
                                            @endforeach
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
                                            @foreach(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'] as $status)
                                            <option value="{{ $status }}" {{ old('status_perkawinan', $anggotaKoperasi->status_perkawinan) == $status ? 'selected' : '' }}>{{ $status }}</option>
                                            @endforeach
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
                                            @foreach(['SD', 'SMP', 'SMA/SMK', 'D3', 'S1', 'S2', 'S3'] as $pend)
                                            <option value="{{ $pend }}" {{ old('pendidikan_terakhir', $anggotaKoperasi->pendidikan_terakhir) == $pend ? 'selected' : '' }}>{{ $pend }}</option>
                                            @endforeach
                                        </select>
                                        @error('pendidikan_terakhir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" class="form-control @error('pekerjaan') is-invalid @enderror" value="{{ old('pekerjaan', $anggotaKoperasi->pekerjaan) }}">
                                        @error('pekerjaan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Kontak & Alamat --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#f59e0b">
                                <i class="fas fa-phone mr-2"></i>Kontak & Alamat
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">No. HP <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp', $anggotaKoperasi->no_hp) }}" required>
                                        @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Email</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $anggotaKoperasi->email) }}">
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
                                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat', $anggotaKoperasi->alamat) }}</textarea>
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
                                        <input type="text" name="desa" class="form-control @error('desa') is-invalid @enderror" value="{{ old('desa', $anggotaKoperasi->desa) }}">
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
                                            <option value="{{ $dist }}" {{ old('distrik', $anggotaKoperasi->distrik) == $dist ? 'selected' : '' }}>{{ $dist }}</option>
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
                                        <input type="text" name="kabupaten" class="form-control @error('kabupaten') is-invalid @enderror" value="{{ old('kabupaten', $anggotaKoperasi->kabupaten ?? 'Tolikara') }}">
                                        @error('kabupaten')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Data Usaha --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#f59e0b">
                                <i class="fas fa-briefcase mr-2"></i>Data Usaha (Opsional)
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Nama Usaha</label>
                                        <input type="text" name="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror" value="{{ old('nama_usaha', $anggotaKoperasi->nama_usaha) }}">
                                        @error('nama_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Bidang Usaha</label>
                                        <input type="text" name="bidang_usaha" class="form-control @error('bidang_usaha') is-invalid @enderror" value="{{ old('bidang_usaha', $anggotaKoperasi->bidang_usaha) }}">
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
                                        <input type="number" name="modal_usaha" class="form-control @error('modal_usaha') is-invalid @enderror" value="{{ old('modal_usaha', $anggotaKoperasi->modal_usaha ?? 0) }}" min="0">
                                        @error('modal_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Omzet Per Bulan (Rp)</label>
                                        <input type="number" name="omzet_per_bulan" class="form-control @error('omzet_per_bulan') is-invalid @enderror" value="{{ old('omzet_per_bulan', $anggotaKoperasi->omzet_per_bulan ?? 0) }}" min="0">
                                        @error('omzet_per_bulan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Simpanan --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#f59e0b">
                                <i class="fas fa-wallet mr-2"></i>Data Simpanan
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Simpanan Pokok (Rp)</label>
                                        <input type="number" name="simpanan_pokok" class="form-control @error('simpanan_pokok') is-invalid @enderror" value="{{ old('simpanan_pokok', $anggotaKoperasi->simpanan_pokok ?? 0) }}" min="0">
                                        @error('simpanan_pokok')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Simpanan Wajib (Rp)</label>
                                        <input type="number" name="simpanan_wajib" class="form-control @error('simpanan_wajib') is-invalid @enderror" value="{{ old('simpanan_wajib', $anggotaKoperasi->simpanan_wajib ?? 0) }}" min="0">
                                        @error('simpanan_wajib')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Status --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#f59e0b">
                                <i class="fas fa-toggle-on mr-2"></i>Status Keanggotaan
                            </h5>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                            <option value="Aktif" {{ old('status', $anggotaKoperasi->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                            <option value="Pending" {{ old('status', $anggotaKoperasi->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Nonaktif" {{ old('status', $anggotaKoperasi->status) == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                        </select>
                                        @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Upload Foto --}}
                        <div class="form-section mb-4">
                            <h5 class="font-weight-bold mb-3" style="color:#f59e0b">
                                <i class="fas fa-camera mr-2"></i>Upload Foto Baru (Opsional)
                            </h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Foto Anggota</label>
                                        @if($anggotaKoperasi->foto)
                                        <div class="mb-2">
                                            <img src="{{ $anggotaKoperasi->foto_url }}" class="img-thumbnail" style="max-width:150px">
                                        </div>
                                        @endif
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
                                        @if($anggotaKoperasi->foto_ktp)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $anggotaKoperasi->foto_ktp) }}" class="img-thumbnail" style="max-width:150px">
                                        </div>
                                        @endif
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
                            <button type="submit" class="btn btn-warning btn-lg">
                                <i class="fas fa-save mr-2"></i>Update Data
                            </button>
                            <a href="{{ route('petugas.anggota-koperasi.show', $anggotaKoperasi) }}" class="btn btn-secondary btn-lg">
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
