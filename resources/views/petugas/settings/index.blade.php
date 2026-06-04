@extends('layouts.app')
@section('title', 'Pengaturan')

@push('styles')
<style>
    .theme-card {
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 3px solid transparent;
        position: relative;
    }
    
    .theme-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }
    
    .theme-card.active {
        border-color: #28a745;
        box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
    }
    
    .theme-card.active::after {
        content: '\f00c';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        top: 10px;
        right: 10px;
        background: #28a745;
        color: white;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 14px;
        z-index: 10;
    }
    
    .theme-preview {
        height: 150px;
        display: flex;
        gap: 10px;
        padding: 15px;
    }
    
    .theme-preview-card {
        flex: 1;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 24px;
    }
    
    .theme-info {
        padding: 15px;
        background: white;
        text-align: center;
    }
    
    .theme-name {
        font-weight: 700;
        font-size: 16px;
        color: #334155;
        margin-bottom: 5px;
    }
    
    .theme-desc {
        font-size: 12px;
        color: #94a3b8;
    }
    
    /* Navbar Theme Preview */
    .navbar-preview {
        height: 60px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        padding: 0 20px;
        color: white;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .navbar-preview i {
        margin-right: 10px;
        font-size: 18px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius:16px;border:none;background:linear-gradient(135deg,#667eea,#764ba2)">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center text-white">
                        <div style="width:60px;height:60px;background:rgba(255,255,255,0.2);border-radius:12px;display:flex;align-items:center;justify-content:center;margin-right:20px">
                            <i class="fas fa-cog fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-1 font-weight-bold">Pengaturan</h3>
                            <p class="mb-0" style="opacity:0.9">Sesuaikan tampilan dashboard dan navbar sesuai preferensi Anda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('petugas.settings.update-theme') }}" method="POST" id="themeForm">
        @csrf
        <input type="hidden" name="theme" id="selectedTheme" value="{{ $currentTheme }}">
        <input type="hidden" name="navbar_theme" id="selectedNavbarTheme" value="{{ $currentNavbarTheme }}">
        
        {{-- Dashboard Theme Selection --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm" style="border-radius:16px;border:none;margin-bottom:24px">
                    <div class="card-header" style="background:white;border-bottom:2px solid #f1f5f9;padding:20px 24px">
                        <h5 class="mb-0 font-weight-bold" style="color:#334155">
                            <i class="fas fa-palette mr-2 text-primary"></i>Tema Warna Dashboard
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            {{-- Default Theme --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card dashboard-theme {{ $currentTheme == 'default' ? 'active' : '' }}" onclick="selectTheme('default')">
                                    <div class="theme-preview" style="background:#f8fafc">
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#17a2b8,#138496)">52</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#28a745,#218838)">39</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#ffc107,#e0a800)">12</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#dc3545,#c82333)">0</div>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Default</div>
                                        <div class="theme-desc">Cyan, Hijau, Kuning, Merah</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Blue Theme --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card dashboard-theme {{ $currentTheme == 'blue' ? 'active' : '' }}" onclick="selectTheme('blue')">
                                    <div class="theme-preview" style="background:#f8fafc">
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#3b82f6,#2563eb)">52</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#06b6d4,#0891b2)">39</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#0ea5e9,#0284c7)">12</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#1e40af,#1e3a8a)">0</div>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Biru</div>
                                        <div class="theme-desc">Tema biru profesional</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Green Theme --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card dashboard-theme {{ $currentTheme == 'green' ? 'active' : '' }}" onclick="selectTheme('green')">
                                    <div class="theme-preview" style="background:#f8fafc">
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#10b981,#059669)">52</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#14b8a6,#0d9488)">39</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#22c55e,#16a34a)">12</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#15803d,#166534)">0</div>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Hijau</div>
                                        <div class="theme-desc">Tema hijau segar</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Purple Theme --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card dashboard-theme {{ $currentTheme == 'purple' ? 'active' : '' }}" onclick="selectTheme('purple')">
                                    <div class="theme-preview" style="background:#f8fafc">
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed)">52</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#a855f7,#9333ea)">39</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#c084fc,#a78bfa)">12</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#6b21a8,#581c87)">0</div>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Ungu</div>
                                        <div class="theme-desc">Tema ungu elegan</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Orange Theme --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card dashboard-theme {{ $currentTheme == 'orange' ? 'active' : '' }}" onclick="selectTheme('orange')">
                                    <div class="theme-preview" style="background:#f8fafc">
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#f97316,#ea580c)">52</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#fb923c,#f97316)">39</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#fdba74,#fb923c)">12</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#c2410c,#9a3412)">0</div>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Oranye</div>
                                        <div class="theme-desc">Tema oranye energik</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Red Theme --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card dashboard-theme {{ $currentTheme == 'red' ? 'active' : '' }}" onclick="selectTheme('red')">
                                    <div class="theme-preview" style="background:#f8fafc">
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#ef4444,#dc2626)">52</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#f87171,#ef4444)">39</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#fca5a5,#f87171)">12</div>
                                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#b91c1c,#991b1b)">0</div>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Merah</div>
                                        <div class="theme-desc">Tema merah berani</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navbar/Sidebar Theme Selection --}}
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm" style="border-radius:16px;border:none;margin-bottom:24px">
                    <div class="card-header" style="background:white;border-bottom:2px solid #f1f5f9;padding:20px 24px">
                        <h5 class="mb-0 font-weight-bold" style="color:#334155">
                            <i class="fas fa-bars mr-2 text-info"></i>Tema Warna Navbar & Sidebar
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            {{-- Dark Blue (Default) --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'dark-blue' ? 'active' : '' }}" onclick="selectNavbarTheme('dark-blue')">
                                    <div class="navbar-preview" style="background:linear-gradient(135deg,#1a3a6e,#0f2847)">
                                        <i class="fas fa-bars"></i>
                                        <span>Biru Gelap (Default)</span>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Biru Gelap</div>
                                        <div class="theme-desc">Profesional & Elegan</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Navy --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'navy' ? 'active' : '' }}" onclick="selectNavbarTheme('navy')">
                                    <div class="navbar-preview" style="background:linear-gradient(135deg,#1e3a8a,#1e40af)">
                                        <i class="fas fa-bars"></i>
                                        <span>Navy</span>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Navy</div>
                                        <div class="theme-desc">Klasik & Formal</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Teal --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'teal' ? 'active' : '' }}" onclick="selectNavbarTheme('teal')">
                                    <div class="navbar-preview" style="background:linear-gradient(135deg,#0d9488,#0f766e)">
                                        <i class="fas fa-bars"></i>
                                        <span>Teal</span>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Teal</div>
                                        <div class="theme-desc">Modern & Fresh</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Purple --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'purple' ? 'active' : '' }}" onclick="selectNavbarTheme('purple')">
                                    <div class="navbar-preview" style="background:linear-gradient(135deg,#7c3aed,#6b21a8)">
                                        <i class="fas fa-bars"></i>
                                        <span>Ungu</span>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Ungu</div>
                                        <div class="theme-desc">Kreatif & Unik</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Dark Gray --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'dark-gray' ? 'active' : '' }}" onclick="selectNavbarTheme('dark-gray')">
                                    <div class="navbar-preview" style="background:linear-gradient(135deg,#374151,#1f2937)">
                                        <i class="fas fa-bars"></i>
                                        <span>Abu Gelap</span>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Abu Gelap</div>
                                        <div class="theme-desc">Minimalis & Netral</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Green --}}
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'green' ? 'active' : '' }}" onclick="selectNavbarTheme('green')">
                                    <div class="navbar-preview" style="background:linear-gradient(135deg,#059669,#047857)">
                                        <i class="fas fa-bars"></i>
                                        <span>Hijau</span>
                                    </div>
                                    <div class="theme-info">
                                        <div class="theme-name">Hijau</div>
                                        <div class="theme-desc">Natural & Tenang</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <button type="submit" class="btn btn-primary btn-lg" style="border-radius:10px;padding:12px 40px">
                <i class="fas fa-save mr-2"></i>Simpan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function selectTheme(theme) {
    // Remove active class from all dashboard theme cards
    document.querySelectorAll('.dashboard-theme').forEach(card => {
        card.classList.remove('active');
    });
    
    // Add active class to selected card
    event.currentTarget.classList.add('active');
    
    // Set hidden input value
    document.getElementById('selectedTheme').value = theme;
}

function selectNavbarTheme(theme) {
    // Remove active class from all navbar theme cards
    document.querySelectorAll('.navbar-theme').forEach(card => {
        card.classList.remove('active');
    });
    
    // Add active class to selected card
    event.currentTarget.classList.add('active');
    
    // Set hidden input value
    document.getElementById('selectedNavbarTheme').value = theme;
}

@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: '{{ session('success') }}',
    timer: 2000,
    showConfirmButton: false
}).then(() => {
    // Reload page to apply new theme
    window.location.reload();
});
@endif
</script>
@endpush
