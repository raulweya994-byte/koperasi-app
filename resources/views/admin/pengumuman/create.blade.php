
@extends("layouts.app")
@section("title","Tambah Pengumuman")
@section("page-title","Tambah Pengumuman")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{ route('admin.pengumuman.index') }}">Pengumuman</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection
@section("content")
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            {{-- Header Card --}}
            <div class="card shadow-sm mb-4" style="border:none;border-radius:16px;background:linear-gradient(135deg,#667eea,#764ba2)">
                <div class="card-body text-center text-white py-4">
                    <div style="width:80px;height:80px;margin:0 auto 15px;background:rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center">
                        <i class="fas fa-bullhorn fa-3x"></i>
                    </div>
                    <h3 class="font-weight-bold mb-2">Buat Surat Pengumuman</h3>
                    <p class="mb-0" style="opacity:0.9">Isi form di bawah untuk membuat pengumuman resmi</p>
                </div>
            </div>

            {{-- Form Card --}}
            <div class="card shadow-sm" style="border:none;border-radius:16px">
                <div class="card-body p-4">
                    <form action="{{ route('admin.pengumuman.store') }}" method="POST" id="formPengumuman">
                        @csrf
                        
                        {{-- Judul --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                <i class="fas fa-heading mr-2"></i>Judul Pengumuman <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="judul" class="form-control form-control-lg @error('judul') is-invalid @enderror"
                                   value="{{ old('judul') }}" placeholder="Contoh: Rapat Anggota Tahunan 2026" required
                                   style="border-radius:12px;border:2px solid #e5e7eb;padding:14px 18px">
                            @error("judul")
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Isi/Deskripsi --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                <i class="fas fa-align-left mr-2"></i>Isi Pengumuman <span class="text-danger">*</span>
                            </label>
                            <textarea name="isi" rows="8" class="form-control @error('isi') is-invalid @enderror"
                                      placeholder="Tulis isi pengumuman secara lengkap dan jelas..." required
                                      style="border-radius:12px;border:2px solid #e5e7eb;padding:14px 18px;line-height:1.8">{{ old('isi') }}</textarea>
                            @error("isi")
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Jelaskan detail pengumuman dengan lengkap
                            </small>
                        </div>

                        <hr class="my-4">

                        {{-- Tanggal, Hari, Jam --}}
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                    <i class="fas fa-calendar-day mr-2"></i>Tanggal <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror"
                                       value="{{ old('tanggal', date('Y-m-d')) }}" required
                                       style="border-radius:12px;border:2px solid #e5e7eb;padding:12px 16px">
                                @error("tanggal")
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                    <i class="fas fa-calendar-week mr-2"></i>Hari <span class="text-danger">*</span>
                                </label>
                                <select name="hari" class="form-control @error('hari') is-invalid @enderror" required
                                        style="border-radius:12px;border:2px solid #e5e7eb;padding:12px 16px">
                                    <option value="">-- Pilih Hari --</option>
                                    <option value="Senin" {{ old('hari')=='Senin'?'selected':'' }}>Senin</option>
                                    <option value="Selasa" {{ old('hari')=='Selasa'?'selected':'' }}>Selasa</option>
                                    <option value="Rabu" {{ old('hari')=='Rabu'?'selected':'' }}>Rabu</option>
                                    <option value="Kamis" {{ old('hari')=='Kamis'?'selected':'' }}>Kamis</option>
                                    <option value="Jumat" {{ old('hari')=='Jumat'?'selected':'' }}>Jumat</option>
                                    <option value="Sabtu" {{ old('hari')=='Sabtu'?'selected':'' }}>Sabtu</option>
                                    <option value="Minggu" {{ old('hari')=='Minggu'?'selected':'' }}>Minggu</option>
                                </select>
                                @error("hari")
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                    <i class="fas fa-clock mr-2"></i>Jam <span class="text-danger">*</span>
                                </label>
                                <input type="time" name="jam" class="form-control @error('jam') is-invalid @enderror"
                                       value="{{ old('jam', date('H:i')) }}" required
                                       style="border-radius:12px;border:2px solid #e5e7eb;padding:12px 16px">
                                @error("jam")
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Tahun --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                <i class="fas fa-calendar-alt mr-2"></i>Tahun <span class="text-danger">*</span>
                            </label>
                            <input type="number" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                                   value="{{ old('tahun', date('Y')) }}" min="2020" max="2100" required
                                   style="border-radius:12px;border:2px solid #e5e7eb;padding:12px 16px">
                            @error("tahun")
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        {{-- Nama Pembuat --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                <i class="fas fa-user-edit mr-2"></i>Nama Pembuat Surat <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="pembuat" class="form-control @error('pembuat') is-invalid @enderror"
                                   value="{{ old('pembuat', auth()->user()->name) }}" placeholder="Nama lengkap pembuat surat" required
                                   style="border-radius:12px;border:2px solid #e5e7eb;padding:12px 16px">
                            @error("pembuat")
                            <div class="invalid-feedback d-block">
                                <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
                            </div>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle mr-1"></i>Nama yang akan tertera sebagai pembuat surat
                            </small>
                        </div>

                        {{-- Hidden Fields untuk kompatibilitas --}}
                        <input type="hidden" name="jenis" value="info">
                        <input type="hidden" name="is_aktif" value="1">

                        {{-- Info Box --}}
                        <div class="alert alert-info" style="border-radius:12px;border:none;border-left:4px solid #3b82f6;background:#dbeafe">
                            <div class="d-flex align-items-start">
                                <i class="fas fa-lightbulb fa-2x mr-3" style="color:#3b82f6"></i>
                                <div>
                                    <h6 class="font-weight-bold mb-2" style="color:#1e40af">Tips Membuat Pengumuman yang Baik:</h6>
                                    <ul class="mb-0 pl-3" style="color:#1e40af">
                                        <li>Gunakan judul yang jelas dan menarik perhatian</li>
                                        <li>Tulis isi pengumuman dengan lengkap dan mudah dipahami</li>
                                        <li>Pastikan tanggal, hari, dan jam sudah benar</li>
                                        <li>Periksa kembali sebelum menyimpan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary" style="border-radius:10px;padding:10px 24px">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary" style="border-radius:10px;padding:10px 32px;background:linear-gradient(135deg,#667eea,#764ba2);border:none">
                                <i class="fas fa-save mr-2"></i>Simpan Pengumuman
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Preview Card --}}
            <div class="card shadow-sm mt-4" style="border:none;border-radius:16px;background:#f9fafb">
                <div class="card-body p-4">
                    <h5 class="font-weight-bold mb-3" style="color:#1a3a6e">
                        <i class="fas fa-eye mr-2"></i>Preview Surat Pengumuman
                    </h5>
                    <div class="preview-box p-4" style="background:white;border-radius:12px;border:2px dashed #e5e7eb">
                        <div class="text-center mb-4">
                            <h6 class="font-weight-bold text-uppercase" style="color:#1a3a6e;letter-spacing:1px">PENGUMUMAN</h6>
                        </div>
                        <div id="previewContent">
                            <p class="text-muted text-center">
                                <i class="fas fa-info-circle mr-2"></i>Preview akan muncul setelah Anda mengisi form
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push("styles")
<style>
    .form-control:focus {
        border-color: #667eea !important;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
    }
    .form-control.is-invalid {
        border-color: #dc3545 !important;
    }
    .preview-box {
        min-height: 200px;
    }
</style>
@endpush

@push("scripts")
<script>
// Auto preview
document.getElementById('formPengumuman').addEventListener('input', function(e) {
    const judul = document.querySelector('[name="judul"]').value;
    const isi = document.querySelector('[name="isi"]').value;
    const tanggal = document.querySelector('[name="tanggal"]').value;
    const hari = document.querySelector('[name="hari"]').value;
    const jam = document.querySelector('[name="jam"]').value;
    const tahun = document.querySelector('[name="tahun"]').value;
    const pembuat = document.querySelector('[name="pembuat"]').value;
    
    if (judul || isi) {
        let preview = '<div style="font-family:Arial,sans-serif;line-height:1.8">';
        
        if (judul) {
            preview += '<h5 class="font-weight-bold mb-3" style="color:#1a3a6e">' + judul + '</h5>';
        }
        
        if (hari || tanggal || tahun) {
            preview += '<p class="mb-2"><strong>Waktu:</strong> ';
            if (hari) preview += hari + ', ';
            if (tanggal) {
                const d = new Date(tanggal);
                const months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                preview += d.getDate() + ' ' + months[d.getMonth()] + ' ';
            }
            if (tahun) preview += tahun;
            if (jam) preview += ' - Pukul ' + jam + ' WIT';
            preview += '</p>';
        }
        
        if (isi) {
            preview += '<p class="mt-3" style="text-align:justify">' + isi.replace(/\n/g, '<br>') + '</p>';
        }
        
        if (pembuat) {
            preview += '<div class="mt-4 text-right"><p class="mb-1"><strong>Hormat kami,</strong></p><p class="font-weight-bold">' + pembuat + '</p></div>';
        }
        
        preview += '</div>';
        
        document.getElementById('previewContent').innerHTML = preview;
    } else {
        document.getElementById('previewContent').innerHTML = '<p class="text-muted text-center"><i class="fas fa-info-circle mr-2"></i>Preview akan muncul setelah Anda mengisi form</p>';
    }
});

// Auto set hari dari tanggal
document.querySelector('[name="tanggal"]').addEventListener('change', function() {
    const date = new Date(this.value);
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const dayName = days[date.getDay()];
    document.querySelector('[name="hari"]').value = dayName;
    
    // Trigger preview update
    document.getElementById('formPengumuman').dispatchEvent(new Event('input'));
});
</script>
@endpush
@endsection
