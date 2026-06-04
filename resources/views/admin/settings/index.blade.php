@extends('layouts.app')
@section('title', 'Pengaturan Sistem')

@push('styles')
<style>
    .settings-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .settings-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 40px;
        margin-bottom: 30px;
        color: white;
        box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
    }

    .settings-header h2 {
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .settings-header p {
        font-size: 16px;
        opacity: 0.95;
        margin: 0;
    }

    .settings-tabs {
        background: white;
        border-radius: 16px;
        padding: 10px;
        margin-bottom: 30px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .settings-tab {
        flex: 1;
        min-width: 150px;
        padding: 15px 20px;
        border-radius: 12px;
        border: none;
        background: transparent;
        color: #6b7280;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .settings-tab:hover {
        background: #f3f4f6;
        color: #667eea;
    }

    .settings-tab.active {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .settings-tab i {
        font-size: 18px;
    }

    .settings-content {
        background: white;
        border-radius: 20px;
        padding: 40px;
        box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    }

    .settings-section {
        display: none;
    }

    .settings-section.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .setting-group-title {
        font-size: 20px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 3px solid #667eea;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .setting-group-title i {
        font-size: 24px;
        color: #667eea;
    }

    .setting-item {
        margin-bottom: 30px;
        padding: 25px;
        background: #f9fafb;
        border-radius: 12px;
        border-left: 4px solid #667eea;
        transition: all 0.3s ease;
    }

    .setting-item:hover {
        background: #f3f4f6;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .setting-label {
        font-weight: 700;
        color: #374151;
        font-size: 15px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .setting-label i {
        color: #667eea;
        font-size: 16px;
    }

    .setting-description {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 12px;
    }

    .setting-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    .setting-input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .setting-input-color {
        width: 100px;
        height: 50px;
        padding: 5px;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        cursor: pointer;
    }

    .setting-input-file {
        display: none;
    }

    .setting-file-upload {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .setting-file-preview {
        width: 100px;
        height: 100px;
        border-radius: 12px;
        object-fit: contain;
        border: 3px solid #e5e7eb;
        background: white;
        padding: 10px;
    }

    .setting-file-button {
        padding: 12px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .setting-file-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .setting-file-info {
        font-size: 13px;
        color: #6b7280;
    }

    .settings-actions {
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 2px solid #f3f4f6;
    }

    .btn-save {
        padding: 14px 32px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(16, 185, 129, 0.4);
    }

    .btn-reset {
        padding: 14px 32px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-reset:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(239, 68, 68, 0.4);
    }

    .color-preview {
        display: inline-block;
        width: 30px;
        height: 30px;
        border-radius: 8px;
        border: 2px solid #e5e7eb;
        vertical-align: middle;
        margin-left: 10px;
    }

    @media (max-width: 768px) {
        .settings-header {
            padding: 30px 20px;
        }

        .settings-header h2 {
            font-size: 24px;
        }

        .settings-content {
            padding: 25px 20px;
        }

        .settings-tabs {
            flex-direction: column;
        }

        .settings-tab {
            width: 100%;
        }

        .settings-actions {
            flex-direction: column;
        }

        .btn-save,
        .btn-reset {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid settings-container">
    {{-- Header --}}
    <div class="settings-header">
        <h2><i class="fas fa-cog mr-3"></i>Pengaturan Sistem</h2>
        <p>Kelola pengaturan aplikasi, tema, logo, dan informasi kontak. Semua perubahan akan otomatis diterapkan ke seluruh sistem.</p>
        <div style="margin-top: 20px; padding: 15px; background: rgba(255,255,255,0.15); border-radius: 12px; font-size: 13px;">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                <i class="fas fa-check-circle" style="color: #10b981;"></i>
                <span><strong>Auto Apply:</strong> Perubahan langsung diterapkan ke Admin Panel, Halaman Login, dan Website Public</span>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-shield-alt" style="color: #10b981;"></i>
                <span><strong>Aman:</strong> Bisa direset ke default kapan saja tanpa kehilangan data</span>
            </div>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="settings-tabs">
        <button class="settings-tab active" data-tab="general">
            <i class="fas fa-info-circle"></i>
            <span>Umum</span>
        </button>
        <button class="settings-tab" data-tab="appearance">
            <i class="fas fa-palette"></i>
            <span>Tampilan</span>
        </button>
        <button class="settings-tab" data-tab="contact">
            <i class="fas fa-address-book"></i>
            <span>Kontak</span>
        </button>
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="settings-content">
            {{-- General Settings --}}
            <div class="settings-section active" id="section-general">
                <div class="setting-group-title">
                    <i class="fas fa-info-circle"></i>
                    <span>Informasi Umum</span>
                </div>

                <div class="alert alert-info" style="background: #e0f2fe; border-left: 4px solid #0284c7; padding: 16px; border-radius: 10px; margin-bottom: 25px;">
                    <div style="display: flex; align-items: start; gap: 12px;">
                        <i class="fas fa-info-circle" style="color: #0284c7; font-size: 20px; margin-top: 2px;"></i>
                        <div>
                            <strong style="color: #0c4a6e; font-size: 15px; display: block; margin-bottom: 6px;">Tentang Pengaturan Umum</strong>
                            <p style="color: #075985; font-size: 13px; margin: 0; line-height: 1.6;">
                                Bagian ini mengatur informasi dasar aplikasi yang akan ditampilkan di seluruh sistem. 
                                Perubahan yang Anda buat akan otomatis diterapkan ke halaman admin, login, dan website public.
                            </p>
                        </div>
                    </div>
                </div>

                @foreach($settings->get('general', []) as $setting)
                <div class="setting-item">
                    <label class="setting-label">
                        <i class="fas fa-tag"></i>
                        {{ $setting->label }}
                    </label>
                    @if($setting->description)
                    <div class="setting-description">{{ $setting->description }}</div>
                    @endif

                    @if($setting->type === 'textarea')
                        <textarea name="settings[{{ $setting->key }}]" class="setting-input" rows="3">{{ $setting->value }}</textarea>
                    @else
                        <input type="{{ $setting->type }}" 
                               name="settings[{{ $setting->key }}]" 
                               value="{{ $setting->value }}" 
                               class="setting-input">
                    @endif
                </div>
                @endforeach
            </div>

            {{-- Appearance Settings --}}
            <div class="settings-section" id="section-appearance">
                <div class="alert alert-info" style="background: #e0f2fe; border-left: 4px solid #0284c7; padding: 16px; border-radius: 10px; margin-bottom: 25px;">
                    <div style="display: flex; align-items: start; gap: 12px;">
                        <i class="fas fa-palette" style="color: #0284c7; font-size: 20px; margin-top: 2px;"></i>
                        <div>
                            <strong style="color: #0c4a6e; font-size: 15px; display: block; margin-bottom: 6px;">Tentang Pengaturan Tampilan</strong>
                            <p style="color: #075985; font-size: 13px; margin: 0; line-height: 1.6;">
                                Customize tampilan aplikasi dengan mengubah logo dan warna tema. Logo akan ditampilkan di sidebar, navbar, dan halaman login. 
                                Warna tema akan diterapkan ke seluruh elemen UI seperti button, navbar, dan sidebar.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="setting-group-title">
                    <i class="fas fa-image"></i>
                    <span>Logo & Gambar</span>
                </div>

                <div class="alert alert-warning" style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 14px; border-radius: 10px; margin-bottom: 20px;">
                    <div style="display: flex; align-items: start; gap: 10px;">
                        <i class="fas fa-lightbulb" style="color: #d97706; font-size: 16px; margin-top: 2px;"></i>
                        <div>
                            <strong style="color: #92400e; font-size: 13px; display: block; margin-bottom: 4px;">Tips Upload Logo:</strong>
                            <ul style="color: #b45309; font-size: 12px; margin: 0; padding-left: 18px; line-height: 1.6;">
                                <li>Gunakan format PNG dengan background transparan untuk hasil terbaik</li>
                                <li>Ukuran rekomendasi: 200x200 pixel (rasio 1:1)</li>
                                <li>Ukuran file maksimal: 2 MB</li>
                                <li>Format yang didukung: JPG, PNG, SVG</li>
                            </ul>
                        </div>
                    </div>
                </div>

                @foreach($settings->get('appearance', [])->where('type', 'image') as $setting)
                <div class="setting-item">
                    <label class="setting-label">
                        <i class="fas fa-image"></i>
                        {{ $setting->label }}
                    </label>
                    @if($setting->description)
                    <div class="setting-description">{{ $setting->description }}</div>
                    @endif

                    <div class="setting-file-upload">
                        <img src="{{ asset('storage/' . $setting->value) }}" 
                             alt="{{ $setting->label }}" 
                             class="setting-file-preview"
                             id="preview-{{ $setting->key }}">
                        <div>
                            <input type="file" 
                                   name="settings[{{ $setting->key }}]" 
                                   id="file-{{ $setting->key }}"
                                   class="setting-input-file"
                                   accept="image/*"
                                   onchange="previewImage(this, 'preview-{{ $setting->key }}')">
                            <button type="button" 
                                    class="setting-file-button" 
                                    onclick="document.getElementById('file-{{ $setting->key }}').click()">
                                <i class="fas fa-upload mr-2"></i>Pilih Gambar
                            </button>
                            <div class="setting-file-info mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Format: JPG, PNG (Max: 2MB)
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="setting-group-title mt-5">
                    <i class="fas fa-palette"></i>
                    <span>Warna Tema</span>
                </div>

                <div class="alert alert-success" style="background: #d1fae5; border-left: 4px solid #10b981; padding: 14px; border-radius: 10px; margin-bottom: 20px;">
                    <div style="display: flex; align-items: start; gap: 10px;">
                        <i class="fas fa-paint-brush" style="color: #059669; font-size: 16px; margin-top: 2px;"></i>
                        <div>
                            <strong style="color: #065f46; font-size: 13px; display: block; margin-bottom: 4px;">Penjelasan Warna:</strong>
                            <ul style="color: #047857; font-size: 12px; margin: 0; padding-left: 18px; line-height: 1.8;">
                                <li><strong>Primary:</strong> Warna utama navbar dan sidebar (default: Biru)</li>
                                <li><strong>Secondary:</strong> Warna gradient navbar (default: Biru muda)</li>
                                <li><strong>Topbar:</strong> Warna bagian jam & info di atas navbar (default: Merah)</li>
                                <li><strong>Topbar Secondary:</strong> Warna gradient topbar (default: Merah gelap)</li>
                                <li><strong>Sidebar:</strong> Warna background sidebar admin (default: Biru)</li>
                                <li><strong>Success:</strong> Warna notifikasi berhasil & status aktif (default: Hijau)</li>
                                <li><strong>Warning:</strong> Warna peringatan & tombol login (default: Kuning)</li>
                                <li><strong>Danger:</strong> Warna error & tombol hapus (default: Merah)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                @foreach($settings->get('appearance', [])->where('type', 'color') as $setting)
                <div class="setting-item">
                    <label class="setting-label">
                        <i class="fas fa-fill-drip"></i>
                        {{ $setting->label }}
                        <span class="color-preview" style="background-color: {{ $setting->value }}"></span>
                    </label>
                    @if($setting->description)
                    <div class="setting-description">{{ $setting->description }}</div>
                    @endif

                    {{-- Penjelasan khusus untuk setiap warna --}}
                    @if($setting->key === 'color_primary')
                    <div class="setting-description" style="background: #eff6ff; padding: 10px; border-radius: 8px; margin-top: 8px; border-left: 3px solid #3b82f6;">
                        <i class="fas fa-info-circle" style="color: #3b82f6;"></i>
                        <strong style="color: #1e40af;">Digunakan di:</strong> Navbar utama, Sidebar admin, Button primary, Link aktif
                    </div>
                    @elseif($setting->key === 'color_secondary')
                    <div class="setting-description" style="background: #eff6ff; padding: 10px; border-radius: 8px; margin-top: 8px; border-left: 3px solid #60a5fa;">
                        <i class="fas fa-info-circle" style="color: #60a5fa;"></i>
                        <strong style="color: #1e40af;">Digunakan di:</strong> Gradient navbar, Hover effect, Accent color
                    </div>
                    @elseif($setting->key === 'color_topbar')
                    <div class="setting-description" style="background: #fef2f2; padding: 10px; border-radius: 8px; margin-top: 8px; border-left: 3px solid #ef4444;">
                        <i class="fas fa-info-circle" style="color: #ef4444;"></i>
                        <strong style="color: #991b1b;">Digunakan di:</strong> Topbar navbar public (bagian jam & info di atas navbar)
                    </div>
                    @elseif($setting->key === 'color_topbar_secondary')
                    <div class="setting-description" style="background: #fef2f2; padding: 10px; border-radius: 8px; margin-top: 8px; border-left: 3px solid #dc2626;">
                        <i class="fas fa-info-circle" style="color: #dc2626;"></i>
                        <strong style="color: #991b1b;">Digunakan di:</strong> Gradient topbar navbar public
                    </div>
                    @elseif($setting->key === 'color_sidebar')
                    <div class="setting-description" style="background: #eff6ff; padding: 10px; border-radius: 8px; margin-top: 8px; border-left: 3px solid #3b82f6;">
                        <i class="fas fa-info-circle" style="color: #3b82f6;"></i>
                        <strong style="color: #1e40af;">Digunakan di:</strong> Background sidebar admin panel
                    </div>
                    @elseif($setting->key === 'color_success')
                    <div class="setting-description" style="background: #f0fdf4; padding: 10px; border-radius: 8px; margin-top: 8px; border-left: 3px solid #10b981;">
                        <i class="fas fa-info-circle" style="color: #10b981;"></i>
                        <strong style="color: #065f46;">Digunakan di:</strong> Notifikasi berhasil, Status aktif, Button success, Badge aktif
                    </div>
                    @elseif($setting->key === 'color_warning')
                    <div class="setting-description" style="background: #fffbeb; padding: 10px; border-radius: 8px; margin-top: 8px; border-left: 3px solid #f59e0b;">
                        <i class="fas fa-info-circle" style="color: #f59e0b;"></i>
                        <strong style="color: #92400e;">Digunakan di:</strong> Alert peringatan, Tombol login, Badge pending, Status menunggu
                    </div>
                    @elseif($setting->key === 'color_danger')
                    <div class="setting-description" style="background: #fef2f2; padding: 10px; border-radius: 8px; margin-top: 8px; border-left: 3px solid #ef4444;">
                        <i class="fas fa-info-circle" style="color: #ef4444;"></i>
                        <strong style="color: #991b1b;">Digunakan di:</strong> Notifikasi error, Tombol hapus, Badge ditolak, Status tidak aktif
                    </div>
                    @endif

                    <input type="color" 
                           name="settings[{{ $setting->key }}]" 
                           value="{{ $setting->value }}" 
                           class="setting-input-color"
                           onchange="updateColorPreview(this)">
                </div>
                @endforeach
            </div>

            {{-- Contact Settings --}}
            <div class="settings-section" id="section-contact">
                <div class="alert alert-info" style="background: #e0f2fe; border-left: 4px solid #0284c7; padding: 16px; border-radius: 10px; margin-bottom: 25px;">
                    <div style="display: flex; align-items: start; gap: 12px;">
                        <i class="fas fa-address-book" style="color: #0284c7; font-size: 20px; margin-top: 2px;"></i>
                        <div>
                            <strong style="color: #0c4a6e; font-size: 15px; display: block; margin-bottom: 6px;">Tentang Informasi Kontak</strong>
                            <p style="color: #075985; font-size: 13px; margin: 0; line-height: 1.6;">
                                Informasi kontak ini akan ditampilkan di topbar navbar (bagian atas) dan footer website public. 
                                Pastikan data yang diisi akurat agar pengunjung dapat menghubungi kantor dengan mudah.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="alert alert-warning" style="background: #fef3c7; border-left: 4px solid #f59e0b; padding: 14px; border-radius: 10px; margin-bottom: 20px;">
                    <div style="display: flex; align-items: start; gap: 10px;">
                        <i class="fas fa-map-marked-alt" style="color: #d97706; font-size: 16px; margin-top: 2px;"></i>
                        <div>
                            <strong style="color: #92400e; font-size: 13px; display: block; margin-bottom: 4px;">Lokasi Tampil:</strong>
                            <ul style="color: #b45309; font-size: 12px; margin: 0; padding-left: 18px; line-height: 1.6;">
                                <li><strong>Topbar Navbar:</strong> Alamat & Telepon (bagian atas website)</li>
                                <li><strong>Footer Website:</strong> Semua kontak (Email, Telepon, WhatsApp, Alamat)</li>
                                <li><strong>Halaman Kontak:</strong> Informasi lengkap untuk pengunjung</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="setting-group-title">
                    <i class="fas fa-address-book"></i>
                    <span>Informasi Kontak</span>
                </div>

                @foreach($settings->get('contact', []) as $setting)
                <div class="setting-item">
                    <label class="setting-label">
                        <i class="fas fa-{{ $setting->type === 'email' ? 'envelope' : ($setting->key === 'contact_whatsapp' ? 'whatsapp' : ($setting->key === 'contact_phone' ? 'phone' : 'map-marker-alt')) }}"></i>
                        {{ $setting->label }}
                    </label>
                    @if($setting->description)
                    <div class="setting-description">{{ $setting->description }}</div>
                    @endif

                    @if($setting->type === 'textarea')
                        <textarea name="settings[{{ $setting->key }}]" class="setting-input" rows="3">{{ $setting->value }}</textarea>
                    @else
                        <input type="{{ $setting->type }}" 
                               name="settings[{{ $setting->key }}]" 
                               value="{{ $setting->value }}" 
                               class="setting-input">
                    @endif
                </div>
                @endforeach
            </div>

            {{-- Actions --}}
            <div class="settings-actions">
                <div style="flex: 1; text-align: left; padding-right: 20px;">
                    <div class="alert alert-info" style="background: #dbeafe; border-left: 4px solid #3b82f6; padding: 12px; border-radius: 8px; margin: 0;">
                        <div style="display: flex; align-items: start; gap: 10px;">
                            <i class="fas fa-lightbulb" style="color: #1e40af; font-size: 16px; margin-top: 2px;"></i>
                            <div>
                                <strong style="color: #1e3a8a; font-size: 13px; display: block; margin-bottom: 4px;">Tips:</strong>
                                <p style="color: #1e40af; font-size: 12px; margin: 0; line-height: 1.5;">
                                    Setelah menyimpan perubahan, <strong>refresh halaman</strong> (F5 atau Ctrl+F5) untuk melihat perubahan diterapkan. 
                                    Jika ingin kembali ke pengaturan awal, gunakan tombol <strong>"Reset ke Default"</strong>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-reset" onclick="confirmReset()">
                    <i class="fas fa-undo"></i>
                    <span>Reset ke Default</span>
                </button>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i>
                    <span>Simpan Pengaturan</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Tab switching
document.querySelectorAll('.settings-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs and sections
        document.querySelectorAll('.settings-tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.settings-section').forEach(s => s.classList.remove('active'));
        
        // Add active class to clicked tab and corresponding section
        this.classList.add('active');
        document.getElementById('section-' + this.dataset.tab).classList.add('active');
    });
});

// Preview image
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Update color preview
function updateColorPreview(input) {
    const preview = input.parentElement.querySelector('.color-preview');
    if (preview) {
        preview.style.backgroundColor = input.value;
    }
}

// Confirm reset
function confirmReset() {
    Swal.fire({
        title: 'Reset Pengaturan?',
        text: 'Semua pengaturan akan dikembalikan ke nilai default!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#6b7280',
        confirmButtonText: '<i class="fas fa-undo mr-2"></i>Ya, Reset!',
        cancelButtonText: '<i class="fas fa-times mr-2"></i>Batal',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '{{ route('admin.settings.reset') }}';
        }
    });
}

// Success message
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
@endif

// Error message
@if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ session('error') }}',
        confirmButtonColor: '#667eea'
    });
@endif
</script>
@endpush
