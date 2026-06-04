@extends('layouts.app')
@section('title', 'Daftar Koperasi Baru')

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
                                <i class="fas fa-plus-circle"></i>
                            </div>
                            <div>
                                <h3 class="page-header-title">Daftar Koperasi Baru</h3>
                                <p class="page-header-subtitle">Tambahkan data koperasi baru ke sistem</p>
                            </div>
                        </div>
                        <div class="text-right d-none d-md-block">
                            <a href="{{ route('admin.koperasi.index') }}" class="btn btn-light btn-modern">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Info --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info-modern">
                <i class="fas fa-info-circle"></i>
                <div>
                    <strong>Informasi:</strong> Nomor registrasi akan digenerate otomatis oleh sistem. 
                    Status verifikasi awal adalah <strong>Pending</strong> dan perlu diverifikasi oleh petugas.
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.koperasi.store') }}" method="POST" enctype="multipart/form-data" class="form-modern">
        @csrf
        
        <div class="row">
            {{-- Kolom Kiri - Data Pemilik --}}
            <div class="col-lg-6">
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title mb-0">
                            <i class="fas fa-user"></i> Data Pemilik Usaha
                        </h5>
                    </div>
                    <div class="content-card-body">
                        <div class="form-group">
                            <label>Nama Lengkap Pemilik <span class="text-danger">*</span></label>
                            <input type="text" name="nama_pemilik"
                                   class="form-control @error('nama_pemilik') is-invalid @enderror"
                                   placeholder="Nama lengkap sesuai KTP"
                                   value="{{ old('nama_pemilik') }}" required>
                            @error('nama_pemilik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Nomor KTP <span class="text-danger">*</span></label>
                            <input type="text" name="no_ktp"
                                   class="form-control @error('no_ktp') is-invalid @enderror"
                                   placeholder="16 digit nomor KTP"
                                   value="{{ old('no_ktp') }}" maxlength="20" required>
                            @error('no_ktp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nomor Telepon</label>
                                    <input type="text" name="no_telp"
                                           class="form-control @error('no_telp') is-invalid @enderror"
                                           placeholder="081234567890"
                                           value="{{ old('no_telp') }}">
                                    @error('no_telp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="email@example.com"
                                           value="{{ old('email') }}">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="alamat" rows="3"
                                      class="form-control @error('alamat') is-invalid @enderror"
                                      placeholder="Alamat lengkap tempat tinggal" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Distrik <span class="text-danger">*</span></label>
                                    <select name="distrik" class="form-control @error('distrik') is-invalid @enderror" required>
                                        <option value="">-- Pilih Distrik --</option>
                                        @foreach($distrik as $d)
                                            <option value="{{ $d }}" {{ old('distrik') === $d ? 'selected' : '' }}>
                                                {{ $d }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('distrik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kelurahan/Kampung <span class="text-danger">*</span></label>
                                    <input type="text" name="kelurahan"
                                           class="form-control @error('kelurahan') is-invalid @enderror"
                                           placeholder="Nama kelurahan/kampung"
                                           value="{{ old('kelurahan') }}" required>
                                    @error('kelurahan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan - Data Usaha --}}
            <div class="col-lg-6">
                <div class="content-card">
                    <div class="content-card-header">
                        <h5 class="content-card-title mb-0">
                            <i class="fas fa-store"></i> Data Usaha
                        </h5>
                    </div>
                    <div class="content-card-body">
                        <div class="form-group">
                            <label>Nama Usaha <span class="text-danger">*</span></label>
                            <input type="text" name="nama_usaha"
                                   class="form-control @error('nama_usaha') is-invalid @enderror"
                                   placeholder="Nama usaha/toko"
                                   value="{{ old('nama_usaha') }}" required>
                            @error('nama_usaha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis Usaha <span class="text-danger">*</span></label>
                            <input type="text" name="jenis_usaha"
                                   class="form-control @error('jenis_usaha') is-invalid @enderror"
                                   placeholder="Contoh: Kuliner, Perdagangan, Kerajinan..."
                                   value="{{ old('jenis_usaha') }}" required>
                            @error('jenis_usaha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Kategori Usaha <span class="text-danger">*</span></label>
                            <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                <option value="mikro" {{ old('kategori') === 'mikro' ? 'selected' : '' }}>
                                    Usaha Mikro (Omset &lt; 300 Juta/Tahun)
                                </option>
                                <option value="kecil" {{ old('kategori') === 'kecil' ? 'selected' : '' }}>
                                    Usaha Kecil (Omset 300Jt - 2.5 M/Tahun)
                                </option>
                                <option value="menengah" {{ old('kategori') === 'menengah' ? 'selected' : '' }}>
                                    Usaha Menengah (Omset 2.5M - 50M/Tahun)
                                </option>
                            </select>
                            @error('kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Modal Usaha (Rp)</label>
                                    <input type="number" name="modal_usaha"
                                           class="form-control @error('modal_usaha') is-invalid @enderror"
                                           placeholder="0"
                                           value="{{ old('modal_usaha', 0) }}" min="0">
                                    @error('modal_usaha')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Omset per Bulan (Rp)</label>
                                    <input type="number" name="omset_per_bulan"
                                           class="form-control @error('omset_per_bulan') is-invalid @enderror"
                                           placeholder="0"
                                           value="{{ old('omset_per_bulan', 0) }}" min="0">
                                    @error('omset_per_bulan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Jumlah Karyawan</label>
                            <input type="number" name="jumlah_karyawan"
                                   class="form-control @error('jumlah_karyawan') is-invalid @enderror"
                                   placeholder="0"
                                   value="{{ old('jumlah_karyawan', 0) }}" min="0">
                            @error('jumlah_karyawan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Foto Usaha</label>
                            <input type="file" name="foto_usaha" accept="image/*" 
                                   class="form-control @error('foto_usaha') is-invalid @enderror"
                                   onchange="previewImage(this)">
                            <small class="text-muted">Format: JPG, PNG, WEBP. Maks 2MB</small>
                            @error('foto_usaha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="preview" src="" class="mt-3 rounded" style="max-height:200px;display:none;">
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="content-card">
                    <div class="content-card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-success-modern btn-block">
                                    <i class="fas fa-save"></i> Simpan Data
                                </button>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('admin.koperasi.index') }}" class="btn btn-secondary btn-block">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
