@extends('public.layouts.app')
@section('title', 'Perdagangan - DISPERINDAGKOP Tolikara')
@section('content')

{{-- Hero Header --}}
<div style="background:linear-gradient(135deg,#0d2240,#1a3a6e);padding:80px 0 60px;position:relative;overflow:hidden">
    <div style="position:absolute;top:0;left:0;right:0;bottom:0;opacity:.05;background:url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><rect width="100" height="100" fill="white"/></svg>') repeat"></div>
    <div class="container" style="position:relative;z-index:1">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div style="display:inline-flex;align-items:center;gap:12px;background:rgba(245,166,35,.15);padding:8px 20px;border-radius:30px;margin-bottom:20px">
                    <i class="fas fa-shopping-cart" style="color:#f5a623;font-size:18px"></i>
                    <span style="color:#f5a623;font-weight:700;font-size:13px;letter-spacing:.5px">BIDANG PERDAGANGAN</span>
                </div>
                <h1 style="color:#fff;font-size:42px;font-weight:800;margin-bottom:16px;line-height:1.2">Perdagangan</h1>
                <p style="color:rgba(255,255,255,.8);font-size:17px;margin-bottom:0;line-height:1.7">Memfasilitasi dan mengembangkan sektor perdagangan untuk meningkatkan perekonomian masyarakat Kabupaten Tolikara</p>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <div style="width:180px;height:180px;background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;box-shadow:0 20px 60px rgba(245,166,35,.4)">
                    <i class="fas fa-shopping-cart" style="font-size:80px;color:#0d2240"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Breadcrumb --}}
<div style="background:#f8f9fa;padding:16px 0;border-bottom:1px solid #e9ecef">
    <div class="container">
        <div class="d-flex align-items-center" style="gap:8px;font-size:14px">
            <a href="{{ route('public.home') }}" style="color:#6c757d;text-decoration:none">
                <i class="fas fa-home"></i> Beranda
            </a>
            <i class="fas fa-chevron-right" style="font-size:10px;color:#adb5bd"></i>
            <span style="color:#1a3a6e;font-weight:600">Perdagangan</span>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div style="padding:60px 0;background:#fff">
    <div class="container">
        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                {{-- Tentang Bidang Perdagangan --}}
                <div style="background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(0,0,0,.08);padding:40px;margin-bottom:30px;border:1px solid #f0f2f7">
                    <div style="display:flex;align-items:center;gap:16px;margin-bottom:30px">
                        <div style="width:60px;height:60px;background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 20px rgba(245,166,35,.3)">
                            <i class="fas fa-info-circle" style="font-size:28px;color:#0d2240"></i>
                        </div>
                        <div>
                            <h2 style="color:#1a3a6e;font-size:28px;font-weight:800;margin:0;line-height:1">Tentang Bidang Perdagangan</h2>
                            <p style="color:#6c757d;font-size:14px;margin:4px 0 0;font-weight:600">Peran dan Fungsi</p>
                        </div>
                    </div>
                    
                    <div style="color:#495057;font-size:15px;line-height:1.9;margin-bottom:24px">
                        <p style="margin-bottom:16px">Bidang Perdagangan merupakan salah satu bidang strategis di Dinas Perindustrian, Perdagangan, dan Koperasi Kabupaten Tolikara yang bertanggung jawab dalam mengatur, membina, dan mengembangkan sektor perdagangan di wilayah Kabupaten Tolikara.</p>
                        <p style="margin-bottom:0">Kami berkomitmen untuk menciptakan iklim perdagangan yang sehat, kondusif, dan berdaya saing tinggi guna meningkatkan kesejahteraan masyarakat melalui berbagai program pembinaan dan pengawasan.</p>
                    </div>
                </div>

                {{-- Tugas Pokok --}}
                <div style="background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(0,0,0,.08);padding:40px;margin-bottom:30px;border:1px solid #f0f2f7">
                    <div style="display:flex;align-items:center;gap:16px;margin-bottom:30px">
                        <div style="width:60px;height:60px;background:linear-gradient(135deg,#1a3a6e,#2d5aa0);border-radius:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 20px rgba(26,58,110,.25)">
                            <i class="fas fa-tasks" style="font-size:28px;color:#f5a623"></i>
                        </div>
                        <div>
                            <h2 style="color:#1a3a6e;font-size:28px;font-weight:800;margin:0;line-height:1">Tugas Pokok</h2>
                            <p style="color:#6c757d;font-size:14px;margin:4px 0 0;font-weight:600">Tanggung Jawab Utama</p>
                        </div>
                    </div>

                    <div style="display:flex;flex-direction:column;gap:16px">
                        <div style="display:flex;gap:16px;padding:20px;background:linear-gradient(135deg,#f0f4ff,#fff);border-radius:12px;border-left:4px solid #1a3a6e">
                            <div style="flex-shrink:0">
                                <div style="width:40px;height:40px;background:#1a3a6e;border-radius:10px;display:flex;align-items:center;justify-content:center">
                                    <i class="fas fa-check" style="color:#f5a623;font-size:18px"></i>
                                </div>
                            </div>
                            <div style="flex:1">
                                <p style="color:#495057;font-size:15px;line-height:1.8;margin:0">Melaksanakan penyusunan kebijakan teknis di bidang perdagangan dalam negeri, perdagangan luar negeri, dan perlindungan konsumen</p>
                            </div>
                        </div>

                        <div style="display:flex;gap:16px;padding:20px;background:linear-gradient(135deg,#fff8f0,#fff);border-radius:12px;border-left:4px solid #f5a623">
                            <div style="flex-shrink:0">
                                <div style="width:40px;height:40px;background:#f5a623;border-radius:10px;display:flex;align-items:center;justify-content:center">
                                    <i class="fas fa-check" style="color:#0d2240;font-size:18px"></i>
                                </div>
                            </div>
                            <div style="flex:1">
                                <p style="color:#495057;font-size:15px;line-height:1.8;margin:0">Melakukan pembinaan dan pengawasan terhadap pelaku usaha perdagangan untuk memastikan kepatuhan terhadap regulasi yang berlaku</p>
                            </div>
                        </div>

                        <div style="display:flex;gap:16px;padding:20px;background:linear-gradient(135deg,#f0f4ff,#fff);border-radius:12px;border-left:4px solid #1a3a6e">
                            <div style="flex-shrink:0">
                                <div style="width:40px;height:40px;background:#1a3a6e;border-radius:10px;display:flex;align-items:center;justify-content:center">
                                    <i class="fas fa-check" style="color:#f5a623;font-size:18px"></i>
                                </div>
                            </div>
                            <div style="flex:1">
                                <p style="color:#495057;font-size:15px;line-height:1.8;margin:0">Memfasilitasi pengembangan sarana dan prasarana perdagangan seperti pasar tradisional dan pusat perbelanjaan</p>
                            </div>
                        </div>

                        <div style="display:flex;gap:16px;padding:20px;background:linear-gradient(135deg,#fff8f0,#fff);border-radius:12px;border-left:4px solid #f5a623">
                            <div style="flex-shrink:0">
                                <div style="width:40px;height:40px;background:#f5a623;border-radius:10px;display:flex;align-items:center;justify-content:center">
                                    <i class="fas fa-check" style="color:#0d2240;font-size:18px"></i>
                                </div>
                            </div>
                            <div style="flex:1">
                                <p style="color:#495057;font-size:15px;line-height:1.8;margin:0">Melakukan monitoring dan evaluasi terhadap perkembangan harga dan ketersediaan barang kebutuhan pokok masyarakat</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Program Unggulan --}}
                <div style="background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(0,0,0,.08);padding:40px;margin-bottom:30px;border:1px solid #f0f2f7">
                    <div style="display:flex;align-items:center;gap:16px;margin-bottom:30px">
                        <div style="width:60px;height:60px;background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 20px rgba(245,166,35,.3)">
                            <i class="fas fa-star" style="font-size:28px;color:#0d2240"></i>
                        </div>
                        <div>
                            <h2 style="color:#1a3a6e;font-size:28px;font-weight:800;margin:0;line-height:1">Program Unggulan</h2>
                            <p style="color:#6c757d;font-size:14px;margin:4px 0 0;font-weight:600">Inisiatif Strategis</p>
                        </div>
                    </div>

                    <div class="row" style="gap:20px 0">
                        {{-- Program 1 --}}
                        <div class="col-md-6">
                            <div style="background:linear-gradient(135deg,#f0f4ff,#fff);border-radius:16px;padding:24px;height:100%;border:2px solid #e8f0fe;transition:all .3s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(26,58,110,.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                                <div style="width:50px;height:50px;background:linear-gradient(135deg,#1a3a6e,#2d5aa0);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:16px">
                                    <i class="fas fa-store" style="color:#f5a623;font-size:24px"></i>
                                </div>
                                <h5 style="color:#1a3a6e;font-weight:700;font-size:17px;margin-bottom:12px">Revitalisasi Pasar Tradisional</h5>
                                <p style="color:#6c757d;font-size:14px;line-height:1.8;margin:0">Pembenahan dan modernisasi pasar tradisional untuk meningkatkan kenyamanan pedagang dan pembeli</p>
                            </div>
                        </div>

                        {{-- Program 2 --}}
                        <div class="col-md-6">
                            <div style="background:linear-gradient(135deg,#fff8f0,#fff);border-radius:16px;padding:24px;height:100%;border:2px solid #fef3e8;transition:all .3s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(245,166,35,.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                                <div style="width:50px;height:50px;background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:16px">
                                    <i class="fas fa-chart-line" style="color:#0d2240;font-size:24px"></i>
                                </div>
                                <h5 style="color:#1a3a6e;font-weight:700;font-size:17px;margin-bottom:12px">Stabilisasi Harga</h5>
                                <p style="color:#6c757d;font-size:14px;line-height:1.8;margin:0">Monitoring dan pengendalian harga barang kebutuhan pokok untuk menjaga daya beli masyarakat</p>
                            </div>
                        </div>

                        {{-- Program 3 --}}
                        <div class="col-md-6">
                            <div style="background:linear-gradient(135deg,#f0f4ff,#fff);border-radius:16px;padding:24px;height:100%;border:2px solid #e8f0fe;transition:all .3s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(26,58,110,.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                                <div style="width:50px;height:50px;background:linear-gradient(135deg,#1a3a6e,#2d5aa0);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:16px">
                                    <i class="fas fa-shield-alt" style="color:#f5a623;font-size:24px"></i>
                                </div>
                                <h5 style="color:#1a3a6e;font-weight:700;font-size:17px;margin-bottom:12px">Perlindungan Konsumen</h5>
                                <p style="color:#6c757d;font-size:14px;line-height:1.8;margin:0">Pengawasan produk beredar dan penanganan pengaduan konsumen untuk melindungi hak konsumen</p>
                            </div>
                        </div>

                        {{-- Program 4 --}}
                        <div class="col-md-6">
                            <div style="background:linear-gradient(135deg,#fff8f0,#fff);border-radius:16px;padding:24px;height:100%;border:2px solid #fef3e8;transition:all .3s" onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 30px rgba(245,166,35,.15)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                                <div style="width:50px;height:50px;background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-bottom:16px">
                                    <i class="fas fa-graduation-cap" style="color:#0d2240;font-size:24px"></i>
                                </div>
                                <h5 style="color:#1a3a6e;font-weight:700;font-size:17px;margin-bottom:12px">Pembinaan Pedagang</h5>
                                <p style="color:#6c757d;font-size:14px;line-height:1.8;margin:0">Pelatihan dan pendampingan bagi pedagang untuk meningkatkan kapasitas dan daya saing usaha</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Layanan --}}
                <div style="background:linear-gradient(135deg,#1a3a6e,#0d2240);border-radius:20px;padding:40px;position:relative;overflow:hidden">
                    <div style="position:absolute;top:-50px;right:-50px;width:200px;height:200px;background:rgba(245,166,35,.1);border-radius:50%"></div>
                    <div style="position:absolute;bottom:-30px;left:-30px;width:150px;height:150px;background:rgba(245,166,35,.08);border-radius:50%"></div>
                    
                    <div style="position:relative;z-index:1">
                        <h3 style="color:#fff;font-size:24px;font-weight:800;margin-bottom:24px;text-align:center">
                            <i class="fas fa-concierge-bell" style="color:#f5a623;margin-right:10px"></i>Layanan Kami
                        </h3>
                        <div class="row" style="gap:16px 0">
                            <div class="col-md-6">
                                <div style="background:rgba(255,255,255,.1);border-radius:12px;padding:20px;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.2)">
                                    <div style="display:flex;align-items:center;gap:12px">
                                        <i class="fas fa-file-alt" style="color:#f5a623;font-size:24px"></i>
                                        <div>
                                            <h6 style="color:#fff;font-weight:700;margin:0;font-size:15px">Perizinan Usaha</h6>
                                            <p style="color:rgba(255,255,255,.7);font-size:13px;margin:4px 0 0">SIUP, TDP, dan izin lainnya</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background:rgba(255,255,255,.1);border-radius:12px;padding:20px;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.2)">
                                    <div style="display:flex;align-items:center;gap:12px">
                                        <i class="fas fa-search" style="color:#f5a623;font-size:24px"></i>
                                        <div>
                                            <h6 style="color:#fff;font-weight:700;margin:0;font-size:15px">Pengawasan Pasar</h6>
                                            <p style="color:rgba(255,255,255,.7);font-size:13px;margin:4px 0 0">Monitoring harga dan stok</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background:rgba(255,255,255,.1);border-radius:12px;padding:20px;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.2)">
                                    <div style="display:flex;align-items:center;gap:12px">
                                        <i class="fas fa-handshake" style="color:#f5a623;font-size:24px"></i>
                                        <div>
                                            <h6 style="color:#fff;font-weight:700;margin:0;font-size:15px">Fasilitasi Promosi</h6>
                                            <p style="color:rgba(255,255,255,.7);font-size:13px;margin:4px 0 0">Pameran dan expo produk</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background:rgba(255,255,255,.1);border-radius:12px;padding:20px;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.2)">
                                    <div style="display:flex;align-items:center;gap:12px">
                                        <i class="fas fa-comments" style="color:#f5a623;font-size:24px"></i>
                                        <div>
                                            <h6 style="color:#fff;font-weight:700;margin:0;font-size:15px">Konsultasi Bisnis</h6>
                                            <p style="color:rgba(255,255,255,.7);font-size:13px;margin:4px 0 0">Pendampingan usaha</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="col-lg-4">
                {{-- Menu Profil --}}
                <div style="background:#fff;border-radius:16px;box-shadow:0 8px 30px rgba(0,0,0,.08);overflow:hidden;margin-bottom:24px;border:1px solid #f0f2f7">
                    <div style="background:linear-gradient(135deg,#1a3a6e,#2d5aa0);padding:20px">
                        <h5 style="color:#fff;font-weight:700;margin:0;font-size:16px">
                            <i class="fas fa-building" style="color:#f5a623;margin-right:10px"></i>Menu Profil
                        </h5>
                    </div>
                    <div style="padding:8px">
                        @php
                        $menuProfil = [
                            ['visi-misi','fas fa-bullseye','Visi & Misi'],
                            ['struktur-organisasi','fas fa-sitemap','Struktur Organisasi'],
                            ['perindustrian','fas fa-industry','Perindustrian'],
                            ['perdagangan','fas fa-shopping-cart','Perdagangan'],
                            ['komitmen','fas fa-award','Komitmen'],
                            ['koperasi','fas fa-handshake','Koperasi'],
                        ];
                        @endphp
                        @foreach($menuProfil as $m)
                        <a href="{{ route('public.halaman', $m[0]) }}" 
                           style="display:flex;align-items:center;gap:12px;padding:14px 16px;border-radius:10px;text-decoration:none;transition:all .2s;margin-bottom:4px;{{ $m[0] === 'perdagangan' ? 'background:linear-gradient(135deg,#1a3a6e,#2d5aa0);color:#fff' : 'color:#495057' }}"
                           onmouseover="if('{{ $m[0] }}' !== 'perdagangan') this.style.background='#f8f9fa'"
                           onmouseout="if('{{ $m[0] }}' !== 'perdagangan') this.style.background='transparent'">
                            <i class="{{ $m[1] }}" style="width:20px;color:{{ $m[0] === 'perdagangan' ? '#f5a623' : '#6c757d' }};font-size:16px"></i>
                            <span style="font-weight:600;font-size:14px">{{ $m[2] }}</span>
                            @if($m[0] === 'perdagangan')
                            <i class="fas fa-chevron-right ml-auto" style="color:#f5a623;font-size:12px"></i>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Contact Box --}}
                <div style="background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:16px;padding:30px;box-shadow:0 8px 30px rgba(245,166,35,.3);margin-bottom:24px">
                    <div style="text-align:center;margin-bottom:20px">
                        <i class="fas fa-phone-alt" style="font-size:48px;color:#0d2240"></i>
                    </div>
                    <h5 style="color:#0d2240;font-weight:800;text-align:center;margin-bottom:16px;font-size:18px">Hubungi Kami</h5>
                    <div style="background:rgba(13,34,64,.1);border-radius:10px;padding:16px;margin-bottom:16px">
                        <p style="color:#0d2240;font-size:13px;margin-bottom:8px;font-weight:600">
                            <i class="fas fa-map-marker-alt" style="width:20px"></i>Jl. Raya Karubaga, Tolikara
                        </p>
                        <p style="color:#0d2240;font-size:13px;margin-bottom:8px;font-weight:600">
                            <i class="fas fa-phone" style="width:20px"></i>(0964) 123456
                        </p>
                        <p style="color:#0d2240;font-size:13px;margin:0;font-weight:600">
                            <i class="fas fa-envelope" style="width:20px"></i>perdagangan@tolikara.go.id
                        </p>
                    </div>
                    <a href="{{ route('public.kontak') }}" style="display:block;background:#0d2240;color:#fff;text-align:center;padding:12px;border-radius:10px;text-decoration:none;font-weight:700;font-size:14px;transition:all .2s" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 20px rgba(13,34,64,.3)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                        <i class="fas fa-paper-plane mr-2"></i>Kirim Pesan
                    </a>
                </div>

                {{-- Info Penting --}}
                <div style="background:#fff;border-radius:16px;box-shadow:0 8px 30px rgba(0,0,0,.08);padding:24px;border:1px solid #f0f2f7">
                    <h6 style="color:#1a3a6e;font-weight:700;margin-bottom:20px;font-size:15px">
                        <i class="fas fa-exclamation-circle" style="color:#f5a623;margin-right:8px"></i>Info Penting
                    </h6>
                    <div style="background:linear-gradient(135deg,#fff8f0,#fff);border-left:4px solid #f5a623;padding:16px;border-radius:8px;margin-bottom:12px">
                        <h6 style="color:#1a3a6e;font-weight:700;font-size:14px;margin-bottom:8px">Jam Operasional</h6>
                        <p style="color:#6c757d;font-size:13px;margin:0">Senin - Jumat: 08.00 - 16.00 WIT</p>
                    </div>
                    <div style="background:linear-gradient(135deg,#f0f4ff,#fff);border-left:4px solid #1a3a6e;padding:16px;border-radius:8px">
                        <h6 style="color:#1a3a6e;font-weight:700;font-size:14px;margin-bottom:8px">Pengaduan</h6>
                        <p style="color:#6c757d;font-size:13px;margin:0">Laporkan pelanggaran perdagangan ke hotline kami</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
