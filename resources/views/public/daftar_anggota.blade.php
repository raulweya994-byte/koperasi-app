@extends('public.layouts.app')
@section('title','Pendaftaran Anggota Koperasi')
@section('content')
<section style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);padding:60px 0 40px;color:white;">
    <div class="container text-center">
        <i class="fas fa-handshake fa-2x mb-3 d-block" style="opacity:.8"></i>
        <h2 class="font-weight-bold mb-2">Pendaftaran Anggota Koperasi</h2>
        <p style="opacity:.75">Daftarkan diri Anda sebagai anggota koperasi DISPERINDAGKOP Kabupaten Tolikara</p>
    </div>
</section>
<section class="py-5">
    <div class="container">
        @if(session('success'))
        <div class="alert alert-success text-center">
            <i class="fas fa-check-circle fa-2x mb-2 d-block"></i>
            <h5>{{ session('success') }}</h5>
            @if(session('no_anggota'))
            <p>No. Anggota Anda: <strong class="text-primary" style="font-size:20px">{{ session('no_anggota') }}</strong></p>
            <p class="text-muted small">Simpan nomor anggota Anda. Tim kami akan memverifikasi pendaftaran Anda segera.</p>
            @endif
        </div>
        @endif

        @if(!$aktif)
        <div class="alert alert-warning text-center py-5" style="border-radius:12px">
            <i class="fas fa-lock fa-3x mb-3 d-block text-warning"></i>
            <h4 class="font-weight-bold">Pendaftaran Belum Dibuka</h4>
            <p class="text-muted">Pendaftaran anggota koperasi saat ini belum dibuka oleh admin.</p>
            @if($mulai && $selesai)
            <p class="text-muted">Periode pendaftaran: <strong>{{ \Carbon\Carbon::parse($mulai)->format("d M Y") }}</strong> s/d <strong>{{ \Carbon\Carbon::parse($selesai)->format("d M Y") }}</strong></p>
            @endif
            <a href="{{ route("public.home") }}" class="btn btn-primary mt-2"><i class="fas fa-home mr-2"></i>Kembali ke Beranda</a>
        </div>
        @else
        <div class="row justify-content-center">
            <div class="col-md-8">
                {{-- Info Syarat --}}
                <div class="card border-0 shadow-sm mb-4" style="border-radius:12px;border-left:5px solid #f5a623!important;">
                    <div class="card-body p-4">
                        <h6 class="font-weight-bold text-warning mb-3"><i class="fas fa-info-circle mr-2"></i>Syarat Menjadi Anggota Koperasi</h6>
                        <div class="row" style="font-size:13px">
                            <div class="col-md-6">
                                <ul class="pl-3 mb-0">
                                    <li>Warga Kabupaten Tolikara</li>
                                    <li>Memiliki usaha aktif</li>
                                    <li>KTP/NIK yang valid</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="pl-3 mb-0">
                                    <li>Bersedia mengikuti aturan koperasi</li>
                                    <li>Membayar simpanan pokok</li>
                                    <li>Simpanan wajib per bulan</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm" style="border-radius:12px;">
                    <div class="card-header" style="background:#1a3a6e;color:white;border-radius:12px 12px 0 0;">
                        <h5 class="mb-0"><i class="fas fa-user-plus mr-2"></i>Form Pendaftaran Anggota</h5>
                    </div>
                    <form method="POST" action="{{ route('daftar-anggota.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-4">
                            <h6 class="font-weight-bold text-primary mb-3 border-bottom pb-2">Data Pribadi</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>NIK (16 digit) <span class="text-danger">*</span></label>
                                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" value="{{ old('nik') }}" maxlength="16" required>
                                        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tempat Lahir <span class="text-danger">*</span></label>
                                        <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tanggal Lahir <span class="text-danger">*</span></label>
                                        <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agama</label>
                                        <select name="agama" class="form-control">
                                            @foreach(['Kristen','Islam','Katolik','Hindu','Buddha','Konghucu'] as $ag)
                                            <option value="{{ $ag }}">{{ $ag }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No HP <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                                        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label>Foto (opsional)</label>
                                <div class="custom-file">
                                    <input type="file" name="foto" class="custom-file-input" id="foto" accept="image/*">
                                    <label class="custom-file-label" for="foto">Pilih foto...</label>
                                </div>
                            </div>

                            <h6 class="font-weight-bold text-success mb-3 border-bottom pb-2 mt-4">Alamat</h6>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Desa</label>
                                        <input type="text" name="desa" class="form-control" value="{{ old('desa') }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Distrik <span class="text-danger">*</span></label>
                                        <select name="distrik" class="form-control @error('distrik') is-invalid @enderror" required>
                                            <option value="">-- Pilih --</option>
                                            @foreach(['Karubaga','Bokondini','Tiom','Kembu','Bewani','Bokoneri','Geya','Nabunage','Kanggime','Wugi','Kagime','Lainnya'] as $d)
                                            <option value="{{ $d }}" {{ old('distrik')==$d?'selected':'' }}>{{ $d }}</option>
                                            @endforeach
                                        </select>
                                        @error('distrik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kabupaten</label>
                                        <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten','Tolikara') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea name="alamat_lengkap" class="form-control" rows="2">{{ old('alamat_lengkap') }}</textarea>
                            </div>

                            <h6 class="font-weight-bold text-warning mb-3 border-bottom pb-2 mt-4">Data Usaha</h6>
                            <div class="form-group">
                                <label>Nama Usaha <span class="text-danger">*</span></label>
                                <input type="text" name="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror" value="{{ old('nama_usaha') }}" required>
                                @error('nama_usaha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Modal Usaha (Rp)</label>
                                        <input type="number" name="modal_usaha" class="form-control" value="{{ old('modal_usaha',0) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Omzet/Bulan (Rp)</label>
                                        <input type="number" name="omzet_per_bulan" class="form-control" value="{{ old('omzet_per_bulan',0) }}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Total Simpanan (Rp)</label>
                                        <input type="number" name="total_simpanan" class="form-control" value="{{ old('total_simpanan',0) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Keterangan Usaha</label>
                                <textarea name="keterangan_usaha" class="form-control" rows="3">{{ old('keterangan_usaha') }}</textarea>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block btn-lg">
                                <i class="fas fa-paper-plane mr-2"></i>Daftar Sebagai Anggota
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
        @endif
@endsection
@push('scripts')
<script>document.querySelector('.custom-file-input').addEventListener('change',function(e){document.querySelector('.custom-file-label').textContent=e.target.files[0]?e.target.files[0].name:'Pilih foto...';});</script>
@endpush