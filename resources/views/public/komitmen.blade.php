@extends('public.layouts.app')
@section('title', 'Komitmen Layanan - DISPERINDAGKOP Tolikara')
@section('content')

{{-- Hero Header --}}
<div style="background:linear-gradient(135deg,#0d2240,#1a3a6e);padding:80px 0 60px;position:relative;overflow:hidden">
    <div class="container" style="position:relative;z-index:1">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div style="display:inline-flex;align-items:center;gap:12px;background:rgba(245,166,35,.15);padding:8px 20px;border-radius:30px;margin-bottom:20px">
                    <i class="fas fa-award" style="color:#f5a623;font-size:18px"></i>
                    <span style="color:#f5a623;font-weight:700;font-size:13px;letter-spacing:.5px">PROFIL DINAS</span>
                </div>
                <h1 style="color:#fff;font-size:42px;font-weight:800;margin-bottom:16px;line-height:1.2">Komitmen Layanan</h1>
                <p style="color:rgba(255,255,255,.8);font-size:17px;margin-bottom:0;line-height:1.7">Janji dan komitmen DISPERINDAGKOP Kabupaten Tolikara dalam memberikan pelayanan terbaik kepada masyarakat</p>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <div style="width:180px;height:180px;background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;box-shadow:0 20px 60px rgba(245,166,35,.4)">
                    <i class="fas fa-award" style="font-size:80px;color:#0d2240"></i>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Breadcrumb --}}
<div style="background:#f8f9fa;padding:16px 0;border-bottom:1px solid #e9ecef">
    <div class="container">
        <div class="d-flex align-items-center" style="gap:8px;font-size:14px">
            <a href="{{ route('public.home') }}" style="color:#6c757d;text-decoration:none"><i class="fas fa-home"></i> Beranda</a>
            <i class="fas fa-chevron-right" style="font-size:10px;color:#adb5bd"></i>
            <span style="color:#1a3a6e;font-weight:600">Komitmen Layanan</span>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div style="padding:60px 0;background:#fff">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">

                {{-- Pernyataan Komitmen --}}
                <div style="background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(0,0,0,.08);padding:40px;margin-bottom:30px;border:1px solid #f0f2f7">
                    <div style="display:flex;align-items:center;gap:16px;margin-bottom:30px">
                        <div style="width:60px;height:60px;background:linear-gradient(135deg,#1a3a6e,#2d5aa0);border-radius:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 20px rgba(26,58,110,.25)">
                            <i class="fas fa-handshake" style="font-size:28px;color:#f5a623"></i>
                        </div>
                        <div>
                            <h2 style="color:#1a3a6e;font-size:28px;font-weight:800;margin:0;line-height:1">Pernyataan Komitmen</h2>
                            <p style="color:#6c757d;font-size:14px;margin:4px 0 0;font-weight:600">Janji Pelayanan Kami</p>
                        </div>
                    </div>
                    <div style="background:linear-gradient(135deg,#f0f4ff,#e8f0fe);border-left:4px solid #1a3a6e;padding:30px;border-radius:12px;margin-bottom:20px">
                        <p style="font-size:17px;line-height:1.9;color:#1a3a6e;font-weight:600;margin:0;font-style:italic">
                            "Kami berkomitmen untuk memberikan pelayanan publik yang profesional, transparan, dan berorientasi pada kepuasan masyarakat Kabupaten Tolikara demi terwujudnya perekonomian yang maju dan sejahtera."
                        </p>
                    </div>
                    <p style="color:#6c757d;font-size:15px;line-height:1.9;margin:0">Komitmen ini merupakan landasan kami dalam setiap pelayanan kepada masyarakat, pelaku usaha, dan seluruh pemangku kepentingan di Kabupaten Tolikara.</p>
                </div>

                {{-- 6 Komitmen Utama --}}
                <div style="background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(0,0,0,.08);padding:40px;margin-bottom:30px;border:1px solid #f0f2f7">
                    <div style="display:flex;align-items:center;gap:16px;margin-bottom:30px">
                        <div style="width:60px;height:60px;background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 20px rgba(245,166,35,.3)">
                            <i class="fas fa-star" style="font-size:28px;color:#0d2240"></i>
                        </div>
                        <div>
                            <h2 style="color:#1a3a6e;font-size:28px;font-weight:800;margin:0;line-height:1">6 Komitmen Utama</h2>
                            <p style="color:#6c757d;font-size:14px;margin:4px 0 0;font-weight:600">Standar Pelayanan Kami</p>
                        </div>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:20px">
                        @php
                        $komitmen = [
                            ['fas fa-clock','Ketepatan Waktu','Memberikan pelayanan sesuai dengan standar waktu yang telah ditetapkan tanpa penundaan yang tidak perlu','#1a3a6e','#f0f4ff','#e8f0fe'],
                            ['fas fa-shield-alt','Transparansi','Memberikan informasi yang jelas, akurat, dan mudah diakses oleh seluruh masyarakat tentang proses dan syarat pelayanan','#f5a623','#fff8f0','#fef3e8'],
                            ['fas fa-user-tie','Profesionalisme','Melayani dengan sikap yang ramah, sopan, dan kompeten sesuai dengan tugas dan fungsi masing-masing bidang','#1a3a6e','#f0f4ff','#e8f0fe'],
                            ['fas fa-balance-scale','Keadilan','Memberikan pelayanan yang adil dan merata tanpa diskriminasi kepada seluruh masyarakat dan pelaku usaha','#f5a623','#fff8f0','#fef3e8'],
                            ['fas fa-leaf','Keberlanjutan','Mendukung pengembangan usaha yang berkelanjutan dan ramah lingkungan untuk generasi mendatang','#1a3a6e','#f0f4ff','#e8f0fe'],
                            ['fas fa-chart-line','Peningkatan Berkelanjutan','Terus berinovasi dan meningkatkan kualitas layanan berdasarkan masukan dan evaluasi dari masyarakat','#f5a623','#fff8f0','#fef3e8'],
                        ];
                        @endphp
                        @foreach($komitmen as $i => $k)
                        <div style="display:flex;gap:20px;background:linear-gradient(135deg,{{ $k[4] }},#fff);border-radius:16px;padding:24px;border:2px solid {{ $k[5] }};transition:all .3s"
                             onmouseover="this.style.transform='translateX(8px)';this.style.borderColor='{{ $k[3] }}'"
                             onmouseout="this.style.transform='translateX(0)';this.style.borderColor='{{ $k[5] }}'">
                            <div style="flex-shrink:0">
                                <div style="width:52px;height:52px;background:{{ $k[3] }};border-radius:14px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,.15)">
                                    <i class="{{ $k[0] }}" style="color:{{ $k[3] === '#1a3a6e' ? '#f5a623' : '#0d2240' }};font-size:22px"></i>
                                </div>
                            </div>
                            <div style="flex:1">
                                <h5 style="color:#1a3a6e;font-weight:700;font-size:17px;margin-bottom:8px">{{ $i+1 }}. {{ $k[1] }}</h5>
                                <p style="color:#6c757d;font-size:15px;line-height:1.8;margin:0">{{ $k[2] }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                {{-- Maklumat Pelayanan --}}
                <div style="background:linear-gradient(135deg,#1a3a6e,#0d2240);border-radius:20px;padding:40px;position:relative;overflow:hidden">
                    <div style="position:absolute;top:-50px;right:-50px;width:200px;height:200px;background:rgba(245,166,35,.1);border-radius:50%"></div>
                    <div style="position:absolute;bottom:-30px;left:-30px;width:150px;height:150px;background:rgba(245,166,35,.08);border-radius:50%"></div>
                    <div style="position:relative;z-index:1;text-align:center">
                        <i class="fas fa-medal" style="font-size:48px;color:#f5a623;margin-bottom:20px"></i>
                        <h3 style="color:#fff;font-size:24px;font-weight:800;margin-bottom:16px">Maklumat Pelayanan</h3>
                        <p style="color:rgba(255,255,255,.85);font-size:16px;line-height:1.9;font-style:italic;margin-bottom:24px">
                            "Dengan ini kami menyatakan sanggup menyelenggarakan pelayanan sesuai standar pelayanan yang telah ditetapkan dan apabila tidak menepati janji ini, kami siap menerima sanksi sesuai peraturan perundang-undangan yang berlaku."
                        </p>
                        <div style="display:inline-block;background:rgba(245,166,35,.15);border:1px solid rgba(245,166,35,.3);border-radius:12px;padding:12px 24px">
                            <span style="color:#f5a623;font-weight:700;font-size:14px">DISPERINDAGKOP Kabupaten Tolikara</span>
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
                            ['komitmen','fas fa-award','Komitmen'],
                            ['perindustrian','fas fa-industry','Perindustrian'],
                            ['perdagangan','fas fa-shopping-cart','Perdagangan'],
                            ['koperasi','fas fa-handshake','Koperasi'],
                        ];
                        @endphp
                        @foreach($menuProfil as $m)
                        <a href="{{ route('public.halaman', $m[0]) }}"
                           style="display:flex;align-items:center;gap:12px;padding:14px 16px;border-radius:10px;text-decoration:none;transition:all .2s;margin-bottom:4px;{{ $m[0] === 'komitmen' ? 'background:linear-gradient(135deg,#1a3a6e,#2d5aa0);color:#fff' : 'color:#495057' }}"
                           onmouseover="if('{{ $m[0] }}' !== 'komitmen') this.style.background='#f8f9fa'"
                           onmouseout="if('{{ $m[0] }}' !== 'komitmen') this.style.background='transparent'">
                            <i class="{{ $m[1] }}" style="width:20px;color:{{ $m[0] === 'komitmen' ? '#f5a623' : '#6c757d' }};font-size:16px"></i>
                            <span style="font-weight:600;font-size:14px">{{ $m[2] }}</span>
                            @if($m[0] === 'komitmen')
                            <i class="fas fa-chevron-right ml-auto" style="color:#f5a623;font-size:12px"></i>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Info Box --}}
                <div style="background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:16px;padding:30px;box-shadow:0 8px 30px rgba(245,166,35,.3);margin-bottom:24px">
                    <div style="text-align:center;margin-bottom:20px">
                        <i class="fas fa-phone-alt" style="font-size:48px;color:#0d2240"></i>
                    </div>
                    <h5 style="color:#0d2240;font-weight:800;text-align:center;margin-bottom:16px;font-size:18px">Ada Pengaduan?</h5>
                    <p style="color:#0d2240;font-size:14px;text-align:center;margin-bottom:20px;opacity:.9">Sampaikan masukan atau pengaduan layanan kepada kami</p>
                    <a href="{{ route('public.kontak') }}" style="display:block;background:#0d2240;color:#fff;text-align:center;padding:12px;border-radius:10px;text-decoration:none;font-weight:700;font-size:14px" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
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
                        <h6 style="color:#1a3a6e;font-weight:700;font-size:14px;margin-bottom:8px">SP4N-LAPOR!</h6>
                        <p style="color:#6c757d;font-size:13px;margin:0">Sampaikan pengaduan melalui aplikasi SP4N-LAPOR untuk penanganan resmi</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
