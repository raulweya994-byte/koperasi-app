<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', app_name())</title>
    <meta name="description"
        content="@yield('meta_desc', setting('app_description', 'Sistem Informasi Manajemen Koperasi'))">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ app_favicon() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,700;0,800;1,700&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary:
                {{ theme_color('primary') }}
            ;
            --secondary:
                {{ theme_color('secondary') }}
            ;
            --topbar:
                {{ theme_color('topbar') }}
            ;
            --topbar-secondary:
                {{ theme_color('topbar_secondary') }}
            ;
            --accent:
                {{ theme_color('warning') }}
            ;
            --success:
                {{ theme_color('success') }}
            ;
            --danger:
                {{ theme_color('danger') }}
            ;
            --light: #f8f9fa;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #333;
            background: #fff;
        }

        /* ══ TOP BAR ═══════════════════════════════════ */
        .topbar {
            background: var(--primary);
            color: #fff;
            font-size: 12px;
            padding: 7px 0;
        }

        .topbar a {
            color: rgba(255, 255, 255, .85);
            text-decoration: none;
            transition: color .2s;
        }

        .topbar a:hover {
            color: #fff;
        }

        .topbar-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .topbar-item i {
            font-size: 11px;
            opacity: .85;
        }

        /* ══ NAVBAR ════════════════════════════════════ */
        .navbar-main {
            background: var(--primary);
            padding: 0;
            box-shadow: 0 2px 16px rgba(0, 0, 0, .25);
        }

        .navbar-main .navbar-brand {
            padding: 8px 0;
        }

        .brand-logo-circle {
            width: 42px;
            height: 42px;
            background: var(--accent);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            flex-shrink: 0;
            box-shadow: 0 3px 10px rgba(245, 166, 35, .4);
        }

        .brand-logo-circle i {
            font-size: 20px;
            color: #1a1a1a;
        }

        .brand-text strong {
            font-size: 14px;
            font-weight: 800;
            color: #fff;
            display: block;
            line-height: 1.1;
        }

        .brand-text span {
            font-size: 10.5px;
            color: rgba(255, 255, 255, .65);
            font-weight: 500;
        }

        /* Nav links */
        .navbar-main .nav-link {
            color: rgba(255, 255, 255, .85) !important;
            padding: 20px 13px !important;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1px;
            transition: all .25s;
            position: relative;
            white-space: nowrap;
        }

        .navbar-main .nav-link:hover,
        .navbar-main .nav-item.active>.nav-link {
            color: #fff !important;
        }

        .navbar-main .nav-item.active>.nav-link::after,
        .navbar-main .nav-item:hover>.nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 13px;
            right: 13px;
            height: 3px;
            background: var(--accent);
            border-radius: 3px 3px 0 0;
        }

        /* Dropdown */
        .navbar-main .dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, .18);
            padding: 8px;
            min-width: 200px;
            margin-top: 0;
        }

        .navbar-main .dropdown-item {
            border-radius: 8px;
            padding: 9px 14px;
            font-size: 13px;
            font-weight: 600;
            color: var(--primary);
            transition: all .18s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-main .dropdown-item i {
            width: 18px;
            color: var(--accent);
            font-size: 13px;
        }

        .navbar-main .dropdown-item:hover {
            background: #f0f4ff;
        }

        .navbar-main .dropdown-item.active {
            background: var(--primary);
            color: #fff;
        }

        .navbar-main .dropdown-item.active i {
            color: var(--accent);
        }

        .navbar-main .dropdown-divider {
            margin: 4px 8px;
        }

        /* Tombol Login / User */
        .btn-user-nav {
            background: var(--accent) !important;
            color: #1a1a1a !important;
            border-radius: 8px !important;
            padding: 8px 16px !important;
            font-weight: 700 !important;
            font-size: 13px !important;
            margin-left: 6px;
            transition: all .22s !important;
            display: inline-flex !important;
            align-items: center;
            gap: 7px;
            box-shadow: 0 3px 12px rgba(245, 166, 35, .35);
        }

        .btn-user-nav:hover {
            background: #ffb800 !important;
            color: #1a1a1a !important;
            transform: translateY(-1px);
        }

        /* User dropdown */
        .user-dropdown .dropdown-menu {
            right: 0;
            left: auto;
            min-width: 220px;
        }

        .user-info-header {
            padding: 12px 16px;
            border-bottom: 1px solid #f0f2f7;
            margin-bottom: 6px;
        }

        .user-info-header .user-name {
            font-weight: 700;
            color: var(--primary);
            font-size: 14px;
            display: block;
        }

        .user-info-header .user-role {
            font-size: 12px;
            color: #888;
            font-weight: 500;
        }

        .user-dropdown .dropdown-item.text-danger {
            color: #dc3545 !important;
        }

        .user-dropdown .dropdown-item.text-danger i {
            color: #dc3545;
        }

        .user-dropdown .dropdown-item.text-danger:hover {
            background: #fff5f5;
        }

        /* Hamburger */
        .navbar-toggler {
            border-color: rgba(255, 255, 255, .3) !important;
        }

        /* ══ HERO ═══════════════════════════════════════ */
        .hero {
            position: relative;
            color: #fff;
            min-height: 540px;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-slides {
            position: absolute;
            inset: 0;
            z-index: 0;
        }

        .hero-slide {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(26, 58, 110, .82), rgba(26, 58, 110, .60));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            width: 100%;
            padding: 100px 0 80px;
        }

        .hero-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            display: flex;
            gap: 8px;
        }

        .hero-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .35);
            border: none;
            cursor: pointer;
            transition: all .3s;
            padding: 0;
        }

        .hero-dot.active {
            background: var(--accent);
            transform: scale(1.3);
        }

        .hero-nav {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 3;
            background: rgba(255, 255, 255, .15);
            border: none;
            color: #fff;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            font-size: 16px;
            cursor: pointer;
            transition: background .3s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-nav:hover {
            background: rgba(255, 255, 255, .28);
        }

        .hero-nav.prev {
            left: 20px;
        }

        .hero-nav.next {
            right: 20px;
        }

        /* ══ SECTIONS ═══════════════════════════════════ */
        .stats-bar {
            background: #fff;
            padding: 0;
            border-top: 4px solid var(--accent);
            box-shadow: 0 6px 30px rgba(0, 0, 0, .08);
        }

        .stat-item {
            padding: 28px 16px;
            text-align: center;
            border-right: 1px solid #f0f2f7;
            transition: background .2s;
        }

        .stat-item:last-child {
            border-right: none;
        }

        .stat-item:hover {
            background: #fafbff;
        }

        .stat-item i {
            font-size: 1.5rem;
            color: var(--accent);
            margin-bottom: 8px;
            display: block;
        }

        .stat-item .stat-num {
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary);
            display: block;
            line-height: 1;
        }

        .stat-item .stat-label {
            font-size: 12px;
            color: #888;
            margin-top: 6px;
            font-weight: 600;
            letter-spacing: .3px;
        }

        .section {
            padding: 80px 0;
        }

        .section-alt {
            background: #f5f7fc;
        }

        .section-title {
            text-align: center;
            margin-bottom: 56px;
        }

        .section-title .eyebrow {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2.2px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 10px;
        }

        .section-title h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.3rem;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .section-title p {
            color: #5a6475;
            font-size: .97rem;
            max-width: 460px;
            margin: 0 auto;
            line-height: 1.75;
        }

        .title-line {
            width: 48px;
            height: 3px;
            background: linear-gradient(90deg, var(--accent), #ffb800);
            margin: 16px auto 0;
            border-radius: 2px;
        }

        .layanan-item {
            padding: 34px 28px;
            border-radius: 18px;
            background: #fff;
            border: 1.5px solid #eaecf3;
            transition: all .3s;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .layanan-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--accent));
            transform: scaleX(0);
            transform-origin: left;
            transition: transform .35s;
        }

        .layanan-item:hover {
            transform: translateY(-7px);
            box-shadow: 0 20px 50px rgba(26, 58, 110, .1);
            border-color: transparent;
        }

        .layanan-item:hover::after {
            transform: scaleX(1);
        }

        .layanan-item .icon-wrap {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            margin: 0 0 22px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .layanan-item h5 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 10px;
            font-size: 1.05rem;
        }

        .layanan-item p {
            font-size: 14px;
            color: #5a6475;
            line-height: 1.75;
            margin: 0;
        }

        .card-umkm {
            border: none;
            border-radius: 18px;
            box-shadow: 0 2px 18px rgba(0, 0, 0, .07);
            transition: all .32s;
            overflow: hidden;
            height: 100%;
            background: #fff;
            display: flex;
            flex-direction: column;
        }

        .card-umkm:hover {
            transform: translateY(-7px);
            box-shadow: 0 20px 50px rgba(26, 58, 110, .13);
        }

        .card-umkm .card-thumb {
            height: 180px;
            background: linear-gradient(135deg, var(--primary), #2a5aad);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .card-umkm .card-thumb::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 28px;
            background: #fff;
            clip-path: ellipse(55% 100% at 50% 100%);
        }

        .card-umkm .card-thumb i {
            font-size: 3.5rem;
            color: rgba(255, 255, 255, .2);
        }

        .card-umkm .card-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-umkm .card-body {
            padding: 20px 24px 26px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .badge-kat {
            display: inline-block;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: .8px;
            text-transform: uppercase;
            padding: 4px 12px;
            border-radius: 100px;
            margin-bottom: 10px;
            align-self: flex-start;
        }

        .badge-kat.mikro {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .badge-kat.kecil {
            background: #f0fdf4;
            color: #15803d;
        }

        .badge-kat.menengah {
            background: #fffbeb;
            color: #a16207;
        }

        .card-umkm h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 7px;
            line-height: 1.4;
        }

        .card-umkm .umkm-distrik {
            font-size: 12.5px;
            color: #7a8394;
            margin-bottom: 7px;
        }

        .card-umkm .umkm-jenis {
            font-size: 13.5px;
            color: #4a5568;
            flex: 1;
            margin-bottom: 18px;
            line-height: 1.6;
        }

        .btn-detail {
            display: block;
            width: 100%;
            padding: 11px;
            border-radius: 9px;
            border: 1.5px solid var(--primary);
            color: var(--primary) !important;
            font-size: 13.5px;
            font-weight: 700;
            background: transparent;
            transition: all .22s;
            text-align: center;
            text-decoration: none;
        }

        .btn-detail:hover {
            background: var(--primary);
            color: #fff !important;
            box-shadow: 0 4px 16px rgba(26, 58, 110, .25);
        }

        .card-news {
            border: none;
            border-radius: 18px;
            box-shadow: 0 2px 18px rgba(0, 0, 0, .07);
            transition: all .32s;
            overflow: hidden;
            height: 100%;
            background: #fff;
            display: flex;
            flex-direction: column;
        }

        .card-news:hover {
            transform: translateY(-7px);
            box-shadow: 0 20px 50px rgba(26, 58, 110, .13);
        }

        .card-news .news-thumb {
            height: 210px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .card-news .news-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .45s;
        }

        .card-news:hover .news-thumb img {
            transform: scale(1.06);
        }

        .card-news .news-thumb .thumb-placeholder {
            height: 100%;
            background: linear-gradient(135deg, var(--primary), #2a5aad);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-news .news-body {
            padding: 22px 24px 26px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .card-news .news-meta {
            font-size: 12px;
            color: #7a8a9a;
            margin-bottom: 10px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-news h5 {
            font-family: 'Playfair Display', serif;
            font-size: 1.05rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 9px;
            line-height: 1.5;
        }

        .card-news p {
            font-size: 13.5px;
            color: #4a5568;
            line-height: 1.75;
            flex: 1;
            margin-bottom: 18px;
        }

        .btn-baca {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--primary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: gap .2s, color .2s;
        }

        .btn-baca:hover {
            color: var(--accent);
            gap: 12px;
            text-decoration: none;
        }

        .galeri-item {
            border-radius: 14px;
            overflow: hidden;
            position: relative;
            height: 215px;
            cursor: pointer;
        }

        .galeri-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .45s;
        }

        .galeri-item:hover img {
            transform: scale(1.08);
        }

        .galeri-item .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(26, 58, 110, .88) 0%, transparent 55%);
            opacity: 0;
            transition: opacity .35s;
            display: flex;
            align-items: flex-end;
            padding: 18px;
            color: #fff;
            font-size: 13.5px;
            font-weight: 600;
        }

        .galeri-item:hover .overlay {
            opacity: 1;
        }

        .kontak-item {
            border-radius: 12px;
            border: 1.5px solid #e0e6f0;
            overflow: hidden;
            margin-bottom: 12px;
        }

        .kontak-question {
            padding: 18px 24px;
            cursor: pointer;
            font-weight: 600;
            color: var(--primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            font-size: 14.5px;
            transition: background .2s;
            gap: 16px;
            line-height: 1.6;
        }

        .kontak-question:hover {
            background: #f7f9ff;
        }

        .kontak-icon {
            flex-shrink: 0;
            font-size: 12px;
            transition: transform .3s;
        }

        .kontak-answer {
            padding: 18px 24px;
            background: #f7f9ff;
            border-top: 1.5px solid #e0e6f0;
            font-size: 14px;
            color: #4a5568;
            line-height: 1.85;
            display: none;
        }

        .kontak-answer.show {
            display: block;
        }

        .kontak-item.open .kontak-icon {
            transform: rotate(180deg);
        }

        .btn-main {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 38px;
            background: var(--primary);
            color: #fff !important;
            border-radius: 9px;
            font-weight: 700;
            font-size: 14.5px;
            text-decoration: none;
            transition: all .25s;
            box-shadow: 0 4px 18px rgba(26, 58, 110, .25);
        }

        .btn-main:hover {
            background: #15306a;
            transform: translateY(-2px);
            text-decoration: none;
        }

        .cta-wrap {
            background: linear-gradient(135deg, #0d2240, #1a3a6e);
            padding: 88px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-wrap::before {
            content: '';
            position: absolute;
            width: 360px;
            height: 360px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .04);
            top: -100px;
            right: -80px;
        }

        .cta-wrap::after {
            content: '';
            position: absolute;
            width: 260px;
            height: 260px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .04);
            bottom: -80px;
            left: -50px;
        }

        .cta-wrap .inner {
            position: relative;
            z-index: 1;
        }

        .cta-wrap h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: #fff;
            margin-bottom: 16px;
        }

        .cta-wrap p {
            color: rgba(255, 255, 255, .8);
            font-size: 1.08rem;
            margin-bottom: 38px;
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.8;
        }

        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 16px 46px;
            background: var(--accent);
            color: #1a1a1a !important;
            border-radius: 9px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            transition: all .25s;
            box-shadow: 0 6px 28px rgba(245, 166, 35, .45);
        }

        .btn-cta:hover {
            background: #ffb800;
            transform: translateY(-2px);
            text-decoration: none;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary), #2d5fad);
            color: #fff;
            padding: 44px 0;
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
        }

        .page-header .breadcrumb {
            background: transparent;
            margin: 0;
            padding: 0;
        }

        .page-header .breadcrumb-item,
        .page-header .breadcrumb-item a {
            color: rgba(255, 255, 255, .7);
            font-size: 13px;
        }

        .page-header .breadcrumb-item.active {
            color: #fff;
        }

        .page-header .breadcrumb-item+.breadcrumb-item::before {
            color: rgba(255, 255, 255, .4);
        }

        .badge-mikro {
            background: #007bff;
            color: #fff;
        }

        .badge-kecil {
            background: #28a745;
            color: #fff;
        }

        .badge-menengah {
            background: #ffc107;
            color: #333;
        }

        .pagination .page-link {
            color: var(--primary);
        }

        .pagination .page-item.active .page-link {
            background: var(--primary);
            border-color: var(--primary);
        }

        .search-bar {
            background: #fff;
            border-radius: 50px;
            padding: 5px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .1);
            display: flex;
            align-items: center;
        }

        .search-bar input {
            border: none;
            outline: none;
            flex: 1;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 15px;
        }

        .search-bar button {
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 10px 25px;
            font-weight: 600;
            cursor: pointer;
        }

        @media(max-width: 991px) {
            .navbar-main .nav-link {
                padding: 12px 16px !important;
            }

            .navbar-main .nav-item.active>.nav-link::after,
            .navbar-main .nav-item:hover>.nav-link::after {
                display: none;
            }

            .hero-nav {
                display: none;
            }
        }

        @media(max-width: 768px) {
            .stat-item {
                border-right: none;
                border-bottom: 1px solid #f0f2f7;
            }

            .section {
                padding: 64px 0;
            }

            .section-title h2 {
                font-size: 1.8rem;
            }
        }
    </style>
    @stack('styles')
</head>

<body>

    {{-- Include Navbar Partial --}}
    @include('public.partials.navbar')

    @yield('content')

    {{-- ══ FOOTER ════════════════════════════════════ --}}
    <footer style="background:#1a2540;color:#ccc;padding:50px 0 0">
        <div class="container">
            <div class="row" style="row-gap:40px;column-gap:20px">
                {{-- KOLOM 1: Logo & Tagline --}}
                <div class="col-lg-3 col-md-6 mb-4" style="padding-left:10px;padding-right:20px">
                    {{-- Logo dan Nama --}}
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ app_logo() }}" alt="Logo {{ app_name() }}"
                            style="height: 55px; margin-right: 12px;">
                        <div>
                            <h5 style="color:#fff;font-weight:700;margin-bottom:3px;font-size:15px;line-height:1.2">
                                DISPERINDAGKOP Kab. Tolikara
                            </h5>
                            <p style="color:#aaa;font-size:11px;margin:0;line-height:1.3">Sistem Informasi Manajemen
                                Koperasi</p>
                        </div>
                    </div>

                    {{-- Tagline Menarik --}}
                    <div
                        style="background:rgba(255,255,255,0.05);padding:12px;border-radius:8px;border-left:3px solid #f5a623;margin-bottom:15px">
                        <p style="font-size:13px;color:#fff;line-height:1.6;margin:0;font-style:italic">
                            <i class="fas fa-quote-left mr-1" style="color:#f5a623;font-size:10px"></i>
                            Membangun Ekonomi Kerakyatan Melalui Koperasi yang Kuat dan Mandiri
                            <i class="fas fa-quote-right ml-1" style="color:#f5a623;font-size:10px"></i>
                        </p>
                    </div>

                    <p style="font-size:12.5px;color:#aaa;line-height:1.7;margin-bottom:15px">
                        Bersama memajukan koperasi di Kabupaten Tolikara untuk kesejahteraan masyarakat Papua
                        Pegunungan.
                    </p>

                    {{-- Social Media --}}
                    <div>
                        <p style="color:#fff;font-size:12px;font-weight:600;margin-bottom:10px">
                            <i class="fas fa-share-alt mr-1" style="color:#f5a623;font-size:11px"></i>Ikuti Kami
                        </p>
                        <a href="#"
                            style="display:inline-flex;width:38px;height:38px;background:rgba(255,255,255,.08);border-radius:50%;align-items:center;justify-content:center;color:#ccc;margin-right:8px;text-decoration:none;transition:all .3s;border:1px solid rgba(255,255,255,0.1)"
                            onmouseover="this.style.background='#1877f2';this.style.color='#fff';this.style.transform='translateY(-2px)';this.style.borderColor='#1877f2'"
                            onmouseout="this.style.background='rgba(255,255,255,.08)';this.style.color='#ccc';this.style.transform='translateY(0)';this.style.borderColor='rgba(255,255,255,0.1)'">
                            <i class="fab fa-facebook-f" style="font-size:15px"></i>
                        </a>
                        <a href="#"
                            style="display:inline-flex;width:38px;height:38px;background:rgba(255,255,255,.08);border-radius:50%;align-items:center;justify-content:center;color:#ccc;margin-right:8px;text-decoration:none;transition:all .3s;border:1px solid rgba(255,255,255,0.1)"
                            onmouseover="this.style.background='#e4405f';this.style.color='#fff';this.style.transform='translateY(-2px)';this.style.borderColor='#e4405f'"
                            onmouseout="this.style.background='rgba(255,255,255,.08)';this.style.color='#ccc';this.style.transform='translateY(0)';this.style.borderColor='rgba(255,255,255,0.1)'">
                            <i class="fab fa-instagram" style="font-size:15px"></i>
                        </a>
                        <a href="#"
                            style="display:inline-flex;width:38px;height:38px;background:rgba(255,255,255,.08);border-radius:50%;align-items:center;justify-content:center;color:#ccc;margin-right:8px;text-decoration:none;transition:all .3s;border:1px solid rgba(255,255,255,0.1)"
                            onmouseover="this.style.background='#ff0000';this.style.color='#fff';this.style.transform='translateY(-2px)';this.style.borderColor='#ff0000'"
                            onmouseout="this.style.background='rgba(255,255,255,.08)';this.style.color='#ccc';this.style.transform='translateY(0)';this.style.borderColor='rgba(255,255,255,0.1)'">
                            <i class="fab fa-youtube" style="font-size:15px"></i>
                        </a>
                        <a href="https://wa.me/6208517758927" target="_blank"
                            style="display:inline-flex;width:38px;height:38px;background:rgba(255,255,255,.08);border-radius:50%;align-items:center;justify-content:center;color:#ccc;text-decoration:none;transition:all .3s;border:1px solid rgba(255,255,255,0.1)"
                            onmouseover="this.style.background='#25d366';this.style.color='#fff';this.style.transform='translateY(-2px)';this.style.borderColor='#25d366'"
                            onmouseout="this.style.background='rgba(255,255,255,.08)';this.style.color='#ccc';this.style.transform='translateY(0)';this.style.borderColor='rgba(255,255,255,0.1)'">
                            <i class="fab fa-whatsapp" style="font-size:17px"></i>
                        </a>
                    </div>
                </div>

                {{-- KOLOM 2: Menu --}}
                <div class="col-lg-2 col-md-6 mb-4" style="padding-left:20px;padding-right:20px">
                    <h5
                        style="color:#fff;font-weight:700;margin-bottom:18px;font-size:14px;padding-bottom:12px;border-bottom:2px solid rgba(245,166,35,0.3)">
                        <i class="fas fa-bars mr-2" style="color:#f5a623;font-size:13px"></i>Menu
                    </h5>
                    <ul class="list-unstyled" style="font-size:13px;line-height:2.4">
                        <li><a href="{{ route('public.home') }}"
                                style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2"
                                    style="font-size:8px;color:#f5a623"></i>Beranda</a></li>
                        <li><a href="{{ route('public.tentang') }}"
                                style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2" style="font-size:8px;color:#f5a623"></i>Profil
                                Dinas</a></li>
                        <li><a href="{{ route('public.koperasi') }}"
                                style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2" style="font-size:8px;color:#f5a623"></i>Direktori
                                Koperasi</a></li>
                        <li><a href="{{ route('public.berita') }}"
                                style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2" style="font-size:8px;color:#f5a623"></i>Berita</a>
                        </li>
                        <li><a href="{{ route('public.pengumuman') }}"
                                style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2"
                                    style="font-size:8px;color:#f5a623"></i>Pengumuman</a></li>
                        <li><a href="{{ route('public.galeri') }}"
                                style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2" style="font-size:8px;color:#f5a623"></i>Galeri</a>
                        </li>
                    </ul>
                </div>

                {{-- KOLOM 3: Layanan --}}
                <div class="col-lg-2 col-md-6 mb-4" style="padding-left:20px;padding-right:20px">
                    <h5
                        style="color:#fff;font-weight:700;margin-bottom:18px;font-size:14px;padding-bottom:12px;border-bottom:2px solid rgba(245,166,35,0.3)">
                        <i class="fas fa-hands-helping mr-2" style="color:#f5a623;font-size:13px"></i>Layanan
                    </h5>
                    <ul class="list-unstyled" style="font-size:13px;line-height:2.4">
                        <li><a href="{{ route('login') }}"
                                style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2"
                                    style="font-size:8px;color:#f5a623"></i>Pendaftaran Koperasi</a></li>
                        <li><a href="#" style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2" style="font-size:8px;color:#f5a623"></i>Bantuan
                                Usaha</a></li>
                        <li><a href="#" style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2" style="font-size:8px;color:#f5a623"></i>Pelatihan
                                & Pembinaan</a></li>
                        <li><a href="#" style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2"
                                    style="font-size:8px;color:#f5a623"></i>Komitmen</a></li>
                        <li><a href="#" style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2"
                                    style="font-size:8px;color:#f5a623"></i>Sertifikasi Produk</a></li>
                        <li><a href="{{ route('login') }}"
                                style="color:#aaa;text-decoration:none;transition:all 0.2s;display:block"
                                onmouseover="this.style.color='#f5a623';this.style.paddingLeft='5px'"
                                onmouseout="this.style.color='#aaa';this.style.paddingLeft='0'"><i
                                    class="fas fa-chevron-right mr-2" style="font-size:8px;color:#f5a623"></i>Portal
                                Koperasi</a></li>
                    </ul>
                </div>

                {{-- KOLOM 4: Kontak & Peta --}}
                <div class="col-lg-4 col-md-6 mb-4" style="padding-left:20px;padding-right:10px">
                    <h5
                        style="color:#fff;font-weight:700;margin-bottom:18px;font-size:14px;padding-bottom:12px;border-bottom:2px solid rgba(245,166,35,0.3)">
                        <i class="fas fa-phone-alt mr-2" style="color:#f5a623;font-size:13px"></i>Kontak
                    </h5>
                    <div style="font-size:12.5px;line-height:2.2">
                        <p style="color:#aaa;margin-bottom:10px">
                            <i class="fas fa-map-marker-alt mr-2"
                                style="color:#f5a623;width:16px"></i>{{ setting('contact_address', 'Jl. Raya Karubaga, Kab. Tolikara, Papua Pegunungan') }}
                        </p>
                        <p style="color:#aaa;margin-bottom:10px">
                            <i class="fas fa-phone mr-2"
                                style="color:#f5a623;width:16px"></i>{{ setting('contact_phone', '(0964) 123456') }}
                        </p>
                        <p style="color:#aaa;margin-bottom:10px">
                            <i class="fas fa-envelope mr-2" style="color:#f5a623;width:16px"></i>{{
                            setting('contact_email', 'info@disperindagkop.tolikara.go.id') }}
                        </p>
                        @if(setting('contact_whatsapp'))
                            <p style="color:#aaa;margin-bottom:10px">
                                <i class="fab fa-whatsapp mr-2"
                                    style="color:#f5a623;width:16px"></i>{{ setting('contact_whatsapp') }}
                            </p>
                        @endif
                        <p style="color:#aaa;margin-bottom:18px">
                            <i class="fas fa-clock mr-2" style="color:#f5a623;width:16px"></i>Senin–Jumat: 08.00–16.00
                            WIT
                        </p>
                    </div>

                    {{-- Peta Lokasi --}}
                    <div
                        style="margin-top:12px;border-radius:8px;overflow:hidden;border:2px solid rgba(245,166,35,0.3);box-shadow:0 3px 8px rgba(0,0,0,0.2)">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.554083659543!2d138.4659558740056!3d-3.6883950962855807!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x681619cb1b065353%3A0xc420843f02fc5eef!2sTolikara%2C%20Papua%2C%20Indonesia!5e0!3m2!1sid!2sid!4v1776651088324!5m2!1sid!2sid"
                            width="100%" height="220" style="border:0;display:block" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>

                    {{-- Layanan Pengaduan --}}
                    <div
                        style="background:rgba(245,166,35,0.1);padding:10px 12px;border-radius:6px;border:1px solid rgba(245,166,35,0.2);margin-top:12px">
                        <p style="color:#f5a623;font-size:11.5px;font-weight:600;margin:0">
                            <i class="fas fa-info-circle mr-1"></i>Layanan Pengaduan
                        </p>
                        <p style="color:#aaa;font-size:10.5px;margin:3px 0 0 0;line-height:1.4">
                            Kami siap melayani Anda dengan sepenuh hati
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Bottom --}}
        <div style="background:#111827;margin-top:35px;padding:18px 0;font-size:12.5px;text-align:center;color:#666">
            <div class="container">
                <p style="margin:0;line-height:1.6">
                    {!! setting('app_footer', '© ' . date('Y') . ' <strong style="color:#f5a623">DISPERINDAGKOP Kabupaten Tolikara</strong>. Semua Hak Dilindungi.') !!}
                </p>
                <p style="margin:4px 0 0 0;font-size:11.5px;color:#555">
                    <i class="fas fa-heart" style="color:#f5a623;font-size:10px"></i> Dibuat dengan dedikasi untuk
                    kemajuan koperasi Papua Pegunungan
                </p>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Jam realtime
        var _hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        var _bln = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        function updateJam() {
            var d = new Date(), el = document.getElementById("jamTopbar");
            if (!el) return;
            el.innerHTML = _hari[d.getDay()] + ", " +
                String(d.getDate()).padStart(2, "0") + " " + _bln[d.getMonth()] + " " + d.getFullYear() +
                " &nbsp;|&nbsp; " +
                String(d.getHours()).padStart(2, "0") + ":" + String(d.getMinutes()).padStart(2, "0") + ":" + String(d.getSeconds()).padStart(2, "0") + " WIT";
        }
        updateJam(); setInterval(updateJam, 1000);

        // Kontak toggle
        document.querySelectorAll('.kontak-question').forEach(function (q) {
            q.addEventListener('click', function () {
                var item = this.closest('.kontak-item'), ans = this.nextElementSibling;
                var isOpen = ans.classList.contains('show');
                document.querySelectorAll('.kontak-answer').forEach(function (a) { a.classList.remove('show'); });
                document.querySelectorAll('.kontak-item').forEach(function (i) { i.classList.remove('open'); });
                if (!isOpen) { ans.classList.add('show'); item.classList.add('open'); }
            });
        });

        // Navbar shadow scroll
        window.addEventListener('scroll', function () {
            var nav = document.querySelector('.navbar-main');
            if (nav) nav.style.boxShadow = window.scrollY > 50 ? '0 4px 24px rgba(0,0,0,.4)' : '0 2px 16px rgba(0,0,0,.25)';
        });

        // Hero slideshow
        var heroImages = ['/images/hero/slide1.jpg', '/images/hero/slide2.jpg', '/images/hero/slide3.jpg'];
        var currentSlide = 0, autoPlay;
        function initHeroSlider() {
            var heroEl = document.querySelector('.hero');
            if (!heroEl) return;
            var heroInner = heroEl.innerHTML;
            heroEl.innerHTML = '';
            var slidesWrap = document.createElement('div'); slidesWrap.className = 'hero-slides';
            heroImages.forEach(function (src, i) { var s = document.createElement('div'); s.className = 'hero-slide' + (i === 0 ? ' active' : ''); s.style.backgroundImage = 'url(' + src + ')'; slidesWrap.appendChild(s); });
            var overlay = document.createElement('div'); overlay.className = 'hero-overlay';
            var contentWrap = document.createElement('div'); contentWrap.className = 'hero-content'; contentWrap.innerHTML = heroInner;
            var dotsWrap = document.createElement('div'); dotsWrap.className = 'hero-dots';
            heroImages.forEach(function (_, i) { var d = document.createElement('button'); d.className = 'hero-dot' + (i === 0 ? ' active' : ''); d.addEventListener('click', function () { goToSlide(i); }); dotsWrap.appendChild(d); });
            var btnPrev = document.createElement('button'); btnPrev.className = 'hero-nav prev'; btnPrev.innerHTML = '<i class="fas fa-chevron-left"></i>'; btnPrev.addEventListener('click', function () { changeSlide(-1); });
            var btnNext = document.createElement('button'); btnNext.className = 'hero-nav next'; btnNext.innerHTML = '<i class="fas fa-chevron-right"></i>'; btnNext.addEventListener('click', function () { changeSlide(1); });
            heroEl.appendChild(slidesWrap); heroEl.appendChild(overlay); heroEl.appendChild(contentWrap); heroEl.appendChild(dotsWrap); heroEl.appendChild(btnPrev); heroEl.appendChild(btnNext);
            autoPlay = setInterval(function () { changeSlide(1); }, 4000);
            heroEl.addEventListener('mouseenter', function () { clearInterval(autoPlay); });
            heroEl.addEventListener('mouseleave', function () { autoPlay = setInterval(function () { changeSlide(1); }, 4000); });
        }
        function changeSlide(dir) { currentSlide = (currentSlide + dir + heroImages.length) % heroImages.length; updateSlide(); }
        function goToSlide(i) { currentSlide = i; updateSlide(); }
        function updateSlide() {
            document.querySelectorAll('.hero-slide').forEach(function (s, i) { s.classList.toggle('active', i === currentSlide); });
            document.querySelectorAll('.hero-dot').forEach(function (d, i) { d.classList.toggle('active', i === currentSlide); });
        }
        document.addEventListener('DOMContentLoaded', function () { initHeroSlider(); });
    </script>
    @stack('scripts')
</body>

</html>