@extends('public.layouts.app')
@section('title','Bantuan Modal')
@section('content')
<section style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);padding:60px 0 40px;color:white;">
    <div class="container text-center">
        <i class="fas fa-hand-holding-usd fa-2x mb-3 d-block" style="opacity:.8"></i>
        <h2 class="font-weight-bold mb-2">Pengajuan Bantuan Modal</h2>
        <p style="opacity:.75">Ajukan bantuan modal usaha untuk mengembangkan bisnis Anda</p>
    </div>
</section>
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('success'))
                <div class="alert alert-success"><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</div>
                @endif
                <div class="row mb-4">
                    @foreach([['icon'=>'fas fa-money-bill-wave','color'=>'#28a745','label'=>'Modal Usaha','desc'=>'Bantuan modal untuk memulai atau mengembangkan usaha'],['icon'=>'fas fa-tools','color'=>'#f5a623','label'=>'Peralatan','desc'=>'Bantuan peralatan produksi untuk meningkatkan kapasitas'],['icon'=>'fas fa-bullhorn','color'=>'#dc3545','label'=>'Pemasaran','desc'=>'Bantuan biaya pemasaran dan promosi produk Koperasi']] as $j)
                    <div class="col-md-4 mb-3">
                        <div class="card border-0 shadow-sm text-center p-3" style="border-radius:10px;border-top:3px solid {{ $j['color'] }}!important;">
                            <i class="{{ $j['icon'] }} fa-2x mb-2" style="color:{{ $j['color'] }}"></i>
                            <h6 class="font-weight-bold">{{ $j['label'] }}</h6>
                            <p class="text-muted small mb-0">{{ $j['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="card border-0 shadow-sm" style="border-radius:12px;">
                    <div class="card-header" style="background:#1a3a6e;color:white;border-radius:12px 12px 0 0;">
                        <h5 class="mb-0"><i class="fas fa-file-alt mr-2"></i>Form Pengajuan Bantuan Modal</h5>
                    </div>
                    <form method="POST" action="{{ route('bantuan-modal.store') }}">
                        @csrf
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_pemohon" class="form-control @error('nama_pemohon') is-invalid @enderror" value="{{ old('nama_pemohon') }}" required>
                                        @error('nama_pemohon')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label>No HP <span class="text-danger">*</span></label>
                                        <input type="text" name="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}" required>
                                        @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Usaha <span class="text-danger">*</span></label>
                                        <input type="text" name="nama_usaha" class="form-control @error('nama_usaha') is-invalid @enderror" value="{{ old('nama_usaha') }}" required>
                                        @error('nama_usaha')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Bantuan <span class="text-danger">*</span></label>
                                        <select name="jenis_bantuan" class="form-control" required>
                                            <option value="">-- Pilih Jenis Bantuan --</option>
                                            <option value="Bantuan Tunai" {{ old('jenis_bantuan')=='Bantuan Tunai'?'selected':'' }}>Bantuan Tunai</option>
                                            <option value="Bantuan Modal Usaha" {{ old('jenis_bantuan')=='Bantuan Modal Usaha'?'selected':'' }}>Bantuan Modal Usaha</option>
                                            <option value="Bantuan Peralatan" {{ old('jenis_bantuan')=='Bantuan Peralatan'?'selected':'' }}>Bantuan Peralatan</option>
                                            <option value="Bantuan Sembako" {{ old('jenis_bantuan')=='Bantuan Sembako'?'selected':'' }}>Bantuan Sembako</option>
                                            <option value="Bantuan Pupuk &amp; Bibit" {{ old('jenis_bantuan')=='Bantuan Pupuk &amp; Bibit'?'selected':'' }}>Bantuan Pupuk &amp; Bibit</option>
                                            <option value="Bantuan Ternak" {{ old('jenis_bantuan')=='Bantuan Ternak'?'selected':'' }}>Bantuan Ternak</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah Diajukan (Rp)</label>
                                        <input type="number" name="jumlah_diajukan" class="form-control" value="{{ old('jumlah_diajukan') }}" placeholder="0">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Tujuan Penggunaan <span class="text-danger">*</span></label>
                                <textarea name="tujuan_penggunaan" class="form-control @error('tujuan_penggunaan') is-invalid @enderror" rows="4" required>{{ old('tujuan_penggunaan') }}</textarea>
                                @error('tujuan_penggunaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-paper-plane mr-1"></i>Kirim Pengajuan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection