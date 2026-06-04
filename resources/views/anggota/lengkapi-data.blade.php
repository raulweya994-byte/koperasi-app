@extends('layouts.anggota')
@section('title', 'Lengkapi Data')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('anggota.dashboard') }}">Dashboard</a></li>
<li class="breadcrumb-item active">Lengkapi Data</li>
@endsection

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="card mb-4" style="border-radius: 12px; background: linear-gradient(135deg, #2c5aa0, #1a3a6e); border: none;">
        <div class="card-body text-white">
            <div class="d-flex align-items-center">
                <div class="mr-3" style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items-center; justify-content: center;">
                    <i class="fas fa-edit fa-2x"></i>
                </div>
                <div>
                    <h4 class="mb-1 font-weight-bold">Lengkapi Data Anggota</h4>
                    <p class="mb-0" style="opacity: 0.9;">Perbaiki dan lengkapi data Anda untuk verifikasi ulang</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Info Status --}}
    @if($anggota->status == 'Ditolak' && $anggota->catatan_admin)
    <div class="alert alert-warning" style="border-radius: 10px; border-left: 4px solid #f59e0b;">
        <strong><i class="fas fa-info-circle mr-2"></i>Catatan Admin:</strong> {{ $anggota->catatan_admin }}
    </div>
    @endif

    @if(!$periodeBuka)
    <div class="alert alert-danger" style="border-radius: 10px;">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <strong>Periode pendaftaran ditutup.</strong> Anda tidak dapat mengirim data saat ini.
    </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('anggota.lengkapi-data.update') }}" method="POST" enctype="multipart/form-data" id="formLengkapiData">
        @csrf
        
        {{-- Data Pribadi --}}
        <div class="card mb-4" style="border-radius: 12px; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <div class="card-header bg-white" style="border-bottom: 2px solid #e0e0e0; border-radius: 12px 12px 0 0;">
                <h5 class="mb-0 font-weight-bold" style="color: #1a3a6e;">
                    <i class="fas fa-user mr-2"></i>Data Pribadi
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror" 
                               value="{{ old('nik', $anggota->nik) }}" maxlength="16" required>
                        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" 
                               value="{{ old('nama', $anggota->nama) }}" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                               value="{{ old('tanggal_lahir', $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('Y-m-d') : '') }}" required>
                        @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Jenis Kelamin <span class="text-danger">*</span></label>
                        <select name="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">Pilih</option>
                            <option value="L" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Status Perkawinan <span class="text-danger">*</span></label>
                        <select name="status_perkawinan" class="form-control @error('status_perkawinan') is-invalid @enderror" required>
                            <option value="">Pilih</option>
                            <option value="Lajang" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Lajang' ? 'selected' : '' }}>Lajang</option>
                            <option value="Menikah" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                            <option value="Cerai" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                        </select>
                        @error('status_perkawinan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Pendidikan Terakhir <span class="text-danger">*</span></label>
                        <select name="pendidikan_terakhir" class="form-control @error('pendidikan_terakhir') is-invalid @enderror" required>
                            <option value="">Pilih</option>
                            <option value="SD" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'SD' ? 'selected' : '' }}>SD</option>
                            <option value="SMP" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'SMP' ? 'selected' : '' }}>SMP</option>
                            <option value="SMA" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'SMA' ? 'selected' : '' }}>SMA</option>
                            <option value="D3" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'D3' ? 'selected' : '' }}>D3</option>
                            <option value="S1" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>S1</option>
                            <option value="S2" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>S2</option>
                        </select>
                        @error('pendidikan_terakhir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Agama <span class="text-danger">*</span></label>
                        <select name="agama" class="form-control @error('agama') is-invalid @enderror" required>
                            <option value="">Pilih</option>
                            <option value="Islam" {{ old('agama', $anggota->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ old('agama', $anggota->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ old('agama', $anggota->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ old('agama', $anggota->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ old('agama', $anggota->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
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
                        <label class="font-weight-600">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $anggota->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-600">Foto Diri <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></label>
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                        @error('foto')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        @if($anggota->foto)
                        <small class="text-muted">Foto saat ini: <img src="{{ $anggota->foto_url }}" width="50" class="rounded mt-2"></small>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Alamat --}}
        <div class="card mb-4" style="border-radius: 12px; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <div class="card-header bg-white" style="border-bottom: 2px solid #e0e0e0;">
                <h5 class="mb-0 font-weight-bold" style="color: #1a3a6e;">
                    <i class="fas fa-map-marker-alt mr-2"></i>Alamat
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Desa</label>
                        <input type="text" name="desa" class="form-control" value="{{ old('desa', $anggota->desa) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Distrik <span class="text-danger">*</span></label>
                        <input type="text" name="distrik" class="form-control @error('distrik') is-invalid @enderror" 
                               value="{{ old('distrik', $anggota->distrik) }}" required>
                        @error('distrik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Kabupaten</label>
                        <input type="text" name="kabupaten" class="form-control" value="{{ old('kabupaten', $anggota->kabupaten ?? 'Tolikara') }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-600">Alamat Lengkap</label>
                        <textarea name="alamat_lengkap" class="form-control" rows="3">{{ old('alamat_lengkap', $anggota->alamat_lengkap) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Usaha --}}
        <div class="card mb-4" style="border-radius: 12px; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <div class="card-header bg-white" style="border-bottom: 2px solid #e0e0e0;">
                <h5 class="mb-0 font-weight-bold" style="color: #1a3a6e;">
                    <i class="fas fa-store mr-2"></i>Data Usaha
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Nama Usaha <span class="text-danger">*</span></label>
                        <input type="text" name="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror" 
                               value="{{ old('nama_usaha', $anggota->nama_usaha) }}" required>
                        @error('nama_usaha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Bidang Usaha <span class="text-danger">*</span></label>
                        <input type="text" name="bidang_usaha" class="form-control @error('bidang_usaha') is-invalid @enderror" 
                               value="{{ old('bidang_usaha', $anggota->bidang_usaha) }}" required>
                        @error('bidang_usaha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Modal Usaha (Rp)</label>
                        <input type="number" name="modal_usaha" class="form-control" value="{{ old('modal_usaha', $anggota->modal_usaha) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Omzet per Bulan (Rp)</label>
                        <input type="number" name="omzet_per_bulan" class="form-control" value="{{ old('omzet_per_bulan', $anggota->omzet_per_bulan) }}">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-600">Alamat Tempat Usaha</label>
                        <textarea name="alamat_tempat_usaha" class="form-control" rows="2">{{ old('alamat_tempat_usaha', $anggota->alamat_tempat_usaha) }}</textarea>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="font-weight-600">Keterangan Usaha</label>
                        <textarea name="keterangan_usaha" class="form-control" rows="2">{{ old('keterangan_usaha', $anggota->keterangan_usaha) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Keuangan & Simpanan --}}
        <div class="card mb-4" style="border-radius: 12px; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <div class="card-header bg-white" style="border-bottom: 2px solid #e0e0e0;">
                <h5 class="mb-0 font-weight-bold" style="color: #1a3a6e;">
                    <i class="fas fa-money-bill-wave mr-2"></i>Data Keuangan & Simpanan
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Simpanan Pokok (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="simpanan_pokok" class="form-control @error('simpanan_pokok') is-invalid @enderror" 
                               value="{{ old('simpanan_pokok', $anggota->simpanan_pokok) }}" required>
                        @error('simpanan_pokok')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Simpanan Wajib (Rp) <span class="text-danger">*</span></label>
                        <input type="number" name="simpanan_wajib" class="form-control @error('simpanan_wajib') is-invalid @enderror" 
                               value="{{ old('simpanan_wajib', $anggota->simpanan_wajib) }}" required>
                        @error('simpanan_wajib')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Nama Bank</label>
                        <input type="text" name="nama_bank" class="form-control" value="{{ old('nama_bank', $anggota->nama_bank) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Nomor Rekening</label>
                        <input type="text" name="nomor_rekening" class="form-control" value="{{ old('nomor_rekening', $anggota->nomor_rekening) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Nama Pemilik Rekening</label>
                        <input type="text" name="nama_pemilik_rekening" class="form-control" value="{{ old('nama_pemilik_rekening', $anggota->nama_pemilik_rekening) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">NPWP</label>
                        <input type="text" name="npwp" class="form-control" maxlength="15" value="{{ old('npwp', $anggota->npwp) }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- Data Ahli Waris --}}
        <div class="card mb-4" style="border-radius: 12px; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <div class="card-header bg-white" style="border-bottom: 2px solid #e0e0e0;">
                <h5 class="mb-0 font-weight-bold" style="color: #1a3a6e;">
                    <i class="fas fa-users mr-2"></i>Data Ahli Waris
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Nama Ahli Waris <span class="text-danger">*</span></label>
                        <input type="text" name="nama_ahli_waris" class="form-control @error('nama_ahli_waris') is-invalid @enderror" 
                               value="{{ old('nama_ahli_waris', $anggota->nama_ahli_waris) }}" required>
                        @error('nama_ahli_waris')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">Hubungan Keluarga <span class="text-danger">*</span></label>
                        <input type="text" name="hubungan_ahli_waris" class="form-control @error('hubungan_ahli_waris') is-invalid @enderror" 
                               value="{{ old('hubungan_ahli_waris', $anggota->hubungan_ahli_waris) }}" required>
                        @error('hubungan_ahli_waris')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">No. HP Ahli Waris <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp_ahli_waris" class="form-control @error('no_hp_ahli_waris') is-invalid @enderror" 
                               value="{{ old('no_hp_ahli_waris', $anggota->no_hp_ahli_waris) }}" required>
                        @error('no_hp_ahli_waris')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="font-weight-600">NIK Ahli Waris <span class="text-danger">*</span></label>
                        <input type="text" name="nik_ahli_waris" class="form-control @error('nik_ahli_waris') is-invalid @enderror" 
                               maxlength="16" value="{{ old('nik_ahli_waris', $anggota->nik_ahli_waris) }}" required>
                        @error('nik_ahli_waris')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Tombol Submit --}}
        <div class="card mb-4" style="border-radius: 12px; border: none; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <div class="card-body text-center p-4">
                @if($periodeBuka)
                <button type="submit" class="btn btn-success btn-lg px-5" style="border-radius: 10px; font-weight: 700;">
                    <i class="fas fa-paper-plane mr-2"></i>Submit Data
                </button>
                @else
                <button type="button" class="btn btn-secondary btn-lg px-5" style="border-radius: 10px; font-weight: 700;" disabled>
                    <i class="fas fa-ban mr-2"></i>Submit Ditutup
                </button>
                @endif
                <a href="{{ route('anggota.dashboard') }}" class="btn btn-secondary btn-lg px-5 ml-2" style="border-radius: 10px; font-weight: 700;">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#formLengkapiData').on('submit', function(e) {
        if (!confirm('Apakah Anda yakin data sudah benar dan siap untuk verifikasi ulang?')) {
            e.preventDefault();
        }
    });
});
</script>
@endpush
