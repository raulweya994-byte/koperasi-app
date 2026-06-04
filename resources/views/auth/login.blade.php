<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | {{ app_name() }}</title>
<link rel="icon" type="image/png" href="{{ app_favicon() }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
:root{
    --navy:{{ theme_color('primary') }};
    --blue:{{ theme_color('secondary') }};
    --red:{{ theme_color('danger') }};
    --gold:{{ theme_color('warning') }};
    --white:#fff;
    --gray-50:#f8fafc;
    --gray-200:#e2e8f0;
    --gray-400:#94a3b8;
    --gray-600:#475569;
    --gray-800:#1e293b;
}
*{margin:0;padding:0;box-sizing:border-box;}
body{
    font-family:'Plus Jakarta Sans',sans-serif;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
    background:linear-gradient(135deg,#0d2240 0%,#1a3a6e 50%,#0d2240 100%);
    position:relative;
    overflow:hidden;
}
/* Background decorations */
body::before{content:'';position:fixed;width:700px;height:700px;border-radius:50%;border:1px solid rgba(255,255,255,.05);top:-200px;left:-200px;pointer-events:none;}
body::after{content:'';position:fixed;width:500px;height:500px;border-radius:50%;border:1px solid rgba(245,166,35,.08);bottom:-150px;right:-100px;pointer-events:none;}
.ring{position:fixed;border-radius:50%;pointer-events:none;}
.ring-1{width:400px;height:400px;border:1px solid rgba(255,255,255,.04);top:50%;left:50%;transform:translate(-50%,-50%);}
.ring-2{width:650px;height:650px;border:1px solid rgba(245,166,35,.05);top:50%;left:50%;transform:translate(-50%,-50%);}
.ring-3{width:900px;height:900px;border:1px solid rgba(255,255,255,.03);top:50%;left:50%;transform:translate(-50%,-50%);}

/* CARD */
.card{
    background:var(--white);
    border-radius:24px;
    width:100%;
    max-width:460px;
    box-shadow:0 30px 80px rgba(0,0,0,.4);
    overflow:hidden;
    position:relative;
    z-index:10;
    animation:fadeUp .5s ease both;
}
@keyframes fadeUp{from{opacity:0;transform:translateY(24px);}to{opacity:1;transform:translateY(0);}}

/* Top stripe */
.card-stripe{height:4px;background:linear-gradient(90deg,var(--blue),var(--gold),var(--red));}

/* Card header */
.card-header{
    background:linear-gradient(135deg,var(--navy),var(--blue));
    padding:36px 40px 32px;
    text-align:center;
    position:relative;
    overflow:hidden;
}
.card-header::before{content:'';position:absolute;width:300px;height:300px;border-radius:50%;border:1px solid rgba(255,255,255,.06);top:-100px;left:-80px;}
.card-header::after{content:'';position:absolute;width:200px;height:200px;border-radius:50%;border:1px solid rgba(245,166,35,.1);bottom:-80px;right:-50px;}
.header-logo{
    width:64px;height:64px;
    background:linear-gradient(135deg,var(--gold),#fdb944);
    border-radius:18px;
    display:flex;align-items:center;justify-content:center;
    margin:0 auto 16px;
    box-shadow:0 8px 24px rgba(245,166,35,.35);
    position:relative;z-index:1;
}
.header-logo i{font-size:26px;color:var(--navy);}
.header-title{
    font-family:'DM Serif Display',serif;
    font-size:1.5rem;color:var(--white);
    line-height:1.2;margin-bottom:6px;
    position:relative;z-index:1;
}
.header-title em{color:var(--gold);font-style:italic;}
.header-sub{font-size:12px;color:rgba(255,255,255,.5);position:relative;z-index:1;}

/* Card body */
.card-body{padding:36px 40px;}

.form-eyebrow{font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--gold);margin-bottom:6px;}
.form-heading{font-size:1.4rem;font-weight:800;color:var(--navy);margin-bottom:24px;}

/* Alert */
.alert{display:flex;align-items:flex-start;gap:10px;padding:12px 14px;border-radius:10px;font-size:13px;margin-bottom:20px;}
.alert-danger{background:#fff1f2;border:1px solid #fecdd3;color:#be123c;}
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#15803d;}

/* Field */
.field{margin-bottom:18px;}
.field-label{display:block;font-size:11.5px;font-weight:700;color:var(--gray-600);margin-bottom:7px;letter-spacing:.5px;text-transform:uppercase;}
.field-wrap{position:relative;}
.field-icon{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--gray-400);font-size:14px;pointer-events:none;transition:color .2s;}
.field-wrap:focus-within .field-icon{color:var(--blue);}
.field-wrap input{width:100%;padding:12px 14px 12px 40px;background:var(--gray-50);border:2px solid var(--gray-200);border-radius:10px;font-size:14px;font-family:'Plus Jakarta Sans',sans-serif;color:var(--gray-800);outline:none;transition:all .2s;}
.field-wrap input::placeholder{color:var(--gray-400);}
.field-wrap input:focus{background:var(--white);border-color:var(--blue);box-shadow:0 0 0 4px rgba(26,58,110,.07);}
.field-wrap input.is-invalid{border-color:#f43f5e;background:#fff1f2;}
.err-msg{font-size:12px;color:#f43f5e;margin-top:5px;display:flex;align-items:center;gap:4px;}
.pw-toggle{position:absolute;right:13px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:var(--gray-400);font-size:14px;transition:color .2s;}
.pw-toggle:hover{color:var(--blue);}

.options-row{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;}
.check-label{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--gray-600);cursor:pointer;}
.check-label input{width:15px;height:15px;accent-color:var(--blue);cursor:pointer;}
.link-blue{font-size:13px;color:var(--blue);font-weight:600;text-decoration:none;}
.link-blue:hover{color:var(--gold);}

.btn-submit{width:100%;padding:14px;background:linear-gradient(135deg,var(--blue),#2451a3);color:var(--white);border:none;border-radius:11px;font-size:14px;font-weight:700;font-family:'Plus Jakarta Sans',sans-serif;letter-spacing:.8px;text-transform:uppercase;cursor:pointer;display:flex;align-items:center;justify-content:center;gap:10px;transition:all .25s;box-shadow:0 4px 16px rgba(26,58,110,.3);}
.btn-submit:hover{background:linear-gradient(135deg,var(--navy),var(--blue));transform:translateY(-1px);box-shadow:0 6px 22px rgba(26,58,110,.4);}
.btn-submit:active{transform:translateY(0);}

.register-row{text-align:center;margin-top:16px;font-size:13px;color:var(--gray-400);}
.register-row a{color:var(--blue);font-weight:700;text-decoration:none;}
.register-row a:hover{color:var(--gold);}


/* Footer */
.card-footer{text-align:center;padding:0 40px 24px;font-size:11px;color:var(--gray-400);}
</style>
</head>
<body>

<div class="ring ring-1"></div>
<div class="ring ring-2"></div>
<div class="ring ring-3"></div>

<div class="card">
    <div class="card-stripe"></div>

    <div class="card-header">
        <div class="header-logo"><img src="{{ app_logo_login() }}" alt="Logo {{ app_name() }}" style="height:60px;width:auto;"></div>
        <h1 class="header-title">{{ app_name() }} <em>{{ setting('app_short_name', 'Tolikara') }}</em></h1>
        <p class="header-sub">{{ setting('app_description', 'Sistem Informasi Manajemen Koperasi') }}</p>
    </div>

    <div class="card-body">
        <p class="form-eyebrow">Portal Sistem</p>
        <h2 class="form-heading">Masuk ke Akun</h2>

        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i><span>{{ session('success') }}</span></div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i><span>{{ $errors->first() }}</span></div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="field">
                <label class="field-label" for="email">Email</label>
                <div class="field-wrap">
                    <i class="fas fa-envelope field-icon"></i>
                    <input type="email" id="email" name="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="nama@disperindagkop.go.id" value="{{ old('email') }}" autocomplete="email" autofocus>
                </div>
                @error('email')<div class="err-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
            <div class="field">
                <label class="field-label" for="password">Password</label>
                <div class="field-wrap">
                    <i class="fas fa-lock field-icon"></i>
                    <input type="password" id="password" name="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Masukkan password Anda" autocomplete="current-password">
                    <button type="button" class="pw-toggle" onclick="togglePw()"><i class="fas fa-eye" id="pw-icon"></i></button>
                </div>
                @error('password')<div class="err-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
            <div class="options-row">
                <label class="check-label"><input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ingat saya</label>
                <a href="{{ route('pendaftaran.landing') }}" class="link-blue">
                    <i class="fas fa-user-plus mr-1"></i> 
                </a>
            </div>
            <button type="submit" class="btn-submit"><i class="fas fa-sign-in-alt"></i> Masuk Sekarang</button>
        </form>
        <div class="register-row">
            Belum punya akun? 
            <a href="{{ route('pendaftaran.landing') }}">Lupa password</a>
        </div>


    </div>

    <div class="card-footer">&copy; {{ date('Y') }} Dinas Perindustrian, Perdagangan, Koperasi &amp; Koperasi &mdash; Kabupaten Tolikara</div>
</div>

<script>
function togglePw(){const pw=document.getElementById('password'),ic=document.getElementById('pw-icon');if(pw.type==='password'){pw.type='text';ic.classList.replace('fa-eye','fa-eye-slash');}else{pw.type='password';ic.classList.replace('fa-eye-slash','fa-eye');}}
function fillLogin(e,p){const eEl=document.getElementById('email'),pEl=document.getElementById('password');eEl.value=e;pEl.value=p;[eEl,pEl].forEach(el=>{el.style.background='#eff6ff';el.style.borderColor='#1a3a6e';setTimeout(()=>{el.style.background='';el.style.borderColor='';},900);});}
</script>
</body>
</html>
