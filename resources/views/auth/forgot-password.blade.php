<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | DISPERINDAGKOP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f1f3d 0%, #1a2942 50%, #0d1b35 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        /* Background decorations */
        body::before {
            content: '';
            position: absolute;
            top: -150px; right: -150px;
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(37,99,235,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -100px; left: -100px;
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(56,189,248,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .card-wrapper {
            width: 100%;
            max-width: 420px;
            position: relative;
            z-index: 1;
        }

        /* Header atas card */
        .brand-header {
            text-align: center;
            margin-bottom: 28px;
        }

        .brand-logo {
            width: 64px; height: 64px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border-radius: 18px;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 14px;
            box-shadow: 0 8px 24px rgba(245,158,11,0.3);
        }

        .brand-logo i { font-size: 28px; color: white; }

        .brand-name {
            font-size: 22px;
            font-weight: 800;
            color: white;
            letter-spacing: .5px;
        }

        .brand-name span { color: #f59e0b; }

        .brand-desc {
            font-size: 12px;
            color: rgba(255,255,255,0.5);
            margin-top: 4px;
        }

        /* Card utama */
        .auth-card {
            background: white;
            border-radius: 24px;
            padding: 36px 32px;
            box-shadow: 0 24px 64px rgba(0,0,0,0.3);
        }

        .auth-card .label-top {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #f59e0b;
            margin-bottom: 6px;
        }

        .auth-card h2 {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .auth-card .subtitle {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 28px;
            line-height: 1.6;
        }

        /* Alert */
        .alert-custom {
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 20px;
            border: none;
        }

        .alert-success-custom {
            background: #f0fdf4;
            color: #166534;
            border-left: 4px solid #22c55e;
        }

        .alert-danger-custom {
            background: #fff1f2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        /* Form */
        .form-label-custom {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #475569;
            margin-bottom: 8px;
            display: block;
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 20px;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 15px;
            z-index: 2;
        }

        .form-control-custom {
            width: 100%;
            padding: 14px 16px 14px 44px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0f172a;
            background: #f8fafc;
            transition: all .2s;
            outline: none;
        }

        .form-control-custom:focus {
            border-color: #2563eb;
            background: white;
            box-shadow: 0 0 0 4px rgba(37,99,235,0.08);
        }

        .form-control-custom.is-invalid {
            border-color: #ef4444;
            background: #fff1f2;
        }

        .error-text {
            font-size: 12px;
            color: #ef4444;
            margin-top: -14px;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* Button */
        .btn-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 16px rgba(37,99,235,0.3);
            margin-top: 8px;
        }

        .btn-submit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37,99,235,0.4);
        }

        .btn-submit:active { transform: translateY(0); }

        /* Back link */
        .back-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13.5px;
            color: #64748b;
        }

        .back-link a {
            color: #2563eb;
            font-weight: 600;
            text-decoration: none;
        }

        .back-link a:hover { text-decoration: underline; }

        /* Info box */
        .info-box {
            background: #eff6ff;
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 24px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
        }

        .info-box i {
            color: #2563eb;
            font-size: 16px;
            margin-top: 1px;
            flex-shrink: 0;
        }

        .info-box p {
            font-size: 12.5px;
            color: #1e40af;
            margin: 0;
            line-height: 1.5;
        }

        /* Footer */
        .auth-footer {
            text-align: center;
            margin-top: 24px;
            font-size: 11.5px;
            color: rgba(255,255,255,0.35);
        }
    </style>
</head>
<body>

<div class="card-wrapper">

    {{-- Brand Header --}}
    <div class="brand-header">
        <div class="brand-logo">
            <img src="{{ asset('images/logo-dinas.lupa-password.png') }}" alt="Logo Tolikara" style="height:50px;width:auto;">
        </div>
        <div class="brand-name">DISPERINDAGKOP <span>Tolikara</span></div>
        <div class="brand-desc">Sistem Informasi Perindustrian, Perdagangan, Koperasi & Koperasi</div>
    </div>

    {{-- Auth Card --}}
    <div class="auth-card">

        <div class="label-top">Reset Akses</div>
        <h2>Lupa Password?</h2>
        <p class="subtitle">Masukkan email akun kamu dan kami akan mengirimkan link untuk mereset password.</p>

        {{-- Success Message --}}
        @if (session('status'))
            <div class="alert-custom alert-success-custom">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('status') }}
            </div>
        @endif

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="alert-custom alert-danger-custom">
                <i class="fas fa-exclamation-circle me-2"></i>
                {{ $errors->first() }}
            </div>
        @endif

        {{-- Info Box --}}
        <div class="info-box">
            <i class="fas fa-info-circle"></i>
            <p>Link reset password akan dikirim ke email kamu. Pastikan email yang dimasukkan sudah terdaftar di sistem.</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <label class="form-label-custom">Email</label>
            <div class="input-group-custom">
                <i class="fas fa-envelope input-icon"></i>
                <input
                    type="email"
                    name="email"
                    class="form-control-custom {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    placeholder="contoh@email.com"
                    value="{{ old('email') }}"
                    required
                    autofocus>
            </div>

            @error('email')
                <div class="error-text">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </div>
            @enderror

            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i>
                Kirim Link Reset
            </button>
        </form>

        {{-- Back to login --}}
        <div class="back-link">
            <i class="fas fa-arrow-left me-1" style="font-size:11px"></i>
            <a href="{{ route('login') }}">Kembali ke halaman login</a>
        </div>

    </div>

    {{-- Footer --}}
    <div class="auth-footer">
        &copy; {{ date('Y') }} Dinas Perindustrian, Perdagangan, Koperasi & Koperasi — Kabupaten Tolikara
    </div>

</div>

</body>
</html>