@extends('layouts.app')
@section('title', 'Pengaturan Tema')

@push('styles')
<style>
    .settings-container {
        padding: 25px;
        background: #f5f7fa;
        min-height: 100vh;
    }

    .instruction-box {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 30px;
        border-radius: 15px;
        margin-bottom: 30px;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
    }

    .instruction-box h4 {
        font-weight: 700;
        margin-bottom: 20px;
        font-size: 1.4rem;
    }

    .instruction-box ul {
        margin: 0;
        padding-left: 25px;
    }

    .instruction-box li {
        margin-bottom: 12px;
        line-height: 1.8;
        font-size: 1.05rem;
    }

    .section-header {
        background: white;
        padding: 25px;
        border-radius: 12px;
        margin-bottom: 25px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .section-header h3 {
        font-weight: 700;
        color: #334155;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
        font-size: 1.3rem;
    }

    .section-header p {
        margin: 10px 0 0 0;
        color: #64748b;
        font-size: 1rem;
    }

    .badge-new {
        background: #ef4444;
        color: white;
        padding: 4px 10px;
        border-radius: 5px;
        font-size: 11px;
        font-weight: 700;
        margin-left: 10px;
    }

    .theme-card {
        border-radius: 12px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 3px solid transparent;
        position: relative;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
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
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        z-index: 10;
        box-shadow: 0 3px 10px rgba(40, 167, 69, 0.4);
    }
    
    .theme-preview {
        padding: 20px 15px;
        background: #f8fafc;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }
    
    .theme-preview-card {
        border-radius: 8px;
        padding: 15px 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        min-height: 80px;
    }
    
    .theme-preview-card i {
        font-size: 24px;
        opacity: 0.3;
        margin-top: 5px;
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
    
    .navbar-preview {
        height: 60px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        padding: 0 20px;
        color: white;
        font-weight: 600;
        margin-bottom: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .navbar-preview i {
        margin-right: 10px;
        font-size: 18px;
    }

    .save-button {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        padding: 15px 50px;
        border-radius: 12px;
        border: none;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
        transition: all 0.3s ease;
    }

    .save-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
    }
</style>
@endpush

@section('content')
<div class="settings-container">
    {{-- Instruction Box --}}
    <div class="instruction-box">
        <h4><i class="fas fa-info-circle mr-2"></i>Cara Menggunakan Pengaturan Tema</h4>
        <ul>
            <li><strong>Langkah 1:</strong> Pilih <strong>Tema Warna Dashboard</strong> dengan klik salah satu kotak warna di bawah (4 card akan berubah warna)</li>
            <li><strong>Langkah 2:</strong> Pilih <strong>Tema Warna Navbar & Sidebar</strong> dengan klik salah satu kotak warna</li>
            <li><strong>Langkah 3:</strong> Klik tombol <strong>"Simpan Pengaturan"</strong> di bawah</li>
            <li><strong>Langkah 4:</strong> Halaman akan otomatis reload dan tema baru langsung diterapkan!</li>
        </ul>
    </div>

    <form action="{{ route('pimpinan.settings.update-theme') }}" method="POST">
        @csrf
        <input type="hidden" name="theme" id="selectedTheme" value="{{ $currentTheme }}">
        <input type="hidden" name="navbar_theme" id="selectedNavbarTheme" value="{{ $currentNavbarTheme }}">
        
        {{-- Dashboard Theme --}}
        <div class="section-header">
            <h3>
                <i class="fas fa-palette text-primary"></i>
                Tema Warna Dashboard (4 Card)
                <span class="badge-new">PILIH WARNA</span>
            </h3>
            <p>Klik salah satu tema di bawah untuk mengubah warna 4 kotak statistik di dashboard Anda</p>
        </div>

        <div class="row mb-5">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card dashboard-theme {{ $currentTheme == 'default' ? 'active' : '' }}" onclick="selectTheme('default')">
                    <div class="theme-preview">
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#14b8a6,#0d9488)">
                            <span>52</span>
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#22c55e,#16a34a)">
                            <span>39</span>
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#eab308,#ca8a04)">
                            <span>13</span>
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#ef4444,#dc2626)">
                            <span>1</span>
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">✨ Default (Bawaan)</div>
                        <div class="theme-desc">Teal, Hijau, Kuning, Merah</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card dashboard-theme {{ $currentTheme == 'blue' ? 'active' : '' }}" onclick="selectTheme('blue')">
                    <div class="theme-preview">
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#3b82f6,#2563eb)">
                            <span>52</span>
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#06b6d4,#0891b2)">
                            <span>39</span>
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#0ea5e9,#0284c7)">
                            <span>13</span>
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#1e40af,#1e3a8a)">
                            <span>1</span>
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">🔵 Biru Profesional</div>
                        <div class="theme-desc">4 Variasi Biru</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card dashboard-theme {{ $currentTheme == 'green' ? 'active' : '' }}" onclick="selectTheme('green')">
                    <div class="theme-preview">
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#10b981,#059669)">
                            <span>52</span>
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#14b8a6,#0d9488)">
                            <span>39</span>
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#22c55e,#16a34a)">
                            <span>13</span>
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#16a34a,#15803d)">
                            <span>1</span>
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">🟢 Hijau Segar</div>
                        <div class="theme-desc">4 Variasi Hijau</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card dashboard-theme {{ $currentTheme == 'purple' ? 'active' : '' }}" onclick="selectTheme('purple')">
                    <div class="theme-preview">
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#8b5cf6,#7c3aed)">
                            <span>52</span>
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#a855f7,#9333ea)">
                            <span>39</span>
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#c084fc,#a78bfa)">
                            <span>13</span>
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#7c3aed,#6d28d9)">
                            <span>1</span>
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">🟣 Ungu Elegan</div>
                        <div class="theme-desc">4 Variasi Ungu</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card dashboard-theme {{ $currentTheme == 'orange' ? 'active' : '' }}" onclick="selectTheme('orange')">
                    <div class="theme-preview">
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#f97316,#ea580c)">
                            <span>52</span>
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#fb923c,#f97316)">
                            <span>39</span>
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#fdba74,#fb923c)">
                            <span>13</span>
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#ea580c,#c2410c)">
                            <span>1</span>
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">🟠 Oranye Energik</div>
                        <div class="theme-desc">4 Variasi Oranye</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card dashboard-theme {{ $currentTheme == 'red' ? 'active' : '' }}" onclick="selectTheme('red')">
                    <div class="theme-preview">
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#ef4444,#dc2626)">
                            <span>52</span>
                            <i class="fas fa-store"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#f87171,#ef4444)">
                            <span>39</span>
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#fca5a5,#f87171)">
                            <span>13</span>
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="theme-preview-card" style="background:linear-gradient(135deg,#dc2626,#b91c1c)">
                            <span>1</span>
                            <i class="fas fa-hand-holding-heart"></i>
                        </div>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">🔴 Merah Berani</div>
                        <div class="theme-desc">4 Variasi Merah</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Navbar Theme --}}
        <div class="section-header">
            <h3>
                <i class="fas fa-bars text-info"></i>
                Tema Warna Navbar & Sidebar
                <span class="badge-new">PILIH WARNA</span>
            </h3>
            <p>Klik salah satu tema di bawah untuk mengubah warna navbar (atas) dan sidebar (samping kiri)</p>
        </div>

        <div class="row mb-5">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'dark-blue' ? 'active' : '' }}" onclick="selectNavbarTheme('dark-blue')">
                    <div class="navbar-preview" style="background:linear-gradient(135deg,#1a3a6e,#0f2847)">
                        <i class="fas fa-bars"></i>
                        <span>Biru Gelap (Bawaan)</span>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">✨ Biru Gelap (Default)</div>
                        <div class="theme-desc">Profesional & Elegan</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'navy' ? 'active' : '' }}" onclick="selectNavbarTheme('navy')">
                    <div class="navbar-preview" style="background:linear-gradient(135deg,#1e3a8a,#1e40af)">
                        <i class="fas fa-bars"></i>
                        <span>Navy</span>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">🔵 Navy</div>
                        <div class="theme-desc">Klasik & Formal</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'teal' ? 'active' : '' }}" onclick="selectNavbarTheme('teal')">
                    <div class="navbar-preview" style="background:linear-gradient(135deg,#0d9488,#0f766e)">
                        <i class="fas fa-bars"></i>
                        <span>Teal</span>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">🔵 Teal</div>
                        <div class="theme-desc">Modern & Fresh</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'purple' ? 'active' : '' }}" onclick="selectNavbarTheme('purple')">
                    <div class="navbar-preview" style="background:linear-gradient(135deg,#7c3aed,#6b21a8)">
                        <i class="fas fa-bars"></i>
                        <span>Ungu</span>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">🟣 Ungu</div>
                        <div class="theme-desc">Kreatif & Unik</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'dark-gray' ? 'active' : '' }}" onclick="selectNavbarTheme('dark-gray')">
                    <div class="navbar-preview" style="background:linear-gradient(135deg,#374151,#1f2937)">
                        <i class="fas fa-bars"></i>
                        <span>Abu Gelap</span>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">⚫ Abu Gelap</div>
                        <div class="theme-desc">Minimalis & Netral</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="theme-card navbar-theme {{ $currentNavbarTheme == 'green' ? 'active' : '' }}" onclick="selectNavbarTheme('green')">
                    <div class="navbar-preview" style="background:linear-gradient(135deg,#059669,#047857)">
                        <i class="fas fa-bars"></i>
                        <span>Hijau</span>
                    </div>
                    <div class="theme-info">
                        <div class="theme-name">🟢 Hijau</div>
                        <div class="theme-desc">Natural & Tenang</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <button type="submit" class="save-button">
                <i class="fas fa-save mr-2"></i>Simpan Pengaturan
            </button>
            <p class="mt-3 text-muted">
                <i class="fas fa-info-circle mr-1"></i>
                Setelah klik "Simpan Pengaturan", halaman akan otomatis reload dengan tema baru
            </p>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function selectTheme(theme) {
    document.querySelectorAll('.dashboard-theme').forEach(card => card.classList.remove('active'));
    event.currentTarget.classList.add('active');
    document.getElementById('selectedTheme').value = theme;
}

function selectNavbarTheme(theme) {
    document.querySelectorAll('.navbar-theme').forEach(card => card.classList.remove('active'));
    event.currentTarget.classList.add('active');
    document.getElementById('selectedNavbarTheme').value = theme;
}

@if(session('success'))
Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    html: '<p>{{ session('success') }}</p><p class="mt-2"><strong>Halaman akan reload otomatis...</strong></p>',
    timer: 2000,
    showConfirmButton: false,
    timerProgressBar: true
}).then(() => window.location.reload());
@endif
</script>
@endpush
