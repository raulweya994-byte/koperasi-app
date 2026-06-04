@extends('layouts.app')
@section('title','Dashboard Koperasi')
@section('page-title','Dashboard Koperasi')
@section('breadcrumb')<li class="breadcrumb-item active">Dashboard</li>@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/koperasi.css') }}">
<style>
/* styles moved to public/css/koperasi.css */

.top-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin-bottom: 25px;
}

.stat-card {
    border-radius: 12px;
    padding: 30px 25px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: white;
    cursor: pointer;
}

.stat-card:hover { transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.15); }

.stat-card.card1 { background: linear-gradient(135deg, #14b8a6, #0d9488); }
.stat-card.card2 { background: linear-gradient(135deg, #22c55e, #16a34a); }
.stat-card.card3 { background: linear-gradient(135deg, #eab308, #ca8a04); }
.stat-card.card4 { background: linear-gradient(135deg, #ef4444, #dc2626); }

.stat-card-value { font-size: 42px; font-weight: 700; line-height: 1; margin-bottom: 8px; }
.stat-card-label { font-size: 14px; font-weight: 600; opacity: 0.95; }
.stat-card-icon { font-size: 52px; opacity: 0.25; }

.info-card {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    margin-bottom: 20px;
}

.info-card-header {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 20px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f1f5f9;
    display: flex;
    align-items: center;
    gap: 8px;
}

.data-row { display: flex; padding: 10px 0; border-bottom: 1px solid #f8fafc; }
.data-label { color: #64748b; font-size: 14px; width: 45%; }
.data-value { color: #1e293b; font-size: 14px; font-weight: 600; }

.aksi-btn {
    border-radius: 10px;
    padding: 18px 15px;
    font-weight: 600;
    font-size: 14px;
    border: none;
    color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    transition: all 0.3s;
    text-decoration: none;
    width: 100%;
}

.aksi-btn:hover { transform: translateY(-2px); color: white; text-decoration: none; }
.aksi-btn i { font-size: 22px; }
.aksi-btn.blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.aksi-btn.green { background: linear-gradient(135deg, #22c55e, #16a34a); }
.aksi-btn.orange { background: linear-gradient(135deg, #f59e0b, #d97706); }
.aksi-btn.teal { background: linear-gradient(135deg, #14b8a6, #0d9488); }

.stat-mini {
    border-radius: 10px;
    padding: 20px;
    color: white;
    text-align: center;
    margin-bottom: 15px;
}

.stat-mini-value { font-size: 26px; font-weight: 700; }
.stat-mini-label { font-size: 12px; opacity: 0.9; margin-top: 4px; }

@media (max-width: 992px) {
    .top-stats { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 576px) {
    .top-stats { grid-template-columns: 1fr; }
    .stat-card-value { font-size: 32px; }
}
</style>
@endpush

@section('content')
<div class="dashboard-container">

    {{-- 4 Kartu Stats --}}
    <div class="top-stats">
        <div class="stat-card card1">
            <div>
                <div class="stat-card-value">{{ ucfirst($koperasi->status_verifikasi) }}</div>
                <div class="stat-card-label">Status Usaha</div>
            </div>
            <div class="stat-card-icon"><i class="fas fa-store"></i></div>
        </div>

        <div class="stat-card card2">
            <div>
                <div class="stat-card-value">{{ $bantuan_aktif }}</div>
                <div class="stat-card-label">Program Bantuan Aktif</div>
            </div>
            <div class="stat-card-icon"><i class="fas fa-hand-holding-usd"></i></div>
        </div>

        <div class="stat-card card3">
            <div>
                <div class="stat-card-value">{{ $riwayat_bantuan }}</div>
                <div class="stat-card-label">Riwayat Bantuan</div>
            </div>
            <div class="stat-card-icon"><i class="fas fa-history"></i></div>
        </div>

        <div class="stat-card card4">
            <div>
                <div class="stat-card-value">{{ $notifikasi_baru }}</div>
                <div class="stat-card-label">Notifikasi Baru</div>
            </div>
            <div class="stat-card-icon"><i class="fas fa-bell"></i></div>
        </div>
    </div>

    <div class="row">
        {{-- Data Usaha --}}
        <div class="col-md-7">
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-store" style="color:#14b8a6"></i> Data Usaha Saya
                </div>
                <div class="data-row"><span class="data-label">Nama Usaha</span><span class="data-value">{{ $koperasi->nama_usaha }}</span></div>
                <div class="data-row"><span class="data-label">No. Registrasi</span><span class="data-value">{{ $koperasi->no_registrasi }}</span></div>
                <div class="data-row"><span class="data-label">Jenis Usaha</span><span class="data-value">{{ $koperasi->jenis_usaha }}</span></div>
                <div class="data-row"><span class="data-label">Kategori</span><span class="data-value">{{ ucfirst($koperasi->kategori) }}</span></div>
                <div class="data-row"><span class="data-label">Pemilik</span><span class="data-value">{{ $koperasi->nama_pemilik }}</span></div>
                <div class="data-row"><span class="data-label">Distrik</span><span class="data-value">{{ $koperasi->distrik }}</span></div>
                <div class="data-row"><span class="data-label">Kelurahan/Kampung</span><span class="data-value">{{ $koperasi->kelurahan }}</span></div>
                <div class="data-row"><span class="data-label">Telepon</span><span class="data-value">{{ $koperasi->no_telp ?? '-' }}</span></div>
                <div class="data-row"><span class="data-label">Terdaftar</span><span class="data-value">{{ $koperasi->created_at->format('d M Y') }}</span></div>
            </div>
        </div>

        {{-- Aksi Cepat + Statistik --}}
        <div class="col-md-5">
            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-bolt" style="color:#f59e0b"></i> Aksi Cepat
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <a href="{{ route('koperasi.bantuan.pengajuan') }}" class="aksi-btn blue">
                            <i class="fas fa-paper-plane"></i> Ajukan Bantuan
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('koperasi.bantuan.index') }}" class="aksi-btn green">
                            <i class="fas fa-list"></i> Program Bantuan
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('koperasi.bantuan.riwayat') }}" class="aksi-btn orange">
                            <i class="fas fa-history"></i> Riwayat Bantuan
                        </a>
                    </div>
                    <div class="col-6 mb-3">
                        <a href="{{ route('koperasi.notifikasi') }}" class="aksi-btn teal">
                            <i class="fas fa-bell"></i> Notifikasi
                            @if($notifikasi_baru > 0)
                                <span class="badge badge-light" style="color:#0d9488">{{ $notifikasi_baru }}</span>
                            @endif
                        </a>
                    </div>
                </div>
            </div>

            <div class="info-card">
                <div class="info-card-header">
                    <i class="fas fa-chart-bar" style="color:#22c55e"></i> Statistik Usaha
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="stat-mini" style="background:linear-gradient(135deg,#3b82f6,#2563eb)">
                            <div class="stat-mini-value">Rp{{ number_format(($koperasi->omset_per_bulan??0)/1000000,1) }}Jt</div>
                            <div class="stat-mini-label">Omset/Bulan</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-mini" style="background:linear-gradient(135deg,#22c55e,#16a34a)">
                            <div class="stat-mini-value">{{ $koperasi->jumlah_karyawan ?? 0 }}</div>
                            <div class="stat-mini-label">Karyawan</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-mini" style="background:linear-gradient(135deg,#8b5cf6,#6d28d9)">
                            <div class="stat-mini-value">{{ $riwayat_bantuan }}</div>
                            <div class="stat-mini-label">Bantuan</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
