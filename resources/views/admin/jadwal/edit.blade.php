
@extends("layouts.app")
@section("title","Edit Jadwal")
@section("page-title","Edit Jadwal")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{ route('admin.jadwal.index') }}">Jadwal</a></li>
<li class="breadcrumb-item active">Buat</li>
@endsection
@section("content")
<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-calendar-plus mr-2 text-primary"></i>Edit Jadwal</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.jadwal.update',$jadwal) }}" method="POST">
        @csrf @method("PUT")
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="font-weight-bold">Judul Jadwal <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul',$jadwal->judul) }}" placeholder="Contoh: Verifikasi Koperasi Distrik Bokondini" required>
                    @error("judul")<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="form-control">{{ old('deskripsi',$jadwal->deskripsi) }}</textarea>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal',$jadwal->tanggal->format('Y-m-d')) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Jam Mulai <span class="text-danger">*</span></label>
                            <input type="time" name="jam_mulai" class="form-control" value="{{ old('jam_mulai',substr($jadwal->jam_mulai,0,5)) }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="font-weight-bold">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="form-control" value="{{ old('jam_selesai',$jadwal->jam_selesai?substr($jadwal->jam_selesai,0,5):'') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi',$jadwal->lokasi) }}" placeholder="Contoh: Aula DISPERINDAGKOP">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Catatan</label>
                    <textarea name="catatan" rows="2" class="form-control">{{ old('catatan',$jadwal->catatan) }}</textarea>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Koperasi yang Terlibat</label>
                    <select name="koperasi_ids[]" class="form-control" multiple style="height:120px">
                        @foreach($koperasiList as $u)
                        <option value="{{ $u->id }}">{{ $u->nama_usaha }} ({{ $u->pemilik }})</option>
                        @endforeach
                    </select>
                    <small class="text-muted">Tahan Ctrl/Cmd untuk pilih beberapa</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold">Jenis Jadwal <span class="text-danger">*</span></label>
                    <select name="jenis" class="form-control" required>
                        <option value="verifikasi">Verifikasi Lapangan</option>
                        <option value="pelatihan">Pelatihan/Pembinaan</option>
                        <option value="penilaian_bantuan">Penilaian Bantuan</option>
                        <option value="rapat">Rapat/Pertemuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Status</label>
                    <select name="status" class="form-control">
                        <option value="dijadwalkan">Dijadwalkan</option>
                        <option value="berlangsung">Berlangsung</option>
                        <option value="selesai">Selesai</option>
                        <option value="dibatalkan">Dibatalkan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Petugas Pelaksana</label>
                    <select name="petugas_id" class="form-control">
                        <option value="">-- Pilih Petugas --</option>
                        @foreach($petugas as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="custom-control custom-switch mt-3">
                    <input type="checkbox" class="custom-control-input" id="is_publik" name="is_publik">
                    <label class="custom-control-label" for="is_publik">
                        <strong>Tampilkan ke Publik</strong>
                        <small class="d-block text-muted">Jadwal bisa dilihat umum di website</small>
                    </label>
                </div>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Update Jadwal</button>
        <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </form>
    </div>
</div>
@endsection
