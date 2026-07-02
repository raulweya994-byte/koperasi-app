<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | DISPERINDAGKOP Tolikara</title>
<link rel="icon" type="image/png" href="{{ asset('images/logo-tolikara.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
body{
    font-family:'Plus Jakarta Sans',sans-serif;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
    background:linear-gradient(135deg,#0a1628 0%,#1a3a6e 50%,#0a1628 100%);
    position:relative;
    overflow:hidden;
}
.bg-circle{position:fixed;border-radius:50%;pointer-events:none;}
.bg-circle-1{width:600px;height:600px;border:1px solid rgba(255,255,255,.04);top:-150px;left:-150px;}
.bg-circle-2{width:800px;height:800px;border:1px solid rgba(245,166,35,.04);bottom:-200px;right:-200px;}
.bg-circle-3{width:400px;height:400px;border:1px solid rgba(255,255,255,.03);top:50%;left:50%;transform:translate(-50%,-50%);}

.card{
    background:#fff;
    border-radius:28px;
    width:100%;
    max-width:460px;
    box-shadow:0 40px 100px rgba(0,0,0,.5);
    overflow:hidden;
    position:relative;
    z-index:10;
    animation:fadeUp .5s ease both;
}
@keyframes fadeUp{from{opacity:0;transform:translateY(30px);}to{opacity:1;transform:translateY(0);}}

.card-stripe{height:5px;background:linear-gradient(90deg,#1a3a6e,#f5a623,#e53e3e);}

.card-header{
    background:linear-gradient(160deg,#1a3a6e 0%,#2d5aa0 100%);
    padding:44px 40px 40px;
    text-align:center;
    position:relative;
    overflow:hidden;
}
.card-header::before{
    content:'';position:absolute;
    width:350px;height:350px;border-radius:50%;
    border:1px solid rgba(255,255,255,.06);
    top:-120px;left:-80px;
}
.card-header::after{
    content:'';position:absolute;
    width:250px;height:250px;border-radius:50%;
    border:1px solid rgba(245,166,35,.08);
    bottom:-100px;right:-60px;
}
.logo-wrap{position:relative;z-index:1;margin-bottom:18px;}
.logo-wrap img{height:74px;width:auto;filter:drop-shadow(0 6px 16px rgba(0,0,0,.3));}
.header-title{font-size:1.5rem;font-weight:800;color:#fff;line-height:1.2;margin-bottom:6px;position:relative;z-index:1;}
.header-title em{color:#f5a623;font-style:italic;}
.header-sub{font-size:13px;color:rgba(255,255,255,.65);position:relative;z-index:1;}

.card-body{padding:42px 40px 32px;}

.form-eyebrow{font-size:11px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#f5a623;margin-bottom:6px;}
.form-heading{font-size:1.7rem;font-weight:800;color:#1a3a6e;margin-bottom:30px;}

.alert{display:flex;align-items:flex-start;gap:10px;padding:12px 16px;border-radius:12px;font-size:13px;margin-bottom:20px;}
.alert-danger{background:#fff1f2;border:1px solid #fecdd3;color:#be123c;}
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d;}

.field{margin-bottom:22px;}
.field-label{display:block;font-size:11px;font-weight:700;color:#64748b;margin-bottom:8px;letter-spacing:.8px;text-transform:uppercase;}
.field-wrap{position:relative;}
.field-icon{position:absolute;left:15px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:14px;pointer-events:none;transition:color .2s;}
.field-wrap:focus-within .field-icon{color:#1a3a6e;}
.field-wrap input{
    width:100%;padding:14px 14px 14px 44px;
    background:#f1f5f9;border:2px solid transparent;border-radius:12px;
    font-size:14px;font-family:'Plus Jakarta Sans',sans-serif;
    color:#1e293b;outline:none;transition:all .25s;
}
.field-wrap input::placeholder{color:#94a3b8;}
.field-wrap input:focus{background:#fff;border-color:#1a3a6e;box-shadow:0 0 0 4px rgba(26,58,110,.08);}
.field-wrap input.is-invalid{border-color:#f43f5e;background:#fff1f2;}
.err-msg{font-size:12px;color:#f43f5e;margin-top:5px;}
.pw-toggle{position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;font-size:14px;transition:color .2s;}
.pw-toggle:hover{color:#1a3a6e;}

.options-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:26px;}
.check-label{display:flex;align-items:center;gap:8px;font-size:13.5px;color:#475569;cursor:pointer;}
.check-label input{width:16px;height:16px;accent-color:#1a3a6e;cursor:pointer;}
.forgot-link2{font-size:13px;color:#0d9488;font-weight:700;text-decoration:none;}

.btn-submit{
    width:100%;padding:16px;
    background:linear-gradient(135deg,#1a3a6e,#2d5aa0);
    color:#fff;border:none;border-radius:12px;
    font-size:14px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;
    letter-spacing:1px;text-transform:uppercase;
    cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;
    transition:all .25s;box-shadow:0 6px 20px rgba(26,58,110,.35);
}
.btn-submit:hover{background:linear-gradient(135deg,#0d2240,#1a3a6e);transform:translateY(-2px);box-shadow:0 10px 28px rgba(26,58,110,.45);}
.btn-submit:active{transform:translateY(0);}

.register-row{text-align:center;margin-top:20px;font-size:13.5px;color:#64748b;}
.register-row a{color:#2563eb;font-weight:700;text-decoration:none;}
.register-row a:hover{color:#1a3a6e;}

.card-footer{text-align:center;padding:20px 40px 32px;font-size:11.5px;color:#94a3b8;line-height:1.6;}

@media(max-width:480px){
    body{padding:16px;}
    .card{border-radius:20px;}
    .card-header{padding:34px 24px 30px;}
    .card-body{padding:32px 24px 24px;}
    .form-heading{font-size:1.45rem;}
    .card-footer{padding:16px 24px 24px;}
}
</style>
</head>
<body>

<div class="bg-circle bg-circle-1"></div>
<div class="bg-circle bg-circle-2"></div>
<div class="bg-circle bg-circle-3"></div>

<div class="card">
    <div class="card-stripe"></div>

    <div class="card-header">
        <div class="logo-wrap">
            <img src="{{ asset('images/logo-tolikara.png') }}" alt="Logo DISPERINDAGKOP">
        </div>
        <h1 class="header-title">DISPERINDAGKOP <em>Kab. Tolikara</em></h1>
        <p class="header-sub">Sistem Informasi Perindustrian, Perdagangan & Koperasi</p>
    </div>

    <div class="card-body">
        <p class="form-eyebrow">Portal Sistem</p>
        <h2 class="form-heading">Silahkan Login</h2>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="field">
                <label class="field-label">📧 Email</label>
                <div class="field-wrap">
                    <span class="field-icon">✉️</span>
                    <input type="email" id="email" name="email"
                           class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                           placeholder="nama@tolikara.go.id"
                           value="{{ old('email') }}"
                           autocomplete="email" autofocus>
                </div>
                @error('email')
                <div class="err-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="field">
                <label class="field-label">🔒 Password</label>
                <div class="field-wrap">
                    <span class="field-icon">🔐</span>
                    <input type="password" id="password" name="password"
                           class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                           placeholder="Masukkan password Anda"
                           autocomplete="current-password">
                    <button type="button" class="pw-toggle" onclick="togglePw()">
                        <span id="pw-icon">👁️</span>
                    </button>
                </div>
                @error('password')
                <div class="err-msg">{{ $message }}</div>
                @enderror
            </div>

            <div class="options-row">
                <label class="check-label">
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    Ingat saya
                </label>
                <a href="{{ route('password.request') }}" class="forgot-link2">Lupa password?</a>
            </div>

            <button type="submit" class="btn-submit">
                ➡️ Login Sekarang
            </button>
        </form>

        <div class="register-row">
            Belum punya akun? <a href="{{ route('register') }}">Register</a>
        </div>
    </div>

    <div class="card-footer">
        &copy; {{ date('Y') }} Dinas Perindustrian, Perdagangan, dan Koperasi &mdash; Kabupaten Tolikara
    </div>
</div>

<script>
function togglePw(){
    const pw = document.getElementById('password');
    const ic = document.getElementById('pw-icon');
    if(pw.type === 'password'){
        pw.type = 'text';
        ic.textContent = '🙈';
    } else {
        pw.type = 'password';
        ic.textContent = '👁️';
    }
}
</script>
</body>
</html>
