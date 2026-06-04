@extends('public.layouts.app')
@section('title', 'Visi & Misi - DISPERINDAGKOP Tolikara')
@section('content')

{{-- Hero Header --}}
<div style="background:linear-gradient(135deg,#0d2240,#1a3a6e);padding:80px 0 60px;position:relative;overflow:hidden">
    <div style="position:absolute;top:0;left:0;right:0;bottom:0;opacity:.05;background:url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="40" fill="white"/></svg>') repeat"></div>
    <div class="container" style="position:relative;z-index:1">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <div style="display:inline-flex;align-items:center;gap:12px;background:rgba(245,166,35,.15);padding:8px 20px;border-radius:30px;margin-bottom:20px">
                    <i class="fas fa-bullseye" style="color:#f5a623;font-size:18px"></i>
                    <span style="color:#f5a623;font-weight:700;font-size:13px;letter-spacing:.5px">PROFIL DINAS</span>
                </div>
                <h1 style="color:#fff;font-size:42px;font-weight:800;margin-bottom:16px;line-height:1.2">Visi & Misi</h1>
                <p style="color:rgba(255,255,255,.8);font-size:17px;margin-bottom:0;line-height:1.7">Arah dan tujuan strategis Dinas Perindustrian, Perdagangan, dan Koperasi Kabupaten Tolikara dalam memajukan perekonomian daerah</p>
            </div>
            <div class="col-lg-4 text-center d-none d-lg-block">
                <div style="width:180px;height:180px;background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto;box-shadow:0 20px 60px rgba(245,166,35,.4)">
                    <i class="fas fa-bullseye" style="font-size:80px;color:#0d2240"></i>
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
            <span style="color:#1a3a6e;font-weight:600">Visi & Misi</span>
        </div>
    </div>
</div>

{{-- Main Content --}}
<div style="padding:60px 0;background:#fff">
    <div class="container">
        <div class="row">
            {{-- Main Content --}}
            <div class="col-lg-8">
                {{-- Visi Section --}}
                <div style="background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(0,0,0,.08);padding:40px;margin-bottom:30px;border:1px solid #f0f2f7">
                    <div style="display:flex;align-items:center;gap:16px;margin-bottom:30px">
                        <div style="width:60px;height:60px;background:linear-gradient(135deg,#1a3a6e,#2d5aa0);border-radius:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 20px rgba(26,58,110,.25)">
                            <i class="fas fa-eye" style="font-size:28px;color:#f5a623"></i>
                        </div>
                        <div>
                            <h2 style="color:#1a3a6e;font-size:32px;font-weight:800;margin:0;line-height:1">VISI</h2>
                            <p style="color:#6c757d;font-size:14px;margin:4px 0 0;font-weight:600">Pandangan Masa Depan</p>
                        </div>
                    </div>
                    
                    <div style="background:linear-gradient(135deg,#f0f4ff,#e8f0fe);border-left:4px solid #1a3a6e;padding:30px;border-radius:12px;margin-bottom:20px">
                        <p style="font-size:18px;line-height:1.9;color:#1a3a6e;font-weight:600;margin:0;font-style:italic">
                            "Terwujudnya Perindustrian, Perdagangan, dan Koperasi yang Maju, Mandiri, dan Berdaya Saing untuk Kesejahteraan Masyarakat Tolikara"
                        </p>
                    </div>

                    <div style="background:#fff;border:2px dashed #e9ecef;border-radius:12px;padding:25px">
                        <h5 style="color:#1a3a6e;font-weight:700;font-size:16px;margin-bottom:16px">
                            <i class="fas fa-lightbulb" style="color:#f5a623;margin-right:8px"></i>Makna Visi:
                        </h5>
                        <ul style="margin:0;padding-left:20px;color:#495057;line-height:1.9;font-size:15px">
                            <li style="margin-bottom:10px"><strong style="color:#1a3a6e">Maju:</strong> Berkembang pesat dalam sektor industri, perdagangan, dan koperasi</li>
                            <li style="margin-bottom:10px"><strong style="color:#1a3a6e">Mandiri:</strong> Mampu berdiri sendiri dengan kekuatan ekonomi lokal yang kuat</li>
                            <li style="margin-bottom:0"><strong style="color:#1a3a6e">Berdaya Saing:</strong> Kompetitif di tingkat regional dan nasional</li>
                        </ul>
                    </div>
                </div>

                {{-- Misi Section --}}
                <div style="background:#fff;border-radius:20px;box-shadow:0 8px 30px rgba(0,0,0,.08);padding:40px;border:1px solid #f0f2f7">
                    <div style="display:flex;align-items:center;gap:16px;margin-bottom:30px">
                        <div style="width:60px;height:60px;background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:16px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 20px rgba(245,166,35,.3)">
                            <i class="fas fa-rocket" style="font-size:28px;color:#0d2240"></i>
                        </div>
                        <div>
                            <h2 style="color:#1a3a6e;font-size:32px;font-weight:800;margin:0;line-height:1">MISI</h2>
                            <p style="color:#6c757d;font-size:14px;margin:4px 0 0;font-weight:600">Langkah Strategis</p>
                        </div>
                    </div>

                    <div style="display:flex;flex-direction:column;gap:20px">
                        {{-- Misi 1 --}}
                        <div style="display:flex;gap:20px;background:linear-gradient(135deg,#f0f4ff,#fff);border-radius:16px;padding:24px;border:2px solid #e8f0fe;transition:all .3s" onmouseover="this.style.borderColor='#1a3a6e';this.style.transform='translateX(8px)'" onmouseout="this.style.borderColor='#e8f0fe';this.style.transform='translateX(0)'">
                            <div style="flex-shrink:0">
                                <div style="width:48px;height:48px;background:linear-gradient(135deg,#1a3a6e,#2d5aa0);border-radius:12px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(26,58,110,.2)">
                                    <span style="color:#f5a623;font-size:20px;font-weight:800">1</span>
                                </div>
                            </div>
                            <div style="flex:1">
                                <h5 style="color:#1a3a6e;font-weight:700;font-size:17px;margin-bottom:10px">Mengembangkan Industri Lokal</h5>
                                <p style="color:#6c757d;font-size:15px;line-height:1.8;margin:0">Meningkatkan kapasitas dan produktivitas industri kecil dan menengah melalui pembinaan, pelatihan, dan pendampingan teknis yang berkelanjutan</p>
                            </div>
                        </div>

                        {{-- Misi 2 --}}
                        <div style="display:flex;gap:20px;background:linear-gradient(135deg,#fff8f0,#fff);border-radius:16px;padding:24px;border:2px solid #fef3e8;transition:all .3s" onmouseover="this.style.borderColor='#f5a623';this.style.transform='translateX(8px)'" onmouseout="this.style.borderColor='#fef3e8';this.style.transform='translateX(0)'">
                            <div style="flex-shrink:0">
                                <div style="width:48px;height:48px;background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:12px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(245,166,35,.2)">
                                    <span style="color:#0d2240;font-size:20px;font-weight:800">2</span>
                                </div>
                            </div>
                            <div style="flex:1">
                                <h5 style="color:#1a3a6e;font-weight:700;font-size:17px;margin-bottom:10px">Meningkatkan Perdagangan</h5>
                                <p style="color:#6c757d;font-size:15px;line-height:1.8;margin:0">Memfasilitasi akses pasar yang lebih luas bagi pelaku usaha lokal dan menciptakan iklim perdagangan yang kondusif dan kompetitif</p>
                            </div>
                        </div>

                        {{-- Misi 3 --}}
                        <div style="display:flex;gap:20px;background:linear-gradient(135deg,#f0f4ff,#fff);border-radius:16px;padding:24px;border:2px solid #e8f0fe;transition:all .3s" onmouseover="this.style.borderColor='#1a3a6e';this.style.transform='translateX(8px)'" onmouseout="this.style.borderColor='#e8f0fe';this.style.transform='translateX(0)'">
                            <div style="flex-shrink:0">
                                <div style="width:48px;height:48px;background:linear-gradient(135deg,#1a3a6e,#2d5aa0);border-radius:12px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(26,58,110,.2)">
                                    <span style="color:#f5a623;font-size:20px;font-weight:800">3</span>
                                </div>
                            </div>
                            <div style="flex:1">
                                <h5 style="color:#1a3a6e;font-weight:700;font-size:17px;margin-bottom:10px">Memberdayakan Koperasi</h5>
                                <p style="color:#6c757d;font-size:15px;line-height:1.8;margin:0">Memperkuat kelembagaan koperasi sebagai pilar ekonomi kerakyatan melalui pembinaan manajemen dan permodalan yang memadai</p>
                            </div>
                        </div>

                        {{-- Misi 4 --}}
                        <div style="display:flex;gap:20px;background:linear-gradient(135deg,#fff8f0,#fff);border-radius:16px;padding:24px;border:2px solid #fef3e8;transition:all .3s" onmouseover="this.style.borderColor='#f5a623';this.style.transform='translateX(8px)'" onmouseout="this.style.borderColor='#fef3e8';this.style.transform='translateX(0)'">
                            <div style="flex-shrink:0">
                                <div style="width:48px;height:48px;background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:12px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(245,166,35,.2)">
                                    <span style="color:#0d2240;font-size:20px;font-weight:800">4</span>
                                </div>
                            </div>
                            <div style="flex:1">
                                <h5 style="color:#1a3a6e;font-weight:700;font-size:17px;margin-bottom:10px">Meningkatkan SDM</h5>
                                <p style="color:#6c757d;font-size:15px;line-height:1.8;margin:0">Mengembangkan kompetensi dan keterampilan pelaku usaha melalui program pelatihan dan sertifikasi yang terstandar</p>
                            </div>
                        </div>

                        {{-- Misi 5 --}}
                        <div style="display:flex;gap:20px;background:linear-gradient(135deg,#f0f4ff,#fff);border-radius:16px;padding:24px;border:2px solid #e8f0fe;transition:all .3s" onmouseover="this.style.borderColor='#1a3a6e';this.style.transform='translateX(8px)'" onmouseout="this.style.borderColor='#e8f0fe';this.style.transform='translateX(0)'">
                            <div style="flex-shrink:0">
                                <div style="width:48px;height:48px;background:linear-gradient(135deg,#1a3a6e,#2d5aa0);border-radius:12px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(26,58,110,.2)">
                                    <span style="color:#f5a623;font-size:20px;font-weight:800">5</span>
                                </div>
                            </div>
                            <div style="flex:1">
                                <h5 style="color:#1a3a6e;font-weight:700;font-size:17px;margin-bottom:10px">Memperkuat Regulasi</h5>
                                <p style="color:#6c757d;font-size:15px;line-height:1.8;margin:0">Menciptakan kebijakan dan regulasi yang mendukung pertumbuhan sektor industri, perdagangan, dan koperasi secara berkelanjutan</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Nilai-Nilai --}}
                <div style="background:linear-gradient(135deg,#1a3a6e,#0d2240);border-radius:20px;padding:40px;margin-top:30px;position:relative;overflow:hidden">
                    <div style="position:absolute;top:-50px;right:-50px;width:200px;height:200px;background:rgba(245,166,35,.1);border-radius:50%"></div>
                    <div style="position:absolute;bottom:-30px;left:-30px;width:150px;height:150px;background:rgba(245,166,35,.08);border-radius:50%"></div>
                    
                    <div style="position:relative;z-index:1">
                        <h3 style="color:#fff;font-size:24px;font-weight:800;margin-bottom:24px;text-align:center">
                            <i class="fas fa-star" style="color:#f5a623;margin-right:10px"></i>Nilai-Nilai Organisasi
                        </h3>
                        <div class="row" style="gap:16px 0">
                            <div class="col-md-6">
                                <div style="background:rgba(255,255,255,.1);border-radius:12px;padding:20px;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.2)">
                                    <div style="display:flex;align-items:center;gap:12px">
                                        <i class="fas fa-check-circle" style="color:#f5a623;font-size:24px"></i>
                                        <div>
                                            <h6 style="color:#fff;font-weight:700;margin:0;font-size:15px">Integritas</h6>
                                            <p style="color:rgba(255,255,255,.7);font-size:13px;margin:4px 0 0">Jujur dan bertanggung jawab</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background:rgba(255,255,255,.1);border-radius:12px;padding:20px;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.2)">
                                    <div style="display:flex;align-items:center;gap:12px">
                                        <i class="fas fa-users" style="color:#f5a623;font-size:24px"></i>
                                        <div>
                                            <h6 style="color:#fff;font-weight:700;margin:0;font-size:15px">Kolaboratif</h6>
                                            <p style="color:rgba(255,255,255,.7);font-size:13px;margin:4px 0 0">Bekerja sama dengan baik</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background:rgba(255,255,255,.1);border-radius:12px;padding:20px;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.2)">
                                    <div style="display:flex;align-items:center;gap:12px">
                                        <i class="fas fa-lightbulb" style="color:#f5a623;font-size:24px"></i>
                                        <div>
                                            <h6 style="color:#fff;font-weight:700;margin:0;font-size:15px">Inovatif</h6>
                                            <p style="color:rgba(255,255,255,.7);font-size:13px;margin:4px 0 0">Kreatif dan adaptif</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="background:rgba(255,255,255,.1);border-radius:12px;padding:20px;backdrop-filter:blur(10px);border:1px solid rgba(255,255,255,.2)">
                                    <div style="display:flex;align-items:center;gap:12px">
                                        <i class="fas fa-heart" style="color:#f5a623;font-size:24px"></i>
                                        <div>
                                            <h6 style="color:#fff;font-weight:700;margin:0;font-size:15px">Melayani</h6>
                                            <p style="color:rgba(255,255,255,.7);font-size:13px;margin:4px 0 0">Mengutamakan kepentingan publik</p>
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
                           style="display:flex;align-items:center;gap:12px;padding:14px 16px;border-radius:10px;text-decoration:none;transition:all .2s;margin-bottom:4px;{{ $m[0] === 'visi-misi' ? 'background:linear-gradient(135deg,#1a3a6e,#2d5aa0);color:#fff' : 'color:#495057' }}"
                           onmouseover="if('{{ $m[0] }}' !== 'visi-misi') this.style.background='#f8f9fa'"
                           onmouseout="if('{{ $m[0] }}' !== 'visi-misi') this.style.background='transparent'">
                            <i class="{{ $m[1] }}" style="width:20px;color:{{ $m[0] === 'visi-misi' ? '#f5a623' : '#6c757d' }};font-size:16px"></i>
                            <span style="font-weight:600;font-size:14px">{{ $m[2] }}</span>
                            @if($m[0] === 'visi-misi')
                            <i class="fas fa-chevron-right ml-auto" style="color:#f5a623;font-size:12px"></i>
                            @endif
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- Info Box --}}
                <div style="background:linear-gradient(135deg,#f5a623,#fdb944);border-radius:16px;padding:30px;box-shadow:0 8px 30px rgba(245,166,35,.3);margin-bottom:24px">
                    <div style="text-align:center;margin-bottom:20px">
                        <i class="fas fa-info-circle" style="font-size:48px;color:#0d2240"></i>
                    </div>
                    <h5 style="color:#0d2240;font-weight:800;text-align:center;margin-bottom:16px;font-size:18px">Butuh Informasi?</h5>
                    <p style="color:#0d2240;font-size:14px;text-align:center;margin-bottom:20px;opacity:.9">Hubungi kami untuk informasi lebih lanjut tentang program dan layanan kami</p>
                    <a href="{{ route('public.kontak') }}" style="display:block;background:#0d2240;color:#fff;text-align:center;padding:12px;border-radius:10px;text-decoration:none;font-weight:700;font-size:14px;transition:all .2s" onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 8px 20px rgba(13,34,64,.3)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
                        <i class="fas fa-envelope mr-2"></i>Hubungi Kami
                    </a>
                </div>

                {{-- Quick Stats --}}
                <div style="background:#fff;border-radius:16px;box-shadow:0 8px 30px rgba(0,0,0,.08);padding:24px;border:1px solid #f0f2f7">
                    <h6 style="color:#1a3a6e;font-weight:700;margin-bottom:20px;font-size:15px">
                        <i class="fas fa-chart-line" style="color:#f5a623;margin-right:8px"></i>Statistik Singkat
                    </h6>
                    <div style="display:flex;flex-direction:column;gap:16px">
                        <div style="display:flex;align-items:center;gap:12px">
                            <div style="width:40px;height:40px;background:linear-gradient(135deg,#e8f0fe,#f0f4ff);border-radius:10px;display:flex;align-items:center;justify-content:center">
                                <i class="fas fa-industry" style="color:#1a3a6e;font-size:18px"></i>
                            </div>
                            <div style="flex:1">
                                <div style="color:#1a3a6e;font-weight:700;font-size:20px">{{ \App\Models\Koperasi::count() }}</div>
                                <div style="color:#6c757d;font-size:12px">Koperasi Terdaftar</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px">
                            <div style="width:40px;height:40px;background:linear-gradient(135deg,#fef3e8,#fff8f0);border-radius:10px;display:flex;align-items:center;justify-content:center">
                                <i class="fas fa-users" style="color:#f5a623;font-size:18px"></i>
                            </div>
                            <div style="flex:1">
                                <div style="color:#1a3a6e;font-weight:700;font-size:20px">{{ \App\Models\Anggota::count() }}</div>
                                <div style="color:#6c757d;font-size:12px">Anggota Koperasi</div>
                            </div>
                        </div>
                        <div style="display:flex;align-items:center;gap:12px">
                            <div style="width:40px;height:40px;background:linear-gradient(135deg,#e8f0fe,#f0f4ff);border-radius:10px;display:flex;align-items:center;justify-content:center">
                                <i class="fas fa-hand-holding-usd" style="color:#1a3a6e;font-size:18px"></i>
                            </div>
                            <div style="flex:1">
                                <div style="color:#1a3a6e;font-weight:700;font-size:20px">{{ \App\Models\Bantuan::count() }}</div>
                                <div style="color:#6c757d;font-size:12px">Program Bantuan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
