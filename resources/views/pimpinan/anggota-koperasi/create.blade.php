@extends('layouts.app')
@section('title', 'Pendaftaran Anggota Koperasi Baru')

@push('styles')
<style>
.page-header {
    background: linear-gradient(135deg, #1a3a6e 0%, #2d5aa0 50%, #4a7bc8 100%);
    padding: 50px 0;
    margin-bottom: 30px;
    border-radius: 0 0 20px 20px;
    box-shadow: 0 4px 20px rgba(26, 58, 110, 0.15);
    position: relative;
    overflow: hidden;
}
.page-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 400px;
    height: 400px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
}
.page-header::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -5%;
    width: 300px;
    height: 300px;
    background: rgba(255, 255, 255, 0.03);
    border-radius: 50%;
}
.page-header .container {
    position: relative;
    z-index: 1;
}
.page-header h1 {
    font-size: 2.2rem;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    letter-spacing: -0.5px;
}
.page-header .lead {
    font-size: 1.1rem;
    opacity: 0.95;
    font-weight: 400;
}
.page-header .icon-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 70px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    margin-bottom: 15px;
    backdrop-filter: blur(10px);
}
.page-header .icon-badge i {
    font-size: 32px;
}
.steps-indicator {
    position: relative;
    padding: 20px 0;
    margin-bottom: 30px;
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
.form-control {
    border-radius: 8px;
    border: 2px solid #e5e7eb;
    padding: 10px 14px;
}
.form-control:focus {
    border-color: #1a3a6e;
    box-shadow: 0 0 0 3px rgba(26, 58, 110, 0.1);
}
.form-label {
    font-weight: 600;
    color: #374151;
    font-size: 13px;
    margin-bottom: 6px;
}
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="container text-center text-white">
        <div class="icon-badge">
            <i class="fas fa-user-plus"></i>
        </div>
        <h1 class="mb-3">Pendaftaran Anggota Koperasi Baru</h1>
        <p class="lead mb-0">Lengkapi formulir berikut untuk mendaftarkan anggota koperasi baru dengan data yang lengkap dan akurat</p>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if(isset($periodeAktif))
                <div class="alert alert-info" style="border-radius:12px;border:none;box-shadow:0 2px 8px rgba(0,0,0,0.1);background:#dbeafe;border-left:4px solid #3b82f6;">
                    <div class="d-flex align-items-start">
                        <i class="fas fa-info-circle" style="font-size:24px;color:#3b82f6;margin-right:15px;margin-top:3px;"></i>
                        <div style="flex:1;">
                            <h5 style="color:#1e40af;font-weight:700;margin-bottom:8px;">
                                <i class="fas fa-calendar-check mr-2"></i>Periode Pendaftaran Aktif
                            </h5>
                            <div style="color:#1e3a8a;line-height:1.6;">
                                <p class="mb-2"><strong>{{ $periodeAktif->nama_periode }}</strong></p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <small><i class="fas fa-calendar-alt mr-1"></i> <strong>Mulai:</strong> {{ \Carbon\Carbon::parse($periodeAktif->tanggal_mulai)->format('d M Y') }}</small>
                                    </div>
                                    <div class="col-md-6">
                                        <small><i class="fas fa-calendar-times mr-1"></i> <strong>Berakhir:</strong> {{ \Carbon\Carbon::parse($periodeAktif->tanggal_berakhir)->format('d M Y') }}</small>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <small>
                                        <i class="fas fa-users mr-1"></i> 
                                        <strong>Kuota:</strong> {{ $periodeAktif->jumlah_pendaftar }} / {{ $periodeAktif->kuota }} pendaftar
                                        <span class="badge badge-{{ $periodeAktif->jumlah_pendaftar >= $periodeAktif->kuota ? 'danger' : 'success' }} ml-2">
                                            {{ $periodeAktif->kuota - $periodeAktif->jumlah_pendaftar }} slot tersisa
                                        </span>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="card" style="border-radius:16px;border:none;box-shadow:0 4px 20px rgba(0,0,0,0.08)">
                    <div class="card-body p-4">
                        {{-- Steps Indicator --}}
                        <div class="steps-indicator">
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

                        <form action="{{ route('admin.anggota.store') }}" method="POST" enctype="multipart/form-data" id="formPendaftaran">
                            @csrf
                            
                            @if($errors->any())
                            <div class="alert alert-danger" style="border-radius:12px;border:none;border-left:4px solid #dc3545">
                                <h6 class="font-weight-bold mb-3">
                                    <i class="fas fa-exclamation-triangle mr-2"></i>Terdapat {{ $errors->count() }} kesalahan:
                                </h6>
                                @foreach($errors->all() as $error)
                                <div class="mb-1"><i class="fas fa-times-circle mr-2"></i>{{ $error }}</div>
                                @endforeach
                            </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-danger" style="border-radius:12px">
                                <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
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
                                        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" required value="{{ old('nama') }}" placeholder="Nama sesuai KTP">
                                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="tempat_lahir" class="form-control" required value="{{ old('tempat_lahir') }}" placeholder="Contoh: Jayapura">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_lahir" class="form-control" required value="{{ old('tanggal_lahir') }}">
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="L" {{ old('jenis_kelamin')=='L'?'selected':'' }}>Laki-laki</option>
                                            <option value="P" {{ old('jenis_kelamin')=='P'?'selected':'' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Status Perkawinan <span class="text-danger">*</span></label>
                                        <select name="status_perkawinan" class="form-control @error('status_perkawinan') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Lajang" {{ old('status_perkawinan')=='Lajang'?'selected':'' }}>Lajang</option>
                                            <option value="Menikah" {{ old('status_perkawinan')=='Menikah'?'selected':'' }}>Menikah</option>
                                            <option value="Cerai" {{ old('status_perkawinan')=='Cerai'?'selected':'' }}>Cerai</option>
                                        </select>
                                        @error('status_perkawinan')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                        @error('pendidikan_terakhir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Agama <span class="text-danger">*</span></label>
                                        <select name="agama" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Kristen" {{ old('agama')=='Kristen'?'selected':'' }}>Kristen</option>
                                            <option value="Islam" {{ old('agama')=='Islam'?'selected':'' }}>Islam</option>
                                            <option value="Katolik" {{ old('agama')=='Katolik'?'selected':'' }}>Katolik</option>
                                            <option value="Hindu" {{ old('agama')=='Hindu'?'selected':'' }}>Hindu</option>
                                            <option value="Buddha" {{ old('agama')=='Buddha'?'selected':'' }}>Buddha</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No. HP/WhatsApp <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp" class="form-control" required value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h6 class="font-weight-bold mb-3" style="color:#1a3a6e">
                                    <i class="fas fa-lock mr-2"></i>Data Akun Login
                                </h6>
                                
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}" placeholder="contoh@email.com">
                                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <small class="text-muted">Email untuk login ke dashboard anggota</small>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Minimal 6 karakter">
                                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password_confirmation" class="form-control" required placeholder="Ketik ulang password">
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
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Alamat Lengkap</label>
                                        <textarea name="alamat_lengkap" class="form-control" rows="3">{{ old('alamat_lengkap') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            {{-- Step 3: Data Usaha --}}
                            <div class="form-step" data-step="3">
                                <h5 class="mb-4 font-weight-bold" style="color:#1a3a6e">
                                    <i class="fas fa-store mr-2"></i>Data Usaha & Keanggotaan
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Pilih Koperasi <span class="text-danger">*</span></label>
                                        <select name="koperasi_id" class="form-control @error('koperasi_id') is-invalid @enderror" required>
                                            <option value="">-- Pilih Koperasi --</option>
                                            @foreach(\App\Models\Koperasi::where('status_verifikasi', 'approved')->get() as $kop)
                                            <option value="{{ $kop->id }}" {{ old('koperasi_id')==$kop->id?'selected':'' }}>
                                                {{ $kop->nama_usaha }} - {{ $kop->nama_pemilik }} ({{ $kop->distrik }})
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('koperasi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">Nama Usaha <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_usaha" class="form-control" required value="{{ old('nama_usaha') }}" placeholder="Nama usaha Anda">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Bidang Usaha <span class="text-danger">*</span></label>
                                        <select name="bidang_usaha" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Pertanian" {{ old('bidang_usaha')=='Pertanian'?'selected':'' }}>Pertanian</option>
                                            <option value="Perdagangan" {{ old('bidang_usaha')=='Perdagangan'?'selected':'' }}>Perdagangan</option>
                                            <option value="Jasa" {{ old('bidang_usaha')=='Jasa'?'selected':'' }}>Jasa</option>
                                            <option value="Industri" {{ old('bidang_usaha')=='Industri'?'selected':'' }}>Industri</option>
                                            <option value="Lainnya" {{ old('bidang_usaha')=='Lainnya'?'selected':'' }}>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Simpanan Pokok (Rp)</label>
                                        <input type="number" name="simpanan_pokok" class="form-control" value="{{ old('simpanan_pokok', 0) }}" min="0">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Simpanan Wajib (Rp)</label>
                                        <input type="number" name="simpanan_wajib" class="form-control" value="{{ old('simpanan_wajib', 0) }}" min="0">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <h6 class="font-weight-bold mb-3" style="color:#1a3a6e">
                                    <i class="fas fa-users mr-2"></i>Data Ahli Waris <span class="text-danger">*</span>
                                </h6>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nama Ahli Waris <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_ahli_waris" class="form-control" required value="{{ old('nama_ahli_waris') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Hubungan Keluarga <span class="text-danger">*</span></label>
                                        <select name="hubungan_ahli_waris" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Suami/Istri" {{ old('hubungan_ahli_waris')=='Suami/Istri'?'selected':'' }}>Suami/Istri</option>
                                            <option value="Anak" {{ old('hubungan_ahli_waris')=='Anak'?'selected':'' }}>Anak</option>
                                            <option value="Orang Tua" {{ old('hubungan_ahli_waris')=='Orang Tua'?'selected':'' }}>Orang Tua</option>
                                            <option value="Saudara" {{ old('hubungan_ahli_waris')=='Saudara'?'selected':'' }}>Saudara</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">No. HP Ahli Waris <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp_ahli_waris" class="form-control" required value="{{ old('no_hp_ahli_waris') }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">NIK Ahli Waris <span class="text-danger">*</span></label>
                                        <input type="text" name="nik_ahli_waris" class="form-control" maxlength="16" required value="{{ old('nik_ahli_waris') }}">
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
                                        <label class="form-label text-center d-block">Foto Diri</label>
                                        <input type="file" name="foto" class="form-control" accept="image/*" id="fotoInput">
                                        <small class="text-muted d-block text-center mt-2">Format: JPG, PNG | Max: 2MB</small>
                                        
                                        <div id="fotoPreview" class="mt-3" style="display:none">
                                            <div class="text-center">
                                                <img id="fotoPreviewImg" src="" style="max-width:300px;max-height:300px;border-radius:12px">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Navigation Buttons --}}
                            <div class="d-flex justify-content-between mt-4 pt-3 border-top">
                                <div>
                                    <a href="{{ route('admin.anggota.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                                    </a>
                                    <button type="button" class="btn btn-secondary ml-2" id="btnPrev" style="display:none">
                                        <i class="fas fa-chevron-left mr-2"></i>Sebelumnya
                                    </button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-primary" id="btnNext">
                                        Selanjutnya <i class="fas fa-chevron-right ml-2"></i>
                                    </button>
                                    <button type="submit" class="btn btn-success" id="btnSubmit" style="display:none">
                                        <i class="fas fa-save mr-2"></i>Simpan & Tambahkan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
let currentStep = 1;
const totalSteps = 4;

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

document.getElementById('btnNext').addEventListener('click', () => {
    if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
    }
});

document.getElementById('btnPrev').addEventListener('click', () => {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
});

document.getElementById('formPendaftaran').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('btnSubmit');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memproses...';
});
</script>
@endpush
@endsection
