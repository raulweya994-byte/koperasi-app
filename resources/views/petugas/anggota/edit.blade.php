@extends('layouts.app')
@section('title','Edit Anggota')

@push('styles')
<style>
    .card-modern {
        border-radius: 15px;
        border: none;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        overflow: hidden;
    }
    
    .section-header {
        padding: 15px 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        font-weight: 600;
    }
    
    .section-header i {
        font-size: 24px;
        margin-right: 12px;
    }
    
    .section-primary {
        background: linear-gradient(135deg, #1a3a6e 0%, #2c5282 100%);
        color: white;
    }
    
    .section-success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    
    .section-warning {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
    }
    
    .form-group label {
        font-weight: 600;
        color: #374151;
        font-size: 13px;
        margin-bottom: 8px;
    }
    
    .form-control {
        border-radius: 8px;
        border: 1.5px solid #e5e7eb;
        padding: 10px 15px;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #1a3a6e;
        box-shadow: 0 0 0 3px rgba(26, 58, 110, 0.1);
    }
    
    .alert-info-custom {
        background: linear-gradient(135deg, #e0e7ff 0%, #f3f4f6 100%);
        border-left: 4px solid #1a3a6e;
        border-radius: 10px;
        padding: 15px 20px;
        margin-bottom: 25px;
    }
    
    .btn-save {
        background: linear-gradient(135deg, #1a3a6e 0%, #2c5282 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(26, 58, 110, 0.4);
        color: white;
    }
    
    .profile-preview {
        width: 80px;
        height: 80px;
        border-radius: 12px;
        object-fit: cover;
        border: 3px solid #e5e7eb;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .badge-status {
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }
</style>
@endpush

@section('content')
<div class="card card-modern">
    <div class="card-header" style="background: linear-gradient(135deg, #1a3a6e 0%, #2c5282 100%); color: white; padding: 20px;">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="mb-1" style="font-weight: 700;">
                    <i class="fas fa-user-edit mr-2"></i>Edit Data Anggota
                </h3>
                <p class="mb-0" style="opacity: 0.9; font-size: 14px;">
                    {{ $anggota->nama }} - {{ $anggota->no_anggota }}
                </p>
            </div>
            <div>
                <span class="badge badge-status" style="background: rgba(255,255,255,0.2);">
                    <i class="fas fa-circle mr-1" style="font-size: 8px;"></i>{{ $anggota->status }}
                </span>
            </div>
        </div>
    </div>
    
    <form method="POST" action="{{ route('petugas.anggota.update', $anggota) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card-body" style="padding: 30px;">
            
            <!-- Alert Info -->
            <div class="alert-info-custom">
                <div class="d-flex align-items-start">
                    <i class="fas fa-info-circle fa-2x mr-3" style="color: #1a3a6e;"></i>
                    <div>
                        <h6 class="font-weight-bold mb-2" style="color: #374151;">
                            <i class="fas fa-bell mr-1"></i>Notifikasi Otomatis
                        </h6>
                        <p class="mb-0" style="font-size: 13px; color: #6b7280;">
                            Setiap perubahan data yang Anda simpan akan <strong>otomatis mengirim notifikasi</strong> ke anggota. 
                            Anggota akan menerima detail perubahan yang dilakukan pada profil mereka.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Kolom Kiri: Data Pribadi -->
                <div class="col-md-6">
                    <div class="section-header section-primary">
                        <i class="fas fa-user"></i>
                        <span>Data Pribadi</span>
                    </div>
                    
                    <div class="form-group">
                        <label>No. Anggota</label>
                        <input type="text" class="form-control bg-light" value="{{ $anggota->no_anggota }}" readonly>
                        <small class="text-muted">Nomor anggota tidak dapat diubah</small>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-building mr-1"></i>Koperasi <span class="text-danger">*</span></label>
                        <select name="koperasi_id" class="form-control @error('koperasi_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Koperasi --</option>
                            @foreach($koperasi as $kop)
                            <option value="{{ $kop->id }}" {{ old('koperasi_id', $anggota->koperasi_id) == $kop->id ? 'selected' : '' }}>
                                {{ $kop->nama_usaha }}
                            </option>
                            @endforeach
                        </select>
                        @error('koperasi_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Pilih koperasi tempat anggota terdaftar</small>
                    </div>
                    
                    <div class="form-group">
                        <label>NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                               value="{{ old('nik',$anggota->nik) }}" maxlength="16" required 
                               placeholder="Masukkan 16 digit NIK">
                        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                               value="{{ old('nama',$anggota->nama) }}" required 
                               placeholder="Nama lengkap sesuai KTP">
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control" 
                                       value="{{ old('tempat_lahir',$anggota->tempat_lahir) }}"
                                       placeholder="Kota/Kabupaten">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" 
                                       value="{{ old('tanggal_lahir',$anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('Y-m-d') : '') }}">
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Kelamin <span class="text-danger">*</span></label>
                                <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="L" {{ old('jenis_kelamin',$anggota->jenis_kelamin)=='L'?'selected':'' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin',$anggota->jenis_kelamin)=='P'?'selected':'' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status Perkawinan <span class="text-danger">*</span></label>
                                <select name="status_perkawinan" class="form-control @error('status_perkawinan') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Lajang" {{ old('status_perkawinan',$anggota->status_perkawinan)=='Lajang'?'selected':'' }}>Lajang</option>
                                    <option value="Menikah" {{ old('status_perkawinan',$anggota->status_perkawinan)=='Menikah'?'selected':'' }}>Menikah</option>
                                    <option value="Cerai" {{ old('status_perkawinan',$anggota->status_perkawinan)=='Cerai'?'selected':'' }}>Cerai</option>
                                </select>
                                @error('status_perkawinan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Pendidikan Terakhir <span class="text-danger">*</span></label>
                                <select name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach(['SD','SMP','SMA/SMK','D3','S1','S2','S3','Lainnya'] as $pend)
                                    <option value="{{ $pend }}" {{ old('pendidikan_terakhir',$anggota->pendidikan_terakhir)==$pend?'selected':'' }}>{{ $pend }}</option>
                                    @endforeach
                                </select>
                                @error('pendidikan_terakhir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Agama <span class="text-danger">*</span></label>
                                <select name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                                    <option value="">-- Pilih --</option>
                                    @foreach(['Kristen','Islam','Katolik','Hindu','Buddha','Konghucu'] as $ag)
                                    <option value="{{ $ag }}" {{ old('agama',$anggota->agama)==$ag?'selected':'' }}>{{ $ag }}</option>
                                    @endforeach
                                </select>
                                @error('agama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-phone mr-1"></i>No HP <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" 
                               value="{{ old('no_hp',$anggota->no_hp) }}"
                               placeholder="08xxxxxxxxxx" required>
                        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-envelope mr-1"></i>Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $anggota->user ? $anggota->user->email : $anggota->email) }}"
                               placeholder="email@example.com">
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <small class="text-muted">Email untuk login (opsional)</small>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-camera mr-1"></i>Foto Profil</label>
                        @if($anggota->foto)
                        <div class="mb-3">
                            <img src="{{ $anggota->foto_url }}" class="profile-preview">
                            <small class="text-muted ml-2">Foto saat ini</small>
                        </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="foto" accept="image/*">
                            <label class="custom-file-label" for="foto">{{ $anggota->foto ? 'Ganti foto...' : 'Pilih foto...' }}</label>
                        </div>
                        <small class="text-muted">Format: JPG, PNG (Max: 2MB)</small>
                    </div>
                </div>
                
                <!-- Kolom Kanan: Alamat & Usaha -->
                <div class="col-md-6">
                    <div class="section-header section-success">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Alamat</span>
                    </div>
                    
                    <div class="form-group">
                        <label>Desa</label>
                        <input type="text" name="desa" class="form-control" 
                               value="{{ old('desa',$anggota->desa) }}"
                               placeholder="Nama desa">
                    </div>
                    
                    <div class="form-group">
                        <label>Distrik</label>
                        <select name="distrik" class="form-control">
                            @foreach(['Karubaga','Bokondini','Tiom','Kembu','Bewani','Bokoneri','Geya','Nabunage','Kanggime','Wugi','Kagime','Lainnya'] as $d)
                            <option value="{{ $d }}" {{ old('distrik',$anggota->distrik)==$d?'selected':'' }}>{{ $d }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Kabupaten</label>
                        <input type="text" name="kabupaten" class="form-control" 
                               value="{{ old('kabupaten',$anggota->kabupaten) }}"
                               placeholder="Nama kabupaten">
                    </div>
                    
                    <div class="form-group">
                        <label>Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-control" rows="2" 
                                  placeholder="Alamat detail">{{ old('alamat_lengkap',$anggota->alamat_lengkap) }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Nama Komplek/Dekat Desa</label>
                        <input type="text" name="nama_komplek_dekat_desa" class="form-control" 
                               value="{{ old('nama_komplek_dekat_desa',$anggota->nama_komplek_dekat_desa) }}"
                               placeholder="Patokan lokasi">
                    </div>
                    
                    <div class="section-header section-warning mt-4">
                        <i class="fas fa-store"></i>
                        <span>Data Usaha</span>
                    </div>
                    
                    <div class="form-group">
                        <label>Nama Usaha</label>
                        <input type="text" name="nama_usaha" class="form-control" 
                               value="{{ old('nama_usaha',$anggota->nama_usaha) }}"
                               placeholder="Nama usaha/toko">
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><i class="fas fa-wallet mr-1"></i>Modal (Rp)</label>
                                <input type="number" name="modal_usaha" class="form-control" 
                                       value="{{ old('modal_usaha',$anggota->modal_usaha) }}"
                                       placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><i class="fas fa-chart-line mr-1"></i>Omzet (Rp)</label>
                                <input type="number" name="omzet_per_bulan" class="form-control" 
                                       value="{{ old('omzet_per_bulan',$anggota->omzet_per_bulan) }}"
                                       placeholder="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label><i class="fas fa-piggy-bank mr-1"></i>Simpanan (Rp)</label>
                                <input type="number" name="total_simpanan" class="form-control" 
                                       value="{{ old('total_simpanan',$anggota->total_simpanan) }}"
                                       placeholder="0">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Keterangan Usaha</label>
                        <textarea name="keterangan_usaha" class="form-control" rows="3" 
                                  placeholder="Deskripsi usaha, bidang usaha, dll">{{ old('keterangan_usaha',$anggota->keterangan_usaha) }}</textarea>
                    </div>
                    
                    <div class="form-group">
                        <label><i class="fas fa-toggle-on mr-1"></i>Status Anggota</label>
                        <select name="status" class="form-control">
                            @foreach(['Aktif','Pending','Nonaktif'] as $s)
                            <option value="{{ $s }}" {{ old('status',$anggota->status)==$s?'selected':'' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Status keanggotaan saat ini</small>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer" style="background: #f9fafb; padding: 20px 30px; border-top: 2px solid #e5e7eb;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        <i class="fas fa-info-circle mr-1"></i>
                        Perubahan akan dikirim sebagai notifikasi ke anggota
                    </small>
                </div>
                <div>
                    <a href="{{ route('petugas.anggota.index') }}" class="btn btn-secondary" style="border-radius: 10px; padding: 12px 25px;">
                        <i class="fas fa-times mr-1"></i>Batal
                    </a>
                    <button type="submit" class="btn btn-save ml-2">
                        <i class="fas fa-save mr-2"></i>Simpan Perubahan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Preview foto sebelum upload
document.getElementById('foto').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || 'Pilih foto...';
    const label = e.target.nextElementSibling;
    label.textContent = fileName;
});

// Konfirmasi sebelum submit
document.querySelector('form').addEventListener('submit', function(e) {
    const confirmed = confirm('Apakah Anda yakin ingin menyimpan perubahan? Notifikasi akan dikirim ke anggota.');
    if (!confirmed) {
        e.preventDefault();
    }
});
</script>
@endpush
