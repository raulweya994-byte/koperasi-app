@extends('layouts.app')

@section('title', 'Edit Koperasi - ' . $koperasi->nama_usaha)
@section('page-title', 'Edit Data Koperasi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('petugas.koperasi.index') }}">Data Koperasi</a></li>
    <li class="breadcrumb-item"><a href="{{ route('petugas.koperasi.show', $koperasi) }}">{{ $koperasi->nama_usaha }}</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<form action="{{ route('petugas.koperasi.update', $koperasi) }}" method="POST">
@csrf
@method('PUT')

<div class="row">
    {{-- Kolom Kiri --}}
    <div class="col-lg-6">
        <div class="card card-primary card-outline shadow-sm">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user mr-2"></i>Data Pemilik Usaha
                </h3>
                <div class="card-tools">
                    <span class="badge badge-primary">{{ $koperasi->no_registrasi }}</span>
                </div>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label>Nama Lengkap Pemilik <span class="text-danger">*</span></label>
                    <input type="text" name="nama_pemilik"
                           class="form-control @error('nama_pemilik') is-invalid @enderror"
                           value="{{ old('nama_pemilik', $koperasi->nama_pemilik) }}" required>
                    @error('nama_pemilik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nomor KTP <span class="text-danger">*</span></label>
                    <input type="text" name="no_ktp"
                           class="form-control @error('no_ktp') is-invalid @enderror"
                           value="{{ old('no_ktp', $koperasi->no_ktp) }}" maxlength="20" required>
                    @error('no_ktp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" name="no_telp"
                           class="form-control @error('no_telp') is-invalid @enderror"
                           value="{{ old('no_telp', $koperasi->no_telp) }}">
                    @error('no_telp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email', $koperasi->email) }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Alamat Lengkap <span class="text-danger">*</span></label>
                    <textarea name="alamat" rows="3"
                              class="form-control @error('alamat') is-invalid @enderror"
                              required>{{ old('alamat', $koperasi->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Distrik <span class="text-danger">*</span></label>
                            <select name="distrik" id="distrik_id" class="form-control select2 @error('distrik') is-invalid @enderror" required>
                                <option value="">-- Pilih Distrik --</option>
                                @foreach($distrik as $d)
                                    <option value="{{ $d->nama }}" data-id="{{ $d->id }}" {{ old('distrik', $koperasi->distrik) === $d->nama ? 'selected' : '' }}>
                                        {{ $d->nama }}
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
                            @php
                                $currentDistrik = old('distrik', $koperasi->distrik);
                                $distrikObj = $distrik->firstWhere('nama', $currentDistrik);
                                $distrikId = $distrikObj ? $distrikObj->id : null;
                                $kelurahanList = $distrikId ? $kelurahan->where('distrik_id', $distrikId)->values() : collect();
                                $kampungList = $distrikId ? $kampung->where('distrik_id', $distrikId)->values() : collect();
                                $savedKel = old('kelurahan', $koperasi->kelurahan);
                            @endphp
                            {{-- DEBUG: distrik={{ $currentDistrik }}, id={{ $distrikId }}, kel={{ $kelurahanList->count() }}, kamp={{ $kampungList->count() }} --}}
                            <select name="kelurahan" id="kelurahan_kampung" class="form-control select2 @error('kelurahan') is-invalid @enderror" required>
                                <option value="">-- Pilih Kelurahan/Kampung --</option>
                                @if($kelurahanList->count() > 0)
                                    <optgroup label="Kelurahan">
                                        @foreach($kelurahanList as $w)
                                            <option value="{{ $w->nama }}" {{ $savedKel === $w->nama ? 'selected' : '' }}>{{ $w->nama }}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                                @if($kampungList->count() > 0)
                                    <optgroup label="Kampung">
                                        @foreach($kampungList as $w)
                                            <option value="{{ $w->nama }}" {{ $savedKel === $w->nama ? 'selected' : '' }}>{{ $w->nama }}</option>
                                        @endforeach
                                    </optgroup>
                                @endif
                            </select>
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
        <div class="card card-success card-outline shadow-sm">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-store mr-2"></i>Data Usaha
                </h3>
            </div>
            <div class="card-body">

                <div class="form-group">
                    <label>Nama Usaha <span class="text-danger">*</span></label>
                    <input type="text" name="nama_usaha"
                           class="form-control @error('nama_usaha') is-invalid @enderror"
                           value="{{ old('nama_usaha', $koperasi->nama_usaha) }}" required>
                    @error('nama_usaha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Jenis Usaha <span class="text-danger">*</span></label>
                    <input type="text" name="jenis_usaha"
                           class="form-control @error('jenis_usaha') is-invalid @enderror"
                           value="{{ old('jenis_usaha', $koperasi->jenis_usaha) }}" required>
                    @error('jenis_usaha')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Kategori Usaha <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-control @error('kategori') is-invalid @enderror" required>
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
                            <label>Modal Usaha (Rp)</label>
                            <input type="number" name="modal_usaha"
                                   class="form-control @error('modal_usaha') is-invalid @enderror"
                                   value="{{ old('modal_usaha', $koperasi->modal_usaha) }}" min="0">
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
                                   value="{{ old('omset_per_bulan', $koperasi->omset_per_bulan) }}" min="0">
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
                           value="{{ old('jumlah_karyawan', $koperasi->jumlah_karyawan) }}" min="0">
                    @error('jumlah_karyawan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Info Status --}}
        <div class="card shadow-sm">
            <div class="card-body py-3">
                <table class="table table-sm table-borderless mb-0">
                    <tr>
                        <td class="text-muted" width="45%">Status Verifikasi</td>
                        <td>{!! $koperasi->status_verifikasi_label !!}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Status Usaha</td>
                        <td>{!! $koperasi->status_usaha_label !!}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Terdaftar</td>
                        <td>{{ $koperasi->created_at->format('d M Y') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        {{-- Tombol --}}
        <div class="card shadow-sm">
            <div class="card-body">
                <button type="submit" class="btn btn-warning btn-block py-2 font-weight-bold">
                    <i class="fas fa-save mr-2"></i> Simpan Perubahan
                </button>
                <a href="{{ route('petugas.koperasi.show', $koperasi) }}" class="btn btn-secondary btn-block py-2">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Detail
                </a>
            </div>
        </div>

    </div>
</div>

</form>
@push('scripts')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
const wilayahData = {
    kelurahan: @json($kelurahan->groupBy('distrik_id')),
    kampung: @json($kampung->groupBy('distrik_id'))
};
const distrikNamaToId = @json($distrik->pluck('id', 'nama'));

$(function() {
    $('.select2').select2({ theme: 'bootstrap', width: '100%' });

    $('#distrik_id').on('change select2:select', function() {
        var distrikId = parseInt($('#distrik_id option:selected').attr('data-id'));
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
                $kel.append(grp1);
            }
            if (kampungs.length > 0) {
                var grp2 = $('<optgroup label="Kampung">');
                kampungs.forEach(function(k) {
                    grp2.append('<option value="' + k.nama + '">' + k.nama + '</option>');
                });
                $kel.append(grp2);
            }
        }
        $kel.trigger('change.select2');
    });

    // Trigger saat load untuk isi kelurahan/kampung sesuai distrik yang sudah tersimpan
    var savedKelurahan = "{{ old('kelurahan', $koperasi->kelurahan) }}";
    var distrikId = parseInt($('#distrik_id option:selected').attr('data-id'));

    if (distrikId) {
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
                $kel.append(grp1);
            }
            if (kampungs.length > 0) {
                var grp2 = $('<optgroup label="Kampung">');
                kampungs.forEach(function(k) {
                    grp2.append('<option value="' + k.nama + '">' + k.nama + '</option>');
                });
                $kel.append(grp2);
            }
            $kel.val(savedKelurahan).trigger('change.select2');
        }
    }
});
</script>
@endpush
@endsection