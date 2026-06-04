@extends('public.layouts.app')

@section('title', 'Pendaftaran Anggota Koperasi')

@section('content')
<div class="page-header" style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);padding:60px 0">
    <div class="container text-center text-white">
        <h1 class="mb-3"><i class="fas fa-user-plus mr-3"></i>Pendaftaran Anggota Koperasi</h1>
        <p class="lead">{{ $periode->nama_periode }} - {{ $periode->tahun_ajaran }}</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                {{-- Info Periode --}}
                <div class="alert alert-info" style="border-radius:12px;border:none;box-shadow:0 2px 8px rgba(0,0,0,0.1)">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-info-circle fa-2x mr-3"></i>
                        <div>
                            <h6 class="font-weight-bold mb-2">Informasi Pendaftaran</h6>
                            <p class="mb-1"><strong>Periode:</strong> {{ $periode->tanggal_mulai->format('d M Y') }} - {{ $periode->tanggal_selesai->format('d M Y') }}</p>
                            @if($periode->kuota)
                            <p class="mb-1"><strong>Kuota:</strong> {{ $periode->kuota }} orang (Sisa: {{ $periode->sisa_kuota }})</p>
                            @endif
                            @if($periode->deskripsi)
                            <p class="mb-0"><strong>Keterangan:</strong> {{ $periode->deskripsi }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Form Multi-Step --}}
                <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 20px rgba(0,0,0,0.08)">
                    <div class="card-body p-4">
                        {{-- Steps Indicator --}}
                        <div class="steps-indicator mb-4">
                            <div class="d-flex justify-content-between">
                                <div class="step-item active" data-step="1">
                                    <div class="step-circle">1</div>
                                    <small>Data Pribadi</small>
                                </div>
                                <div class="step-item" data-step="2">
                                    <div class="step-circle">2</div>
                                    <small>Alamat</small>
                                </div>
                                <div class="step-item" data-step="3">
                                    <div class="step-circle">3</div>
                                    <small>Data Usaha</small>
                                </div>
                                <div class="step-item" data-step="4">
                                    <div class="step-circle">4</div>
                                    <small>Dokumen</small>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" id="formPendaftaran">
                            @csrf
                            
                            {{-- Error Messages --}}
                            @if($errors->any())
                            <div class="alert alert-danger" style="border-radius:12px;border:none;border-left:4px solid #dc3545;box-shadow:0 4px 15px rgba(220,53,69,0.2)">
                                <h6 class="font-weight-bold mb-3">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>Terdapat {{ $errors->count() }} kesalahan pada form:
                                </h6>
                                <div class="error-list" style="max-height:300px;overflow-y:auto">
                                    @foreach($errors->all() as $index => $error)
                                    <div class="error-item mb-2 p-2" style="background:#fff5f5;border-radius:6px;border-left:3px solid #dc3545">
                                        <i class="fas fa-times-circle mr-2" style="color:#dc3545"></i>
                                        <strong>{{ $index + 1 }}.</strong> {{ $error }}
                                    </div>
                                    @endforeach
                                </div>
                                <div class="mt-3 pt-3 border-top">
                                    <small class="text-muted">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Silakan periksa kembali data yang Anda isi dan pastikan semua field yang wajib sudah terisi dengan benar.
                                    </small>
                                </div>
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger" style="border-radius:12px;border:none;border-left:4px solid #dc3545;box-shadow:0 4px 15px rgba(220,53,69,0.2)">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                            </div>
                            @endif

                            @if(session('success'))
                            <div class="alert alert-success" style="border-radius:12px;border:none;border-left:4px solid #10b981;box-shadow:0 4px 15px rgba(16,185,129,0.2)">
                                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                            </div>
                            @endif
                            
                            {{-- Step 1: Data Pribadi --}}
                            <div class="form-step active" data-step="1">
                                <h5 class="mb-4 font-weight-bold" style="color:#1a3a6e">
                                    <i class="fas fa-user mr-2"></i>Data Pribadi
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">NIK (16 digit) <span class="text-danger">*</span></label>
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" maxlength="16" required value="{{ old('nik') }}" placeholder="Contoh: 9113221112309001">
                                        @error('nik')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                        <small class="text-muted">16 digit angka sesuai KTP</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" required value="{{ old('nama') }}" placeholder="Nama sesuai KTP">
                                        @error('nama')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="tempat_lahir" class="form-control @error('tempat_lahir') is-invalid @enderror" required value="{{ old('tempat_lahir') }}" placeholder="Contoh: Jayapura">
                                        @error('tempat_lahir')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_lahir" class="form-control @error('tanggal_lahir') is-invalid @enderror" required value="{{ old('tanggal_lahir') }}" max="{{ date('Y-m-d') }}">
                                        @error('tanggal_lahir')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="L" {{ old('jenis_kelamin')=='L'?'selected':'' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin')=='P'?'selected':'' }}>Perempuan</option>
                                        </select>
                                        @error('jenis_kelamin')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                                        <select name="status_perkawinan" class="form-control @error('status_perkawinan') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Lajang" {{ old('status_perkawinan')=='Lajang'?'selected':'' }}>Lajang</option>
                                            <option value="Menikah" {{ old('status_perkawinan')=='Menikah'?'selected':'' }}>Menikah</option>
                                            <option value="Cerai" {{ old('status_perkawinan')=='Cerai'?'selected':'' }}>Cerai</option>
                                        </select>
                                        @error('status_perkawinan')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Pendidikan Terakhir <span class="text-danger">*</span></label>
                                        <select name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="SD" {{ old('pendidikan_terakhir')=='SD'?'selected':'' }}>SD</option>
                                            <option value="SMP" {{ old('pendidikan_terakhir')=='SMP'?'selected':'' }}>SMP</option>
                                            <option value="SMA/SMK" {{ old('pendidikan_terakhir')=='SMA/SMK'?'selected':'' }}>SMA/SMK</option>
                                            <option value="D3" {{ old('pendidikan_terakhir')=='D3'?'selected':'' }}>D3</option>
                                            <option value="S1" {{ old('pendidikan_terakhir')=='S1'?'selected':'' }}>S1</option>
                                            <option value="S2" {{ old('pendidikan_terakhir')=='S2'?'selected':'' }}>S2</option>
                                            <option value="S3" {{ old('pendidikan_terakhir')=='S3'?'selected':'' }}>S3</option>
                                        </select>
                                        @error('pendidikan_terakhir')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Agama <span class="text-danger">*</span></label>
                                        <select name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Kristen" {{ old('agama')=='Kristen'?'selected':'' }}>Kristen</option>
                                            <option value="Islam" {{ old('agama')=='Islam'?'selected':'' }}>Islam</option>
                                            <option value="Katolik" {{ old('agama')=='Katolik'?'selected':'' }}>Katolik</option>
                                            <option value="Hindu" {{ old('agama')=='Hindu'?'selected':'' }}>Hindu</option>
                                            <option value="Buddha" {{ old('agama')=='Buddha'?'selected':'' }}>Buddha</option>
                                        </select>
                                        @error('agama')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No. HP/WhatsApp <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" required value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890">
                                        @error('no_hp')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                        <small class="text-muted">Nomor aktif untuk dihubungi</small>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h6 class="font-weight-bold mb-3" style="color:#1a3a6e">
                                    <i class="fas fa-lock mr-2"></i>Data Akun Login
                                </h6>
                                <p class="text-muted mb-3" style="font-size:13px">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Buat akun login Anda untuk mengakses dashboard anggota setelah pendaftaran disetujui
                                </p>
                                
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}" placeholder="contoh@email.com">
                                        @error('email')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                        <small class="text-muted">Email ini akan digunakan untuk login ke dashboard anggota</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Minimal 6 karakter">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')" style="border-radius:0 8px 8px 0;border:2px solid #e5e7eb;border-left:none">
                                                    <i class="fas fa-eye" id="password-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('password')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                        <small class="text-muted">Minimal 6 karakter</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required placeholder="Ketik ulang password">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')" style="border-radius:0 8px 8px 0;border:2px solid #e5e7eb;border-left:none">
                                                    <i class="fas fa-eye" id="password_confirmation-icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        @error('password_confirmation')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                        <small class="text-muted">Harus sama dengan password</small>
                                    </div>
                                </div>
                            </div>

                            {{-- Step 2: Alamat --}}
                            <div class="form-step" data-step="2">
                                <h5 class="mb-4 font-weight-bold" style="color:#1a3a6e">
                                    <i class="fas fa-map-marker-alt mr-2"></i>Alamat Lengkap
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Desa</label>
                                        <input type="text" name="desa" class="form-control" value="{{ old('desa') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Distrik <span class="text-danger">*</span></label>
                                        <input type="text" name="distrik" class="form-control" required value="{{ old('distrik') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Kabupaten</label>
                                        <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten', 'Tolikara') }}">
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Alamat Lengkap</label>
                                        <textarea name="alamat_lengkap" class="form-control" rows="3">{{ old('alamat_lengkap') }}</textarea>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Kode Pos</label>
                                        <input type="text" name="kode_pos" class="form-control" value="{{ old('kode_pos') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Koordinat GPS</label>
                                        <input type="text" name="koordinat_gps" class="form-control" placeholder="-3.123456, 138.123456" value="{{ old('koordinat_gps') }}">
                                        <small class="text-muted">Format: Latitude, Longitude</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Status Kepemilikan Rumah</label>
                                        <select name="status_kepemilikan_rumah" class="form-control">
                                            <option value="">Pilih</option>
                                            <option value="Milik Sendiri">Milik Sendiri</option>
                                            <option value="Sewa">Sewa</option>
                                            <option value="Ikut Orang Tua">Ikut Orang Tua</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Step 3: Data Usaha --}}
                            <div class="form-step" data-step="3">
                                <h5 class="mb-4 font-weight-bold" style="color:#1a3a6e">
                                    <i class="fas fa-store mr-2"></i>Data Usaha
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nama Usaha <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror" required value="{{ old('nama_usaha') }}" placeholder="Nama usaha Anda">
                                        @error('nama_usaha')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Bidang Usaha <span class="text-danger">*</span></label>
                                        <select name="bidang_usaha" class="form-control @error('bidang_usaha') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Pertanian" {{ old('bidang_usaha')=='Pertanian'?'selected':'' }}>Pertanian</option>
                                            <option value="Perdagangan" {{ old('bidang_usaha')=='Perdagangan'?'selected':'' }}>Perdagangan</option>
                                            <option value="Jasa" {{ old('bidang_usaha')=='Jasa'?'selected':'' }}>Jasa</option>
                                            <option value="Industri" {{ old('bidang_usaha')=='Industri'?'selected':'' }}>Industri</option>
                                            <option value="Lainnya" {{ old('bidang_usaha')=='Lainnya'?'selected':'' }}>Lainnya</option>
                                        </select>
                                        @error('bidang_usaha')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Lama Berdiri Usaha (Tahun)</label>
                                        <input type="number" name="lama_berdiri_usaha" class="form-control @error('lama_berdiri_usaha') is-invalid @enderror" value="{{ old('lama_berdiri_usaha', 0) }}" min="0" placeholder="0">
                                        @error('lama_berdiri_usaha')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Jumlah Karyawan</label>
                                        <input type="number" name="jumlah_karyawan" class="form-control @error('jumlah_karyawan') is-invalid @enderror" value="{{ old('jumlah_karyawan', 0) }}" min="0" placeholder="0">
                                        @error('jumlah_karyawan')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Modal Usaha (Rp)</label>
                                        <input type="number" name="modal_usaha" class="form-control @error('modal_usaha') is-invalid @enderror" value="{{ old('modal_usaha', 0) }}" min="0" placeholder="0">
                                        @error('modal_usaha')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Omzet per Bulan (Rp)</label>
                                        <input type="number" name="omzet_per_bulan" class="form-control @error('omzet_per_bulan') is-invalid @enderror" value="{{ old('omzet_per_bulan', 0) }}" min="0" placeholder="0">
                                        @error('omzet_per_bulan')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Alamat Tempat Usaha</label>
                                        <textarea name="alamat_tempat_usaha" class="form-control @error('alamat_tempat_usaha') is-invalid @enderror" rows="2" placeholder="Alamat lengkap lokasi usaha">{{ old('alamat_tempat_usaha') }}</textarea>
                                        @error('alamat_tempat_usaha')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Legalitas Usaha</label>
                                        <input type="text" name="legalitas_usaha" class="form-control @error('legalitas_usaha') is-invalid @enderror" placeholder="NIB/SKU/PIRT" value="{{ old('legalitas_usaha') }}">
                                        @error('legalitas_usaha')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                        <small class="text-muted">Nomor izin usaha (jika ada)</small>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Keterangan Usaha</label>
                                        <textarea name="keterangan_usaha" class="form-control @error('keterangan_usaha') is-invalid @enderror" rows="3" placeholder="Deskripsi singkat tentang usaha Anda">{{ old('keterangan_usaha') }}</textarea>
                                        @error('keterangan_usaha')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h6 class="font-weight-bold mb-3" style="color:#1a3a6e">
                                    <i class="fas fa-users mr-2"></i>Data Ahli Waris <span class="text-danger">*</span>
                                </h6>
                                <p class="text-muted mb-3" style="font-size:13px">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    Ahli waris adalah orang yang berhak menerima hak dan kewajiban Anda di koperasi
                                </p>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Ahli Waris <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_ahli_waris" class="form-control @error('nama_ahli_waris') is-invalid @enderror" required value="{{ old('nama_ahli_waris') }}" placeholder="Nama lengkap ahli waris">
                                        @error('nama_ahli_waris')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hubungan Keluarga <span class="text-danger">*</span></label>
                                        <select name="hubungan_ahli_waris" class="form-control @error('hubungan_ahli_waris') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Suami/Istri" {{ old('hubungan_ahli_waris')=='Suami/Istri'?'selected':'' }}>Suami/Istri</option>
                                            <option value="Anak" {{ old('hubungan_ahli_waris')=='Anak'?'selected':'' }}>Anak</option>
                                            <option value="Orang Tua" {{ old('hubungan_ahli_waris')=='Orang Tua'?'selected':'' }}>Orang Tua</option>
                                            <option value="Saudara" {{ old('hubungan_ahli_waris')=='Saudara'?'selected':'' }}>Saudara</option>
                                        </select>
                                        @error('hubungan_ahli_waris')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No. HP Ahli Waris <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp_ahli_waris" class="form-control @error('no_hp_ahli_waris') is-invalid @enderror" required value="{{ old('no_hp_ahli_waris') }}" placeholder="Nomor HP yang bisa dihubungi">
                                        @error('no_hp_ahli_waris')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">NIK Ahli Waris <span class="text-danger">*</span></label>
                                        <input type="text" name="nik_ahli_waris" class="form-control @error('nik_ahli_waris') is-invalid @enderror" maxlength="16" required value="{{ old('nik_ahli_waris') }}" placeholder="16 digit NIK">
                                        @error('nik_ahli_waris')
                                        <div class="invalid-feedback d-block">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                        <small class="text-muted">16 digit sesuai KTP</small>
                                    </div>
                                </div>
                            </div>

                            {{-- Step 4: Upload Dokumen --}}
                            <div class="form-step" data-step="4">
                                <h5 class="mb-4 font-weight-bold" style="color:#1a3a6e">
                                    <i class="fas fa-file-upload mr-2"></i>Upload Foto Diri
                                </h5>
                                
                                <div class="row justify-content-center">
                                    <div class="col-md-8 mb-4">
                                        <div class="text-center mb-3">
                                            <div style="width:120px;height:120px;margin:0 auto 20px;background:linear-gradient(135deg,#667eea,#764ba2);border-radius:50%;display:flex;align-items:center;justify-content:center">
                                                <i class="fas fa-camera fa-3x text-white"></i>
                                            </div>
                                        </div>
                                        <label class="form-label text-center d-block">Foto Diri <span class="text-danger">*</span></label>
                                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*" required id="fotoInput">
                                        @error('foto')
                                        <div class="invalid-feedback d-block text-center">
                                            <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                        </div>
                                        @enderror
                                        <small class="text-muted d-block text-center mt-2">
                                            <i class="fas fa-info-circle mr-1"></i>
                                            Format: JPG, JPEG, PNG | Maksimal: 2MB
                                        </small>
                                        
                                        {{-- Preview Image --}}
                                        <div id="fotoPreview" class="mt-3" style="display:none">
                                            <div class="text-center">
                                                <img id="fotoPreviewImg" src="" style="max-width:300px;max-height:300px;border-radius:12px;box-shadow:0 4px 15px rgba(0,0,0,0.1)">
                                                <div class="mt-2">
                                                    <button type="button" class="btn btn-sm btn-danger" onclick="clearFoto()" style="border-radius:8px">
                                                        <i class="fas fa-times mr-1"></i>Hapus Foto
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="alert alert-info" style="border-radius:12px;border:none;border-left:4px solid #3b82f6">
                                    <i class="fas fa-lightbulb mr-2"></i>
                                    <strong>Tips Foto yang Baik:</strong>
                                    <ul class="mb-0 mt-2 pl-3">
                                        <li>Gunakan pencahayaan yang cukup</li>
                                        <li>Wajah terlihat jelas dan tidak blur</li>
                                        <li>Background bersih dan rapi</li>
                                        <li>Foto terbaru (maksimal 6 bulan)</li>
                                    </ul>
                                </div>

                                <div class="alert alert-warning" style="border-radius:12px;border:none;border-left:4px solid #f59e0b">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>
                                    <strong>Perhatian:</strong> Pastikan semua data yang Anda isi sudah benar. Setelah submit, akun Anda akan dibuat otomatis dan data akan diverifikasi oleh admin.
                                </div>
                            </div>

                            {{-- Navigation Buttons --}}
                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                <button type="button" class="btn btn-secondary" id="btnPrev" style="display:none">
                                    <i class="fas fa-arrow-left mr-2"></i>Sebelumnya
                                </button>
                                <button type="button" class="btn btn-primary" id="btnNext">
                                    Selanjutnya <i class="fas fa-arrow-right ml-2"></i>
                                </button>
                                <button type="submit" class="btn btn-success" id="btnSubmit" style="display:none">
                                    <i class="fas fa-check mr-2"></i>Daftar Sekarang
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .form-control {
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        padding: 10px 14px;
    }
    .form-control:focus {
        border-color: #1a3a6e;
        box-shadow: 0 0 0 3px rgba(26, 58, 110, 0.1);
    }
    .input-group .form-control {
        border-radius: 8px 0 0 8px;
    }
    .input-group-append .btn {
        border-radius: 0 8px 8px 0;
        border: 2px solid #e5e7eb;
        border-left: none;
    }
    .input-group .form-control:focus {
        border-right: 2px solid #1a3a6e;
    }
    .input-group .form-control:focus + .input-group-append .btn {
        border-color: #1a3a6e;
    }
    .form-control.is-invalid {
        border-color: #dc3545;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23dc3545'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px 16px;
        padding-right: 40px;
    }
    .input-group .form-control.is-invalid {
        background-position: right calc(2.25rem + 12px) center;
        padding-right: calc(2.25rem + 40px);
    }
    .form-control.is-valid {
        border-color: #10b981;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2310b981' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 16px 16px;
        padding-right: 40px;
    }
    .input-group .form-control.is-valid {
        background-position: right calc(2.25rem + 12px) center;
        padding-right: calc(2.25rem + 40px);
    }
    .invalid-feedback {
        display: block;
        color: #dc3545;
        font-size: 0.85rem;
        margin-top: 5px;
    }
    .form-label {
        font-weight: 600;
        color: #374151;
        font-size: 13px;
        margin-bottom: 6px;
    }
    .steps-indicator {
        position: relative;
        padding: 20px 0;
    }
    .steps-indicator::before {
        content: '';
        position: absolute;
        top: 35px;
        left: 10%;
        right: 10%;
        height: 2px;
        background: #e5e7eb;
        z-index: 0;
    }
    .step-item {
        text-align: center;
        position: relative;
        z-index: 1;
    }
    .step-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: white;
        border: 3px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 8px;
        font-weight: 700;
        color: #9ca3af;
    }
    .step-item.active .step-circle {
        background: #1a3a6e;
        border-color: #1a3a6e;
        color: white;
    }
    .step-item.completed .step-circle {
        background: #10b981;
        border-color: #10b981;
        color: white;
    }
    .step-item small {
        font-size: 11px;
        color: #9ca3af;
        font-weight: 600;
    }
    .step-item.active small {
        color: #1a3a6e;
    }
    .form-step {
        display: none;
    }
    .form-step.active {
        display: block;
    }
</style>
@endpush

@push('scripts')
<script>
let currentStep = 1;
const totalSteps = 4;

// Validasi untuk setiap step
const stepValidations = {
    1: ['nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'status_perkawinan', 'pendidikan_terakhir', 'agama', 'no_hp', 'email', 'password', 'password_confirmation'],
    2: ['distrik'],
    3: ['nama_usaha', 'bidang_usaha', 'nama_ahli_waris', 'hubungan_ahli_waris', 'no_hp_ahli_waris', 'nik_ahli_waris'],
    4: ['foto']
};

// Preview foto
document.getElementById('fotoInput')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('fotoPreviewImg').src = e.target.result;
            document.getElementById('fotoPreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
});

function clearFoto() {
    document.getElementById('fotoInput').value = '';
    document.getElementById('fotoPreview').style.display = 'none';
    document.getElementById('fotoPreviewImg').src = '';
}

function validateField(fieldName) {
    const field = document.querySelector(`[name="${fieldName}"]`);
    if (!field) return true;
    
    const value = field.value.trim();
    const fieldGroup = field.closest('.form-group') || field.closest('.col-md-6') || field.closest('.col-md-4') || field.closest('.col-md-12');
    
    // Remove existing error
    const existingError = fieldGroup?.querySelector('.invalid-feedback');
    if (existingError) existingError.remove();
    field.classList.remove('is-invalid', 'is-valid');
    
    // Check if required
    const isRequired = field.hasAttribute('required');
    if (isRequired && !value) {
        showFieldError(field, 'Field ini wajib diisi');
        return false;
    }
    
    // Validasi khusus
    if (fieldName === 'nik' && value) {
        if (value.length !== 16) {
            showFieldError(field, 'NIK harus 16 digit');
            return false;
        }
        if (!/^\d+$/.test(value)) {
            showFieldError(field, 'NIK hanya boleh angka');
            return false;
        }
    }
    
    if (fieldName === 'nik_ahli_waris' && value) {
        if (value.length !== 16) {
            showFieldError(field, 'NIK Ahli Waris harus 16 digit');
            return false;
        }
        if (!/^\d+$/.test(value)) {
            showFieldError(field, 'NIK hanya boleh angka');
            return false;
        }
    }
    
    if (fieldName === 'email' && value) {
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            showFieldError(field, 'Format email tidak valid');
            return false;
        }
    }
    
    if (fieldName === 'password' && value) {
        if (value.length < 6) {
            showFieldError(field, 'Password minimal 6 karakter');
            return false;
        }
    }
    
    if (fieldName === 'password_confirmation' && value) {
        const password = document.querySelector('[name="password"]').value;
        if (value !== password) {
            showFieldError(field, 'Konfirmasi password tidak cocok');
            return false;
        }
    }
    
    if (fieldName === 'no_hp' && value) {
        if (!/^[0-9+\-\s()]+$/.test(value)) {
            showFieldError(field, 'Format nomor HP tidak valid');
            return false;
        }
    }
    
    if (fieldName === 'npwp' && value) {
        if (value.length !== 15) {
            showFieldError(field, 'NPWP harus 15 digit');
            return false;
        }
    }
    
    if (field.type === 'file' && isRequired) {
        if (!field.files || field.files.length === 0) {
            showFieldError(field, 'File wajib diupload');
            return false;
        }
        
        const file = field.files[0];
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            showFieldError(field, 'Ukuran file maksimal 2MB');
            return false;
        }
        
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            showFieldError(field, 'File harus berformat JPG, JPEG, atau PNG');
            return false;
        }
    }
    
    // If valid, show green checkmark
    if (value || field.type === 'file') {
        field.classList.add('is-valid');
    }
    
    return true;
}

function showFieldError(field, message) {
    field.classList.add('is-invalid');
    const fieldGroup = field.closest('.form-group') || field.closest('.col-md-6') || field.closest('.col-md-4') || field.closest('.col-md-12');
    if (fieldGroup) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'invalid-feedback d-block';
        errorDiv.style.cssText = 'color:#dc3545;font-size:0.85rem;margin-top:5px';
        errorDiv.innerHTML = `<i class="fas fa-exclamation-circle mr-1"></i>${message}`;
        fieldGroup.appendChild(errorDiv);
    }
}

function validateStep(step) {
    const fieldsToValidate = stepValidations[step] || [];
    let isValid = true;
    
    fieldsToValidate.forEach(fieldName => {
        if (!validateField(fieldName)) {
            isValid = false;
        }
    });
    
    return isValid;
}

function showStep(step) {
    document.querySelectorAll('.form-step').forEach(el => el.classList.remove('active'));
    document.querySelector(`.form-step[data-step="${step}"]`).classList.add('active');
    
    document.querySelectorAll('.step-item').forEach((el, index) => {
        el.classList.remove('active', 'completed');
        if (index + 1 < step) el.classList.add('completed');
        if (index + 1 === step) el.classList.add('active');
    });
    
    document.getElementById('btnPrev').style.display = step === 1 ? 'none' : 'inline-block';
    document.getElementById('btnNext').style.display = step === totalSteps ? 'none' : 'inline-block';
    document.getElementById('btnSubmit').style.display = step === totalSteps ? 'inline-block' : 'none';
    
    window.scrollTo({top: 0, behavior: 'smooth'});
}

// Add real-time validation on blur
document.querySelectorAll('input, select, textarea').forEach(field => {
    field.addEventListener('blur', function() {
        validateField(this.name);
    });
    
    field.addEventListener('input', function() {
        // Remove error on input
        this.classList.remove('is-invalid');
        const errorDiv = this.closest('.form-group')?.querySelector('.invalid-feedback') || 
                        this.closest('.col-md-6')?.querySelector('.invalid-feedback') ||
                        this.closest('.col-md-4')?.querySelector('.invalid-feedback') ||
                        this.closest('.col-md-12')?.querySelector('.invalid-feedback');
        if (errorDiv) errorDiv.remove();
    });
});

document.getElementById('btnNext').addEventListener('click', () => {
    if (validateStep(currentStep)) {
        if (currentStep < totalSteps) {
            currentStep++;
            showStep(currentStep);
        }
    } else {
        // Scroll to first error
        const firstError = document.querySelector('.is-invalid');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            firstError.focus();
        }
    }
});

document.getElementById('btnPrev').addEventListener('click', () => {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
});

document.getElementById('formPendaftaran').addEventListener('submit', function(e) {
    // Validate all steps before submit
    let allValid = true;
    for (let step = 1; step <= totalSteps; step++) {
        if (!validateStep(step)) {
            allValid = false;
            // Go to first invalid step
            currentStep = step;
            showStep(currentStep);
            
            // Scroll to first error
            setTimeout(() => {
                const firstError = document.querySelector('.is-invalid');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstError.focus();
                }
            }, 300);
            
            e.preventDefault();
            return false;
        }
    }
    
    if (!allValid) {
        e.preventDefault();
        return false;
    }
    
    const submitBtn = document.getElementById('btnSubmit');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses Pendaftaran...';
    
    // Show loading overlay
    const loadingOverlay = document.createElement('div');
    loadingOverlay.id = 'loadingOverlay';
    loadingOverlay.style.cssText = 'position:fixed;top:0;left:0;right:0;bottom:0;background:rgba(0,0,0,0.7);z-index:9999;display:flex;align-items:center;justify-content:center';
    loadingOverlay.innerHTML = `
        <div style="background:white;padding:40px;border-radius:16px;text-align:center;max-width:400px">
            <div style="width:80px;height:80px;margin:0 auto 20px;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center">
                <i class="fas fa-spinner fa-spin fa-3x text-white"></i>
            </div>
            <h5 class="font-weight-bold mb-2" style="color:#1a3a6e">Memproses Pendaftaran...</h5>
            <p class="text-muted mb-0">Mohon tunggu, kami sedang membuat akun Anda</p>
        </div>
    `;
    document.body.appendChild(loadingOverlay);
});

// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '-icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endpush
@endsection
