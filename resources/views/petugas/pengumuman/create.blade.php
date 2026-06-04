@extends("layouts.app")
@section("title","Tambah Pengumuman")

@section("content")
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            {{-- Header Card --}}
            <div class="card shadow-sm mb-4" style="border:none;border-radius:16px;background:linear-gradient(135deg,#8b5cf6,#7c3aed)">
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
                    <form action="{{ route('petugas.pengumuman.store') }}" method="POST" id="formPengumuman">
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

                        {{-- Jenis Pengumuman --}}
                        <div class="form-group mb-4">
                            <label class="font-weight-bold mb-2" style="color:#1a3a6e;font-size:14px">
                                <i class="fas fa-tag mr-2"></i>Jenis Pengumuman
                            </label>
                            <select name="jenis" class="form-control" style="border-radius:12px;border:2px solid #e5e7eb;padding:12px 16px">
                                <option value="info" {{ old('jenis')=='info'?'selected':'' }}>Info</option>
                                <option value="warning" {{ old('jenis')=='warning'?'selected':'' }}>Peringatan</option>
                                <option value="success" {{ old('jenis')=='success'?'selected':'' }}>Sukses</option>
                                <option value="danger" {{ old('jenis')=='danger'?'selected':'' }}>Penting</option>
                            </select>
                        </div>

                        {{-- Status Aktif --}}
                        <div class="form-group mb-4">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_aktif" name="is_aktif" checked>
                                <label class="custom-control-label font-weight-bold" for="is_aktif" style="color:#1a3a6e">
                                    <i class="fas fa-toggle-on mr-2"></i>Aktifkan Pengumuman
                                </label>
                            </div>
                            <small class="text-muted">Pengumuman akan langsung ditampilkan jika diaktifkan</small>
                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                            <a href="{{ route('petugas.pengumuman.index') }}" class="btn btn-secondary" style="border-radius:10px;padding:10px 24px">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary" style="border-radius:10px;padding:10px 32px;background:linear-gradient(135deg,#8b5cf6,#7c3aed);border:none">
                                <i class="fas fa-save mr-2"></i>Simpan Pengumuman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push("styles")
<style>
    .form-control:focus {
        border-color: #8b5cf6 !important;
        box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1) !important;
    }
    .form-control.is-invalid {
        border-color: #dc3545 !important;
    }
</style>
@endpush

@push("scripts")
<script>
// Auto set hari dari tanggal
document.querySelector('[name="tanggal"]').addEventListener('change', function() {
    const date = new Date(this.value);
    const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
    const dayName = days[date.getDay()];
    document.querySelector('[name="hari"]').value = dayName;
});
</script>
@endpush
@endsection
