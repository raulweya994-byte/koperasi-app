@extends('layouts.app')

@section('title', 'Edit Koperasi - ' . $koperasi->nama_usaha)

@push('styles')
<style>
    /* Card Modern */
    .card-edit-modern {
        border-radius: 16px;
        border: none;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .card-header-edit {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 20px 25px;
        border: none;
    }
    
    .card-header-edit h5 {
        margin: 0;
        font-weight: 700;
        font-size: 16px;
    }
    
    .card-header-edit.success {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    
    .card-body-edit {
        padding: 25px;
    }
    
    /* Form Modern */
    .form-group label {
        font-weight: 600;
        color: #495057;
        font-size: 13px;
        margin-bottom: 8px;
    }
    
    .form-control-modern {
        border-radius: 10px;
        border: 1.5px solid #dee2e6;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.3s ease;
    }
    
    .form-control-modern:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    /* Button Modern */
    .btn-save-modern {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 15px 25px;
        font-weight: 700;
        font-size: 15px;
        transition: all 0.3s ease;
    }
    
    .btn-save-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
        color: white;
    }
    
    .btn-back-modern {
        border-radius: 12px;
        padding: 15px 25px;
        font-weight: 600;
        font-size: 15px;
    }
    
    /* Info Table */
    .info-table-modern {
        margin: 0;
    }
    
    .info-table-modern td {
        padding: 12px 0;
        font-size: 13px;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .info-table-modern tr:last-child td {
        border-bottom: none;
    }
    
    /* Badge in Header */
    .badge-header {
        background: rgba(255,255,255,0.2);
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
    }
    
    /* Select2 Modern */
    .select2-container--default .select2-selection--single {
        border-radius: 10px !important;
        border: 1.5px solid #dee2e6 !important;
        height: 45px !important;
        padding: 8px 15px !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 28px !important;
    }
    
    /* Invalid Feedback */
    .invalid-feedback {
        font-size: 12px;
        margin-top: 5px;
    }
    
    /* Form Group Spacing */
    .form-group {
        margin-bottom: 20px;
    }
    
    /* Icon in Label */
    .form-group label i {
        color: #667eea;
        opacity: 0.8;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
<form action="{{ route('admin.koperasi.update', $koperasi) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')

<div class="row">
    {{-- Kolom Kiri --}}
    <div class="col-lg-6">
        <div class="card-edit-modern">
            <div class="card-header-edit">
                <h5>
                    <i class="fas fa-user mr-2"></i>Data Pemilik Usaha
                    <span class="badge-header float-right">{{ $koperasi->no_registrasi }}</span>
                </h5>
            </div>
            <div class="card-body-edit">

                <div class="form-group">
                    <label><i class="fas fa-user mr-1"></i>Nama Lengkap Pemilik <span class="text-danger">*</span></label>
                    <input type="text" name="nama_pemilik"
                           class="form-control-modern @error('nama_pemilik') is-invalid @enderror"
                           value="{{ old('nama_pemilik', $koperasi->nama_pemilik) }}" required>
                    @error('nama_pemilik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-id-card mr-1"></i>Nomor KTP <span class="text-danger">*</span></label>
                    <input type="text" name="no_ktp"
                           class="form-control-modern @error('no_ktp') is-invalid @enderror"
                           value="{{ old('no_ktp', $koperasi->no_ktp) }}" maxlength="20" required>
                    @error('no_ktp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-phone mr-1"></i>Nomor Telepon</label>
                    <input type="text" name="no_telp"
                           class="form-control-modern @error('no_telp') is-invalid @enderror"
                           value="{{ old('no_telp', $koperasi->no_telp) }}">
                    @error('no_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-envelope mr-1"></i>Email</label>
                    <input type="email" name="email"
                           class="form-control-modern @error('email') is-invalid @enderror"
                           value="{{ old('email', $koperasi->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-map-marker-alt mr-1"></i>Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea name="alamat" rows="3"
                              class="form-control-modern @error('alamat') is-invalid @enderror"
                              required>{{ old('alamat', $koperasi->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-map mr-1"></i>Distrik <span class="text-danger">*</span></label>
                            <select name="distrik" class="form-control-modern select2 @error('distrik') is-invalid @enderror" required>
                                <option value="">-- Pilih Distrik --</option>
                                @foreach($distrik as $d)
                                    <option value="{{ $d }}" {{ old('distrik', $koperasi->distrik) === $d ? 'selected' : '' }}>
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
                            <label><i class="fas fa-building mr-1"></i>Kelurahan/Kampung <span class="text-danger">*</span></label>
                            <input type="text" name="kelurahan"
                                   class="form-control-modern @error('kelurahan') is-invalid @enderror"
                                   value="{{ old('kelurahan', $koperasi->kelurahan) }}" required>
                            @error('kelurahan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- Kolom Kanan --}}
    <div class="col-lg-6">
        <div class="card-edit-modern">
            <div class="card-header-edit success">
                <h5>
                    <i class="fas fa-store mr-2"></i>Data Usaha
                </h5>
            </div>
            <div class="card-body-edit">

                <div class="form-group">
                    <label><i class="fas fa-store mr-1"></i>Nama Usaha <span class="text-danger">*</span></label>
                    <input type="text" name="nama_usaha"
                           class="form-control-modern @error('nama_usaha') is-invalid @enderror"
                           value="{{ old('nama_usaha', $koperasi->nama_usaha) }}" required>
                    @error('nama_usaha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-briefcase mr-1"></i>Jenis Usaha <span class="text-danger">*</span></label>
                    <input type="text" name="jenis_usaha"
                           class="form-control-modern @error('jenis_usaha') is-invalid @enderror"
                           value="{{ old('jenis_usaha', $koperasi->jenis_usaha) }}" required>
                    @error('jenis_usaha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label><i class="fas fa-tags mr-1"></i>Kategori Usaha <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control-modern @error('kategori') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="mikro"    {{ old('kategori', $koperasi->kategori) === 'mikro'    ? 'selected' : '' }}>Usaha Mikro</option>
                        <option value="kecil"    {{ old('kategori', $koperasi->kategori) === 'kecil'    ? 'selected' : '' }}>Usaha Kecil</option>
                        <option value="menengah" {{ old('kategori', $koperasi->kategori) === 'menengah' ? 'selected' : '' }}>Usaha Menengah</option>
                    </select>
                    @error('kategori')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-money-bill-wave mr-1"></i>Modal Usaha (Rp)</label>
                            <input type="number" name="modal_usaha"
                                   class="form-control-modern @error('modal_usaha') is-invalid @enderror"
                                   value="{{ old('modal_usaha', $koperasi->modal_usaha) }}" min="0">
                            @error('modal_usaha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="fas fa-chart-line mr-1"></i>Omset per Bulan (Rp)</label>
                            <input type="number" name="omset_per_bulan"
                                   class="form-control-modern @error('omset_per_bulan') is-invalid @enderror"
                                   value="{{ old('omset_per_bulan', $koperasi->omset_per_bulan) }}" min="0">
                            @error('omset_per_bulan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-users mr-1"></i>Jumlah Karyawan</label>
                    <input type="number" name="jumlah_karyawan"
                           class="form-control-modern @error('jumlah_karyawan') is-invalid @enderror"
                           value="{{ old('jumlah_karyawan', $koperasi->jumlah_karyawan) }}" min="0">
                    @error('jumlah_karyawan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Info Status --}}
        <div class="card-edit-modern">
            <div class="card-header-edit" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">
                <h5><i class="fas fa-info-circle mr-2"></i>Informasi Status</h5>
            </div>
            <div class="card-body-edit">
                <table class="info-table-modern">
                    <tr>
                        <td class="text-muted" width="45%"><i class="fas fa-check-circle mr-2"></i>Status Verifikasi</td>
                        <td>{!! $koperasi->status_verifikasi_label !!}</td>
                    </tr>
                    <tr>
                        <td class="text-muted"><i class="fas fa-toggle-on mr-2"></i>Status Usaha</td>
                        <td>{!! $koperasi->status_usaha_label !!}</td>
                    </tr>
                    <tr>
                        <td class="text-muted"><i class="fas fa-calendar-plus mr-2"></i>Terdaftar</td>
                        <td>{{ $koperasi->created_at->format('d M Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Foto Usaha --}}
        <div class="card-edit-modern">
            <div class="card-header-edit" style="background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);">
                <h5><i class="fas fa-image mr-2"></i>Foto Usaha</h5>
            </div>
            <div class="card-body-edit">
                @if($koperasi->foto_usaha)
                    <img src="{{ asset("storage/".$koperasi->foto_usaha) }}" class="img-fluid rounded mb-3" style="max-height:200px;width:100%;object-fit:cover;border-radius:12px;">
                @endif
                <input type="file" name="foto_usaha" accept="image/*" class="form-control-modern">
                <small class="text-muted d-block mt-2"><i class="fas fa-info-circle mr-1"></i>Biarkan kosong jika tidak ingin mengubah foto.</small>
            </div>
        </div>
        {{-- Tombol --}}
        <div class="card-edit-modern">
            <div class="card-body-edit">
                <button type="submit" class="btn-save-modern btn-block">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
                <a href="{{ route('admin.koperasi.index') }}" class="btn btn-secondary btn-back-modern btn-block mt-3">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </div>

    </div>
</div>

</form>
@endsection