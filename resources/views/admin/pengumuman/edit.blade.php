
@extends("layouts.app")
@section("title","Edit Pengumuman")
@section("page-title","Edit Pengumuman")
@section("breadcrumb")
<li class="breadcrumb-item"><a href="{{ route('admin.pengumuman.index') }}">Pengumuman</a></li>
<li class="breadcrumb-item active">Tambah</li>
@endsection
@section("content")
<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-bullhorn mr-2 text-warning"></i>Edit Pengumuman</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data">
        @csrf @method("PUT")
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="font-weight-bold">Judul <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                           value="{{ old('judul', $pengumuman->judul) }}" placeholder="Judul pengumuman..." required>
                    @error("judul")<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Isi Pengumuman <span class="text-danger">*</span></label>
                    <textarea name="isi" rows="5" class="form-control @error('isi') is-invalid @enderror"
                              placeholder="Tulis isi pengumuman...">{{ old('isi', $pengumuman->isi) }}</textarea>
                    @error("isi")<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Foto <small class="text-muted">(opsional, maks 3MB)</small></label>
                    <input type="file" name="foto" accept="image/*" class="form-control-file"
                        onchange="if(this.files[0]){var r=new FileReader();r.onload=function(e){document.getElementById('prevFoto').src=e.target.result;document.getElementById('prevFoto').classList.remove('d-none');};r.readAsDataURL(this.files[0]);}">
                    <img id="prevFoto" class="mt-2 d-none rounded" style="max-height:160px;object-fit:cover;">
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Video <small class="text-muted">(opsional)</small></label>
                    <div class="mb-2">
                        <div class="btn-group btn-group-sm">
                            <button type="button" class="btn btn-primary" id="btnUp" onclick="setVM('upload')">
                                <i class="fas fa-upload mr-1"></i>Upload File
                            </button>
                            <button type="button" class="btn btn-outline-primary" id="btnYt" onclick="setVM('youtube')">
                                <i class="fab fa-youtube mr-1"></i>YouTube
                            </button>
                        </div>
                    </div>
                    <input type="hidden" name="jenis_video" id="jenis_video" value="upload">
                    <div id="uploadArea">
                        <input type="file" name="video" accept="video/*" class="form-control-file">
                        <small class="text-muted">MP4/MOV/AVI, maks 50MB</small>
                    </div>
                    <div id="youtubeArea" class="d-none">
                        <input type="text" name="video" class="form-control" placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Link Selengkapnya</label>
                    <input type="url" name="link" class="form-control" placeholder="https://..." value="{{ old('link', $pengumuman->link) }}">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label class="font-weight-bold">Jenis</label>
                    <select name="jenis" class="form-control">
                        <option value="info">📘 Info</option>
                        <option value="warning">⚠️ Peringatan</option>
                        <option value="success">✅ Positif</option>
                        <option value="danger">🚨 Urgent</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Tampil Di</label>
                    <select name="tampil_di" class="form-control">
                        <option value="keduanya">Ticker &amp; Halaman</option>
                        <option value="ticker">Ticker saja</option>
                        <option value="halaman">Halaman saja</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Mulai Tampil</label>
                    <input type="datetime-local" name="mulai_tampil" class="form-control">
                    <small class="text-muted">Kosong = sekarang</small>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Selesai Tampil</label>
                    <input type="datetime-local" name="selesai_tampil" class="form-control">
                    <small class="text-muted">Kosong = selamanya</small>
                </div>
                <div class="form-group">
                    <label class="font-weight-bold">Urutan</label>
                    <input type="number" name="urutan" class="form-control" value="0" min="0">
                </div>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="is_aktif" name="is_aktif" checked>
                    <label class="custom-control-label" for="is_aktif">Aktifkan sekarang</label>
                </div>
            </div>
        </div>
        <hr>
        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i>Simpan</button>
        <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </form>
    </div>
</div>
@push("scripts")
<script>
function setVM(m){
    document.getElementById("jenis_video").value=m;
    document.getElementById("uploadArea").classList.toggle("d-none",m!="upload");
    document.getElementById("youtubeArea").classList.toggle("d-none",m!="youtube");
    document.getElementById("btnUp").className="btn btn-sm btn-"+(m=="upload"?"primary":"outline-primary");
    document.getElementById("btnYt").className="btn btn-sm btn-"+(m=="youtube"?"primary":"outline-primary");
}
</script>
@endpush
@endsection
