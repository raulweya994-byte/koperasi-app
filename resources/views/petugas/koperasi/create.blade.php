@extends('layouts.app')

@section('title', 'Daftar Koperasi Baru')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
<style>
    .form-section {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        margin-bottom: 24px;
        overflow: hidden;
    }
    
    .form-section-header {
        background: linear-gradient(135deg, #1a3a6e, #2d5aa0);
        color: white;
        padding: 18px 24px;
        font-weight: 600;
        font-size: 16px;
    }
    
    .form-section-header i {
        margin-right: 10px;
    }
    
    .form-section-body {
        padding: 24px;
    }
    
    .form-group label {
        font-weight: 600;
        color: #1a3a6e;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    .form-control {
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        padding: 10px 14px;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        border-color: #1a3a6e;
        box-shadow: 0 0 0 3px rgba(26, 58, 110, 0.1);
    }
    
    .form-control.is-invalid {
        border-color: #dc3545;
    }
    
    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
    }
    
    .text-danger {
        color: #dc3545;
    }
    
    .invalid-feedback {
        font-size: 13px;
        margin-top: 6px;
    }
    
    .info-box-custom {
        background: linear-gradient(135deg, #e0f2fe, #bfdbfe);
        border-left: 4px solid #1a3a6e;
        padding: 16px 20px;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .info-box-custom p {
        margin-bottom: 8px;
        font-size: 13px;
        color: #1e40af;
    }
    
    .info-box-custom p:last-child {
        margin-bottom: 0;
    }
    
    .info-box-custom i {
        margin-right: 8px;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-submit:hover {
        background: linear-gradient(135deg, #059669, #047857);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
        color: white;
    }
    
    .btn-cancel {
        background: #6b7280;
        border: none;
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }
    
    .btn-cancel:hover {
        background: #4b5563;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(107, 114, 128, 0.3);
        color: white;
    }
    
    .select2-container--bootstrap .select2-selection {
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        min-height: 42px;
    }
    
    .select2-container--bootstrap .select2-selection:focus {
        border-color: #1a3a6e;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="row mb-3">
        <div class="col-12">
            <h4 class="font-weight-bold text-dark mb-1">
                <i class="fas fa-plus-circle text-primary mr-2"></i>
                Daftar Koperasi Baru
            </h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('petugas.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('petugas.koperasi.index') }}">Data Koperasi</a></li>
                    <li class="breadcrumb-item active">Daftar Baru</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Alert Error --}}
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:12px;border:none;box-shadow:0 2px 8px rgba(220,53,69,0.2)">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius:12px;border:none;box-shadow:0 2px 8px rgba(220,53,69,0.2)">
        <i class="fas fa-exclamation-triangle mr-2"></i>
        <strong>Perhatian!</strong> Ada beberapa kesalahan pada form:
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius:12px;border:none;box-shadow:0 2px 8px rgba(16,185,129,0.2)">
        <i class="fas fa-check-circle mr-2"></i>
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <form action="{{ route('petugas.koperasi.store') }}" method="POST">
        @csrf

        <div class="row">
            {{-- Kolom Kiri: Data Pemilik --}}
            <div class="col-lg-6">
                <div class="form-section">
                    <div class="form-section-header">
                        <i class="fas fa-user"></i>Data Pemilik Usaha
                    </div>
                    <div class="form-section-body">
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
                            @else
                                <small class="text-muted">
                                    <i class="fas fa-info-circle"></i> 
                                    Pastikan nomor KTP belum terdaftar. Setiap KTP hanya bisa didaftarkan 1 kali.
                                </small>
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
                                    <select name="distrik" class="form-control select2 @error('distrik') is-invalid @enderror" required>
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
                                    <select name="kelurahan_kampung" id="kelurahan_kampung" class="form-control select2 @error('kelurahan_kampung') is-invalid @enderror" required>
                                        <option value="">-- Pilih Distrik Dulu --</option>
                                    </select>
                                    @error('kelurahan_kampung')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Data Usaha --}}
            <div class="col-lg-6">
                <div class="form-section">
                    <div class="form-section-header">
                        <i class="fas fa-store"></i>Data Usaha Koperasi
                    </div>
                    <div class="form-section-body">
                        <div class="form-group">
                            <label>Nama Usaha <span class="text-danger">*</span></label>
                            <input type="text" name="nama_usaha"
                                   class="form-control @error('nama_usaha') is-invalid @enderror"
                                   placeholder="Nama usaha/koperasi"
                                   value="{{ old('nama_usaha') }}" required>
                            @error('nama_usaha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis Usaha <span class="text-danger">*</span></label>
                            <select name="jenis_usaha" class="form-control @error('jenis_usaha') is-invalid @enderror" required>
                                <option value="">-- Pilih Jenis Usaha --</option>
                                <option value="Koperasi Simpan Pinjam" {{ old('jenis_usaha') === 'Koperasi Simpan Pinjam' ? 'selected' : '' }}>Koperasi Simpan Pinjam</option>
                                <option value="Koperasi Konsumen" {{ old('jenis_usaha') === 'Koperasi Konsumen' ? 'selected' : '' }}>Koperasi Konsumen</option>
                                <option value="Koperasi Produsen" {{ old('jenis_usaha') === 'Koperasi Produsen' ? 'selected' : '' }}>Koperasi Produsen</option>
                                <option value="Koperasi Pemasaran" {{ old('jenis_usaha') === 'Koperasi Pemasaran' ? 'selected' : '' }}>Koperasi Pemasaran</option>
                                <option value="Koperasi Jasa" {{ old('jenis_usaha') === 'Koperasi Jasa' ? 'selected' : '' }}>Koperasi Jasa</option>
                                <option value="Koperasi Pertanian" {{ old('jenis_usaha') === 'Koperasi Pertanian' ? 'selected' : '' }}>Koperasi Pertanian</option>
                                <option value="Koperasi Peternakan" {{ old('jenis_usaha') === 'Koperasi Peternakan' ? 'selected' : '' }}>Koperasi Peternakan</option>
                                <option value="Koperasi Perikanan" {{ old('jenis_usaha') === 'Koperasi Perikanan' ? 'selected' : '' }}>Koperasi Perikanan</option>
                                <option value="Koperasi Kerajinan" {{ old('jenis_usaha') === 'Koperasi Kerajinan' ? 'selected' : '' }}>Koperasi Kerajinan</option>
                                <option value="Lainnya" {{ old('jenis_usaha') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                            </select>
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
                                           value="{{ old('modal_usaha', 0) }}" min="0" step="1000">
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
                                           value="{{ old('omset_per_bulan', 0) }}" min="0" step="1000">
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
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="info-box-custom">
                    <p class="mb-2">
                        <i class="fas fa-info-circle"></i>
                        <strong>Nomor registrasi</strong> akan digenerate otomatis oleh sistem.
                    </p>
                    <p class="mb-0">
                        <i class="fas fa-info-circle"></i>
                        Status verifikasi awal adalah <strong>Pending</strong> dan perlu diverifikasi oleh petugas.
                    </p>
                </div>

                {{-- Action Buttons --}}
                <div class="form-section">
                    <div class="form-section-body">
                        <button type="submit" class="btn btn-submit btn-block">
                            <i class="fas fa-save mr-2"></i> Simpan Data Koperasi
                        </button>
                        <a href="{{ route('petugas.koperasi.index') }}" class="btn btn-cancel btn-block">
                            <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
// Data wilayah dari Laravel
    const wilayahData = {
        kelurahan: @json($kelurahan->groupBy('distrik_id')),
        kampung: @json($kampung->groupBy('distrik_id'))
    };

    $(function() {
    // Initialize Select2
    $('.select2').select2({
        theme: 'bootstrap',
        width: '100%'
    });

    // Dynamic dropdown kelurahan/kampung berdasarkan distrik
    $('#distrik_id').on('change', function() {
        var distrikId = $(this).val();
        var $kel = $('#kelurahan_kampung');
        $kel.empty().append('<option value="">-- Pilih Kelurahan/Kampung --</option>');

        if (distrikId) {
            var kelurahans = wilayahData.kelurahan[distrikId] || [];
            var kampungs = wilayahData.kampung[distrikId] || [];

            if (kelurahans.length > 0) {
                var grp1 = $('<optgroup label="Kelurahan">');
                kelurahans.forEach(function(k) {
                    grp1.append('<option value="' + k.nama + '">' + k.nama + '</option>');
                });
                .append(grp1);
            }

            if (kampungs.length > 0) {
                var grp2 = $('<optgroup label="Kampung">');
                kampungs.forEach(function(k) {
                    grp2.append('<option value="' + k.nama + '">' + k.nama + '</option>');
                });
                .append(grp2);
            }
        }
        .trigger('change');
    });
    
    // Format number inputs
    $('input[type="number"]').on('input', function() {
        if (this.value < 0) this.value = 0;
    });
    
    // Validasi No. KTP (harus 16 digit)
    var ktpTimeout;
    $('input[name="no_ktp"]').on('input', function() {
        var $input = $(this);
        var noKtp = $input.val();
        
        // Hanya izinkan angka
        noKtp = noKtp.replace(/[^0-9]/g, '');
        $input.val(noKtp);
        
        // Batasi maksimal 20 karakter
        if (noKtp.length > 20) {
            $input.val(noKtp.slice(0, 20));
            return;
        }
        
        // Clear previous timeout
        clearTimeout(ktpTimeout);
        
        // Hapus feedback sebelumnya
        $input.removeClass('is-invalid is-valid');
        $input.siblings('.invalid-feedback, .valid-feedback').remove();
        
        // Cek jika panjang minimal 16 digit
        if (noKtp.length >= 16) {
            // Tampilkan loading
            $input.after('<small class="text-muted checking-ktp"><i class="fas fa-spinner fa-spin"></i> Memeriksa...</small>');
            
            // Delay untuk menghindari terlalu banyak request
            ktpTimeout = setTimeout(function() {
                // AJAX check ke server
                $.ajax({
                    url: '{{ route("petugas.koperasi.index") }}',
                    method: 'GET',
                    data: { check_ktp: noKtp },
                    success: function(response) {
                        $('.checking-ktp').remove();
                        
                        if (response.exists) {
                            $input.addClass('is-invalid');
                            $input.after('<div class="invalid-feedback d-block">Nomor KTP ini sudah terdaftar atas nama: <strong>' + response.nama + '</strong></div>');
                        } else {
                            $input.addClass('is-valid');
                            $input.after('<div class="valid-feedback d-block">Nomor KTP tersedia</div>');
                        }
                    },
                    error: function() {
                        $('.checking-ktp').remove();
                    }
                });
            }, 800);
        }
    });
    
    // Validasi No. Telepon (hanya angka dan +)
    $('input[name="no_telp"]').on('input', function() {
        // Hanya izinkan angka, +, -, dan spasi
        this.value = this.value.replace(/[^0-9+\-\s]/g, '');
    });
    
    // Konfirmasi sebelum submit
    $('form').on('submit', function(e) {
        var noKtp = $('input[name="no_ktp"]').val();
        var namaPemilik = $('input[name="nama_pemilik"]').val();
        var namaUsaha = $('input[name="nama_usaha"]').val();
        
        if (!noKtp || !namaPemilik || !namaUsaha) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang wajib diisi (bertanda *)');
            return false;
        }
        
        // Cek jika KTP invalid
        if ($('input[name="no_ktp"]').hasClass('is-invalid')) {
            e.preventDefault();
            alert('Nomor KTP sudah terdaftar. Silakan gunakan nomor KTP yang berbeda.');
            return false;
        }
        
        // Disable submit button untuk mencegah double submit
        $(this).find('button[type="submit"]').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-2"></i> Menyimpan...');
    });
    
    // Auto-scroll ke error jika ada
    @if($errors->any())
        $('html, body').animate({
            scrollTop: $('.alert-danger').offset().top - 100
        }, 500);
    @endif
});
</script>
@endpush