@extends('layouts.app')
@section('title', 'Pengajuan Bantuan')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card page-header-card">
                <div class="card-body">
                    <div class="d-flex align-items-center text-white">
                        <div class="page-header-icon">
                            <i class="fas fa-hand-holding-usd"></i>
                        </div>
                        <div>
                            <h3 class="page-header-title">Pengajuan Bantuan</h3>
                            <p class="page-header-subtitle">Ajukan bantuan sesuai periode yang aktif</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="close" data-dismiss="alert">
            <span>&times;</span>
        </button>
    </div>
    @endif

    @php
        $periodeAktif = \App\Models\PeriodeBantuan::aktif()->first();
    @endphp

    @if(!$periodeAktif)
    {{-- Tidak Ada Periode Aktif --}}
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px;">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-calendar-times" style="font-size: 80px; color: #e0e0e0;"></i>
                    </div>
                    <h4 class="font-weight-bold mb-3" style="color: #6c757d;">Belum Ada Periode Bantuan Aktif</h4>
                    <p class="text-muted mb-4">
                        Saat ini belum ada periode penerimaan pengajuan bantuan yang aktif.<br>
                        Silakan tunggu pengumuman periode berikutnya dari admin.
                    </p>
                    <div class="alert alert-info d-inline-block">
                        <i class="fas fa-info-circle me-2"></i>
                        Anda akan mendapat notifikasi ketika periode baru dibuka
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    {{-- Ada Periode Aktif --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 15px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <div class="card-body text-white p-4">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h4 class="font-weight-bold mb-2">
                                <i class="fas fa-calendar-check me-2"></i>
                                {{ $periodeAktif->nama_periode }}
                            </h4>
                            @if($periodeAktif->deskripsi)
                            <p class="mb-3">{{ $periodeAktif->deskripsi }}</p>
                            @endif
                            <div class="d-flex flex-wrap gap-3">
                                <div>
                                    <small class="d-block opacity-75">Periode Pendaftaran</small>
                                    <strong>
                                        <i class="far fa-calendar me-1"></i>
                                        {{ $periodeAktif->tanggal_mulai->format('d M Y') }} - 
                                        {{ $periodeAktif->tanggal_selesai->format('d M Y') }}
                                    </strong>
                                </div>
                                @if($periodeAktif->kuota_penerima)
                                <div class="ms-4">
                                    <small class="d-block opacity-75">Kuota Tersedia</small>
                                    <strong>
                                        <i class="fas fa-users me-1"></i>
                                        {{ $periodeAktif->sisaKuota() }} / {{ $periodeAktif->kuota_penerima }} orang
                                    </strong>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="bg-white text-dark rounded p-3">
                                <h2 class="mb-0 font-weight-bold" style="color: #667eea;">
                                    {{ $periodeAktif->tanggal_selesai->diffInDays(now()) }}
                                </h2>
                                <small>Hari Tersisa</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @php
        $koperasi = \App\Models\Koperasi::where('user_id', auth()->id())->first();
        $sudahMengajukan = $koperasi ? \App\Models\PengajuanBantuan::where('koperasi_id', $koperasi->id)
            ->where('periode_bantuan_id', $periodeAktif->id)
            ->exists() : false;
    @endphp

    @if($sudahMengajukan)
    {{-- Sudah Mengajukan --}}
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success" style="border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-check-circle fa-3x me-3"></i>
                    <div>
                        <h5 class="mb-1">Pengajuan Anda Sudah Tercatat</h5>
                        <p class="mb-0">Anda sudah mengajukan bantuan untuk periode ini. Silakan tunggu proses verifikasi dari admin.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif($periodeAktif->kuota_penerima && $periodeAktif->sisaKuota() <= 0)
    {{-- Kuota Habis --}}
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning" style="border-radius: 12px;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-exclamation-triangle fa-3x me-3"></i>
                    <div>
                        <h5 class="mb-1">Kuota Sudah Penuh</h5>
                        <p class="mb-0">Maaf, kuota penerima bantuan untuk periode ini sudah terpenuhi. Silakan tunggu periode berikutnya.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    {{-- Form Pengajuan --}}
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="content-card">
                <div class="content-card-header">
                    <h5 class="content-card-title">
                        <i class="fas fa-file-alt"></i> Form Pengajuan Bantuan
                    </h5>
                </div>
                
                <div class="content-card-body">
                    <form action="{{ route('koperasi.bantuan.pengajuan.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="periode_bantuan_id" value="{{ $periodeAktif->id }}">
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Pastikan semua data yang Anda isi sudah benar dan lengkap
                        </div>

                        <div class="form-group">
                            <label>Nama Pemohon <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="nama_pemohon" 
                                   class="form-control @error('nama_pemohon') is-invalid @enderror" 
                                   value="{{ old('nama_pemohon', $koperasi->nama_ketua ?? '') }}"
                                   required>
                            @error('nama_pemohon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>No. HP <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           name="no_hp" 
                                           class="form-control @error('no_hp') is-invalid @enderror" 
                                           value="{{ old('no_hp', $koperasi->no_hp ?? '') }}"
                                           required>
                                    @error('no_hp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" 
                                           name="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           value="{{ old('email', $koperasi->email ?? '') }}"
                                           required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Nama Usaha <span class="text-danger">*</span></label>
                            <input type="text" 
                                   name="nama_usaha" 
                                   class="form-control @error('nama_usaha') is-invalid @enderror" 
                                   value="{{ old('nama_usaha', $koperasi->nama_koperasi ?? '') }}"
                                   required>
                            @error('nama_usaha')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jenis Bantuan <span class="text-danger">*</span></label>
                            <select name="jenis_bantuan" 
                                    class="form-control @error('jenis_bantuan') is-invalid @enderror" 
                                    required>
                                <option value="">Pilih Jenis Bantuan</option>
                                <option value="Modal Usaha" {{ old('jenis_bantuan')=='Modal Usaha'?'selected':'' }}>Modal Usaha</option>
                                <option value="Peralatan" {{ old('jenis_bantuan')=='Peralatan'?'selected':'' }}>Peralatan</option>
                                <option value="Pelatihan" {{ old('jenis_bantuan')=='Pelatihan'?'selected':'' }}>Pelatihan</option>
                                <option value="Lainnya" {{ old('jenis_bantuan')=='Lainnya'?'selected':'' }}>Lainnya</option>
                            </select>
                            @error('jenis_bantuan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Jumlah Bantuan Diajukan (Rp) <span class="text-danger">*</span></label>
                            <input type="number" 
                                   name="jumlah_diajukan" 
                                   class="form-control @error('jumlah_diajukan') is-invalid @enderror" 
                                   value="{{ old('jumlah_diajukan') }}"
                                   min="0"
                                   step="1000"
                                   required>
                            @error('jumlah_diajukan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Tujuan Penggunaan <span class="text-danger">*</span></label>
                            <textarea name="tujuan_penggunaan" 
                                      class="form-control @error('tujuan_penggunaan') is-invalid @enderror" 
                                      rows="4"
                                      placeholder="Jelaskan secara detail untuk apa bantuan ini akan digunakan..."
                                      required>{{ old('tujuan_penggunaan') }}</textarea>
                            @error('tujuan_penggunaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Perhatian:</strong> Pastikan data yang Anda isi sudah benar. Pengajuan yang sudah dikirim tidak dapat diubah.
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary-modern btn-lg">
                                <i class="fas fa-paper-plane me-1"></i> Kirim Pengajuan
                            </button>
                            <a href="{{ route('koperasi.dashboard') }}" class="btn btn-secondary btn-lg">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endif
</div>
@endsection
