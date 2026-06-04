@extends('layouts.app')
@section('title','Edit Pegawai')
@section('page-title','Edit Pegawai')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.struktur.index') }}">Struktur Organisasi</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection
@section('content')
<div class="card card-warning card-outline">
    <div class="card-header"><h3 class="card-title"><i class="fas fa-edit mr-2"></i>Edit: {{ $anggota->jabatan }}</h3></div>
    <form method="POST" action="{{ route('petugas.struktur.update', $anggota->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $anggota->nama) }}">
                    </div>
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" name="nip" class="form-control" value="{{ old('nip', $anggota->nip) }}">
                    </div>
                    <div class="form-group">
                        <label>Jabatan <span class="text-danger">*</span></label>
                        <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $anggota->jabatan) }}" required>
                        @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label>Sub Jabatan</label>
                        <input type="text" name="sub_jabatan" class="form-control" value="{{ old('sub_jabatan', $anggota->sub_jabatan) }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Bidang <span class="text-danger">*</span></label>
                        <select name="bidang" class="form-control" required>
                            @foreach(['kepala_dinas'=>'Kepala Dinas','sekretariat'=>'Sekretariat','perindustrian'=>'Bidang Perindustrian','perdagangan'=>'Bidang Perdagangan','koperasi'=>'Bidang Koperasi','koperasi'=>'Bidang Koperasi','uptd'=>'UPTD'] as $val => $label)
                            <option value="{{ $val }}" {{ old('bidang',$anggota->bidang)==$val?'selected':'' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Urutan</label>
                        <input type="number" name="urutan" class="form-control" value="{{ old('urutan', $anggota->urutan) }}" min="0">
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        @if($anggota->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$anggota->foto) }}" class="img-circle" width="60" height="60" style="object-fit:cover;">
                            <small class="text-muted ml-2">Foto saat ini</small>
                        </div>
                        @endif
                        <div class="custom-file">
                            <input type="file" name="foto" class="custom-file-input" id="foto" accept="image/*">
                            <label class="custom-file-label" for="foto">Ganti foto...</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="is_active" name="is_active" {{ $anggota->is_active ? 'checked' : '' }}>
                            <label class="custom-control-label" for="is_active">Aktif / Tampil di publik</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-warning"><i class="fas fa-save mr-1"></i> Perbarui</button>
            <a href="{{ route('petugas.struktur.index') }}" class="btn btn-secondary ml-2">Batal</a>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
document.querySelector('.custom-file-input').addEventListener('change',function(e){
    document.querySelector('.custom-file-label').textContent = e.target.files[0]?e.target.files[0].name:'Ganti foto...';
});
</script>
@endpush