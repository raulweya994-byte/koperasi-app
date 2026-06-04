@extends('layouts.app')
@section('title', 'Detail Bantuan')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#10b981,#059669)">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between text-white">
                        <div class="d-flex align-items-center">
                            <div style="width:70px;height:70px;background:rgba(255,255,255,0.2);border-radius:16px;display:flex;align-items:center;justify-content:center;margin-right:20px">
                                <i class="fas fa-hand-holding-usd fa-2x"></i>
                            </div>
                            <div>
                                <h3 class="mb-1 font-weight-bold">{{ $bantuan->nama_bantuan }}</h3>
                                <p class="mb-0" style="opacity:0.9">{{ $bantuan->kode_bantuan }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <a href="{{ route('petugas.bantuan.index') }}" class="btn btn-light" style="border-radius:8px;font-weight:600">
                                <i class="fas fa-arrow-left mr-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        {{-- Info Bantuan --}}
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-body text-center p-4">
                    <div style="width:100px;height:100px;background:linear-gradient(135deg,#10b981,#059669);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px">
                        <i class="fas fa-hand-holding-usd fa-3x text-white"></i>
                    </div>
                    <h4 class="font-weight-bold mb-2" style="color:#1f2937">{{ $bantuan->nama_bantuan }}</h4>
                    <p class="text-muted mb-4">{{ $bantuan->kode_bantuan }}</p>
                    
                    <div class="mb-3">
                        @if($bantuan->status === 'aktif')
                            <span class="badge badge-success" style="padding:10px 20px;border-radius:20px;font-size:14px">
                                <i class="fas fa-check-circle mr-1"></i>AKTIF
                            </span>
                        @elseif($bantuan->status === 'selesai')
                            <span class="badge badge-secondary" style="padding:10px 20px;border-radius:20px;font-size:14px">
                                <i class="fas fa-flag-checkered mr-1"></i>SELESAI
                            </span>
                        @else
                            <span class="badge badge-danger" style="padding:10px 20px;border-radius:20px;font-size:14px">
                                <i class="fas fa-times-circle mr-1"></i>NONAKTIF
                            </span>
                        @endif
                    </div>
                </div>
                
                <div class="card-footer p-0" style="border:none">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center" style="padding:15px 20px">
                            <span class="text-muted"><i class="fas fa-money-bill-wave mr-2"></i>Anggaran</span>
                            <span class="font-weight-bold" style="color:#1f2937">Rp {{ number_format($bantuan->anggaran, 0, ',', '.') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center" style="padding:15px 20px">
                            <span class="text-muted"><i class="fas fa-users mr-2"></i>Kuota</span>
                            <span class="font-weight-bold" style="color:#1f2937">{{ $bantuan->kuota }} Koperasi</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center" style="padding:15px 20px">
                            <span class="text-muted"><i class="fas fa-check-circle mr-2"></i>Penerima</span>
                            <span class="badge badge-{{ $bantuan->jumlah_penerima >= $bantuan->kuota ? 'danger' : 'success' }}" 
                                  style="padding:8px 16px;border-radius:20px;font-size:13px">
                                {{ $bantuan->jumlah_penerima }}/{{ $bantuan->kuota }}
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center" style="padding:15px 20px">
                            <span class="text-muted"><i class="fas fa-calendar mr-2"></i>Tahun</span>
                            <span class="font-weight-bold" style="color:#1f2937">{{ $bantuan->tahun }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Daftar Penerima --}}
        <div class="col-lg-8">
            {{-- Form Tambah Penerima --}}
            @canCreate('bantuan')
                @if($bantuan->status === 'aktif' && $bantuan->jumlah_penerima < $bantuan->kuota)
                <div class="card shadow-sm mb-4" style="border-radius:16px;border:none;border-left:4px solid #10b981">
                    <div class="card-header" style="background:#f0fdf4;border:none;padding:20px">
                        <h6 class="mb-0 font-weight-bold" style="color:#1f2937">
                            <i class="fas fa-plus-circle mr-2 text-success"></i>Tambah Penerima Bantuan
                        </h6>
                    </div>
                    <div class="card-body" style="padding:20px">
                        <form method="POST" action="{{ route('petugas.bantuan.tambahPenerima', $bantuan) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-5 mb-3 mb-md-0">
                                    <label class="font-weight-bold mb-2" style="font-size:13px;color:#6b7280">Pilih Koperasi</label>
                                    <select name="koperasi_id" class="form-control" required style="border-radius:8px;padding:10px">
                                        <option value="">-- Pilih Koperasi --</option>
                                        @foreach($koperasiTersedia as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama_usaha }} ({{ $k->nama_pemilik }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <label class="font-weight-bold mb-2" style="font-size:13px;color:#6b7280">Jumlah Bantuan (Rp)</label>
                                    <input type="number" name="jumlah_bantuan" class="form-control" placeholder="0" min="0" required style="border-radius:8px;padding:10px">
                                </div>
                                <div class="col-md-3">
                                    <label class="font-weight-bold mb-2" style="font-size:13px;color:#6b7280">&nbsp;</label>
                                    <button type="submit" class="btn btn-success btn-block" style="border-radius:8px;padding:10px;font-weight:600">
                                        <i class="fas fa-plus mr-2"></i>Tambah
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
            @endcanCreate

            {{-- Tabel Penerima --}}
            <div class="card shadow-sm" style="border-radius:16px;border:none">
                <div class="card-header" style="background:linear-gradient(135deg,#f8f9fa,#e9ecef);border:none;padding:20px">
                    <h6 class="mb-0 font-weight-bold" style="color:#1f2937">
                        <i class="fas fa-list mr-2"></i>Daftar Penerima Bantuan
                    </h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background:#f8f9fa">
                                <tr>
                                    <th style="padding:15px;border:none;font-weight:700;color:#1f2937">#</th>
                                    <th style="padding:15px;border:none;font-weight:700;color:#1f2937">Nama Usaha</th>
                                    <th style="padding:15px;border:none;font-weight:700;color:#1f2937">Distrik</th>
                                    <th style="padding:15px;border:none;font-weight:700;color:#1f2937">Jumlah (Rp)</th>
                                    <th style="padding:15px;border:none;font-weight:700;color:#1f2937">Status</th>
                                    @canApprove('bantuan')
                                        <th style="padding:15px;border:none;font-weight:700;color:#1f2937;text-align:center">Aksi</th>
                                    @endcanApprove
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bantuan->penerima as $index => $penerima)
                                <tr style="border-bottom:1px solid #f3f4f6">
                                    <td style="padding:15px;color:#6b7280;font-weight:600">{{ $index + 1 }}</td>
                                    <td style="padding:15px">
                                        <div class="font-weight-bold" style="color:#1f2937">{{ $penerima->koperasi->nama_usaha }}</div>
                                        <small class="text-muted">{{ $penerima->koperasi->nama_pemilik }}</small>
                                    </td>
                                    <td style="padding:15px">
                                        <span class="text-muted">{{ $penerima->koperasi->distrik }}</span>
                                    </td>
                                    <td style="padding:15px">
                                        <span class="font-weight-bold" style="color:#1f2937">
                                            Rp {{ number_format($penerima->jumlah_bantuan, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td style="padding:15px">
                                        @if($penerima->status === 'diterima')
                                            <span class="badge badge-success" style="padding:6px 12px;border-radius:20px;font-size:11px">
                                                <i class="fas fa-check-circle mr-1"></i>DITERIMA
                                            </span>
                                        @elseif($penerima->status === 'ditolak')
                                            <span class="badge badge-danger" style="padding:6px 12px;border-radius:20px;font-size:11px">
                                                <i class="fas fa-times-circle mr-1"></i>DITOLAK
                                            </span>
                                        @else
                                            <span class="badge badge-warning" style="padding:6px 12px;border-radius:20px;font-size:11px">
                                                <i class="fas fa-clock mr-1"></i>{{ strtoupper($penerima->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    @canApprove('bantuan')
                                        <td style="padding:15px;text-align:center">
                                            @if($penerima->status !== 'diterima')
                                                <form method="POST" action="{{ route('petugas.bantuan.validasiPenerima', $penerima) }}" style="display:inline">
                                                    @csrf
                                                    <input type="hidden" name="status" value="diterima">
                                                    <button type="submit" class="btn btn-sm btn-success" style="border-radius:6px;padding:6px 12px" title="Setujui">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-muted" style="font-size:12px">
                                                    <i class="fas fa-check-double"></i>
                                                </span>
                                            @endif
                                        </td>
                                    @endcanApprove
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="{{ can_approve('bantuan') ? '6' : '5' }}" style="padding:60px;text-align:center">
                                        <i class="fas fa-inbox fa-4x text-muted mb-3" style="display:block"></i>
                                        <h5 class="text-muted">Belum ada penerima</h5>
                                        <p class="text-muted mb-0">Belum ada koperasi yang menerima bantuan ini</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.table-hover tbody tr:hover {
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
    transition: all 0.2s;
}

.btn-success:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(16,185,129,0.3);
    transition: all 0.2s;
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false,
        customClass: {
            popup: 'swal-modern'
        }
    });
@endif

@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}',
        confirmButtonColor: '#10b981',
        customClass: {
            popup: 'swal-modern'
        }
    });
@endif
</script>

<style>
.swal-modern {
    border-radius: 16px;
    padding: 20px;
}
</style>
@endpush
@endsection
