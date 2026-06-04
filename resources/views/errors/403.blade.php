<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: #0f172a;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        /* Animated background */
        body::before {
            content: '';
            position: fixed;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
            top: -100px; left: -100px;
            animation: float1 8s ease-in-out infinite;
        }
        body::after {
            content: '';
            position: fixed;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(239,68,68,0.1) 0%, transparent 70%);
            bottom: -100px; right: -100px;
            animation: float2 10s ease-in-out infinite;
        }
        @keyframes float1 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(50px,50px)} }
        @keyframes float2 { 0%,100%{transform:translate(0,0)} 50%{transform:translate(-50px,-30px)} }

        .wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 560px;
            padding: 20px;
        }

        /* Main Card */
        .card-main {
            background: #1e293b;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 80px rgba(0,0,0,0.5);
        }

        /* Top Banner */
        .top-banner {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #4c1d95 100%);
            padding: 48px 40px 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .top-banner::before {
            content: '403';
            position: absolute;
            font-size: 160px;
            font-weight: 900;
            color: rgba(255,255,255,0.04);
            top: -20px; left: 50%;
            transform: translateX(-50%);
            letter-spacing: -10px;
            white-space: nowrap;
        }
        .lock-icon {
            width: 80px; height: 80px;
            background: rgba(239,68,68,0.15);
            border: 2px solid rgba(239,68,68,0.3);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 24px;
            position: relative;
            animation: pulse 3s ease-in-out infinite;
        }
        .lock-icon i { font-size: 32px; color: #f87171; }
        @keyframes pulse {
            0%,100% { box-shadow: 0 0 0 0 rgba(239,68,68,0.3); }
            50% { box-shadow: 0 0 0 20px rgba(239,68,68,0); }
        }
        .error-code {
            font-size: 14px; font-weight: 600;
            color: rgba(255,255,255,0.4);
            letter-spacing: 4px; text-transform: uppercase;
            margin-bottom: 8px;
        }
        .error-title {
            font-size: 28px; font-weight: 800;
            color: #fff; margin-bottom: 10px;
        }
        .error-subtitle {
            font-size: 15px; color: rgba(255,255,255,0.55);
            line-height: 1.6;
        }

        /* Body */
        .card-body-custom { padding: 32px 40px; }

        /* User Info */
        .user-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 24px;
        }
        .user-card-header {
            display: flex; align-items: center; gap: 12px;
            margin-bottom: 16px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }
        .user-avatar {
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px; font-weight: 700; color: #fff;
        }
        .user-name { font-size: 15px; font-weight: 600; color: #f1f5f9; }
        .user-email { font-size: 13px; color: rgba(255,255,255,0.4); }
        .info-row {
            display: flex; justify-content: space-between; align-items: center;
            padding: 8px 0;
        }
        .info-row:not(:last-child) { border-bottom: 1px solid rgba(255,255,255,0.05); }
        .info-label { font-size: 13px; color: rgba(255,255,255,0.4); }
        .badge-role {
            background: rgba(99,102,241,0.2);
            color: #a5b4fc;
            border: 1px solid rgba(99,102,241,0.3);
            padding: 3px 10px; border-radius: 20px;
            font-size: 12px; font-weight: 600;
        }
        .badge-active {
            background: rgba(16,185,129,0.15);
            color: #6ee7b7;
            border: 1px solid rgba(16,185,129,0.3);
            padding: 3px 10px; border-radius: 20px;
            font-size: 12px; font-weight: 600;
        }

        /* Alert */
        .alert-custom {
            background: rgba(59,130,246,0.08);
            border: 1px solid rgba(59,130,246,0.2);
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 28px;
            display: flex; gap: 12px; align-items: flex-start;
        }
        .alert-custom i { color: #60a5fa; font-size: 16px; margin-top: 1px; flex-shrink: 0; }
        .alert-custom p { font-size: 13px; color: rgba(255,255,255,0.6); margin: 0; line-height: 1.6; }
        .alert-custom strong { color: rgba(255,255,255,0.8); }

        /* Buttons */
        .btn-group-custom { display: flex; gap: 12px; }
        .btn-home {
            flex: 1;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: #fff; border: none;
            padding: 13px 20px; border-radius: 12px;
            font-size: 14px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: all 0.3s;
        }
        .btn-home:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(99,102,241,0.4); color: #fff; text-decoration: none; }
        .btn-logout {
            background: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.6); border: 1px solid rgba(255,255,255,0.1);
            padding: 13px 20px; border-radius: 12px;
            font-size: 14px; font-weight: 600;
            cursor: pointer; text-decoration: none;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: all 0.3s;
        }
        .btn-logout:hover { background: rgba(239,68,68,0.15); border-color: rgba(239,68,68,0.3); color: #f87171; text-decoration: none; }

        /* Footer */
        .card-footer-custom {
            background: rgba(0,0,0,0.2);
            border-top: 1px solid rgba(255,255,255,0.05);
            padding: 16px 40px;
            text-align: center;
        }
        .card-footer-custom p { font-size: 12px; color: rgba(255,255,255,0.2); margin: 0; }
        .card-footer-custom a { color: rgba(99,102,241,0.7); text-decoration: none; }
        .card-footer-custom a:hover { color: #818cf8; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card-main">
            {{-- Top Banner --}}
            <div class="top-banner">
                <div class="lock-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <div class="error-code">Error 403</div>
                <h1 class="error-title">Akses Ditolak</h1>
                <p class="error-subtitle">
                    {{ $message ?? 'Anda tidak memiliki izin untuk mengakses halaman ini.' }}
                </p>
            </div>

            {{-- Body --}}
            <div class="card-body-custom">
                @auth
                @php $user = auth()->user(); @endphp
                {{-- User Info --}}
                <div class="user-card">
                    <div class="user-card-header">
                        <div class="user-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="user-name">{{ $user->name }}</div>
                            <div class="user-email">{{ $user->email }}</div>
                        </div>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Role Akun</span>
                        <span class="badge-role">{{ ucfirst($user->role) }}</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Status</span>
                        <span class="badge-active">{{ $user->is_active ? 'Aktif' : 'Tidak Aktif' }}</span>
                    </div>
                </div>

                {{-- Alert --}}
                <div class="alert-custom">
                    <i class="fas fa-info-circle"></i>
                    <p>Halaman yang Anda akses memerlukan izin khusus. Hubungi <strong>Administrator</strong> jika Anda memerlukan akses ke halaman ini.</p>
                </div>

                {{-- Buttons --}}
                <div class="btn-group-custom">
                    <a href="{{ $user->getDashboardRoute() }}" class="btn-home">
                        <i class="fas fa-home"></i> Dashboard Saya
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display:contents">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>
                @else
                <div class="btn-group-custom">
                    <a href="{{ route('login') }}" class="btn-home">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <a href="{{ route('public.home') }}" class="btn-logout">
                        <i class="fas fa-home"></i> Beranda
                    </a>
                </div>
                @endauth
            </div>

            {{-- Footer --}}
            <div class="card-footer-custom">
                <p>DISPERINDAGKOP Kabupaten Tolikara &mdash; <a href="{{ route('public.home') }}">Kembali ke Beranda</a></p>
            </div>
        </div>
    </div>
</body>
</html>
