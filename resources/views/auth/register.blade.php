<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar Akun | DISPERINDAGKOP Tolikara</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
:root {
    --navy: #0d2240;
    --blue: #1a3a6e;
    --gold: #f5a623;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    min-height: 100vh;
    background: linear-gradient(135deg, #0d2240 0%, #1a3a6e 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    position: relative;
    overflow: hidden;
}

body::before {
    content: '';
    position: absolute;
    width: 500px;
    height: 500px;
    border-radius: 50%;
    background: rgba(245, 166, 35, 0.08);
    top: -200px;
    right: -150px;
    animation: float 8s ease-in-out infinite;
}

body::after {
    content: '';
    position: absolute;
    width: 400px;
    height: 400px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.05);
    bottom: -150px;
    left: -100px;
    animation: float 10s ease-in-out infinite reverse;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-30px); }
}

.register-container {
    background: white;
    border-radius: 24px;
    width: 100%;
    max-width: 480px;
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
    overflow: hidden;
    position: relative;
    z-index: 1;
    animation: slideUp 0.6s ease-out;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.register-header {
    background: linear-gradient(135deg, #0d2240 0%, #1a3a6e 100%);
    padding: 40px 40px 50px;
    text-align: center;
    position: relative;
}

.register-header::after {
    content: '';
    position: absolute;
    bottom: -1px;
    left: 0;
    right: 0;
    height: 40px;
    background: white;
    clip-path: ellipse(60% 100% at 50% 100%);
}

.logo-circle {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #f5a623, #ffb800);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    box-shadow: 0 10px 30px rgba(245, 166, 35, 0.4);
    position: relative;
    z-index: 1;
}

.logo-circle i {
    font-size: 2.5rem;
    color: white;
}

.register-header h1 {
    font-size: 1.8rem;
    font-weight: 800;
    color: white;
    margin-bottom: 8px;
    position: relative;
    z-index: 1;
}

.register-header p {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.7);
    position: relative;
    z-index: 1;
}

.register-body {
    padding: 40px 40px 35px;
}

.alert-danger {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    padding: 14px 16px;
    border-radius: 12px;
    font-size: 13px;
    margin-bottom: 24px;
    background: #fff1f2;
    border: 1px solid #fecdd3;
    color: #be123c;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: #475569;
    margin-bottom: 8px;
    letter-spacing: 0.3px;
}

.input-wrapper {
    position: relative;
}

.input-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #94a3b8;
    font-size: 14px;
    pointer-events: none;
    transition: color 0.3s;
}

.input-wrapper:focus-within .input-icon {
    color: var(--blue);
}

.form-control {
    width: 100%;
    padding: 14px 16px 14px 45px;
    background: #f8fafc;
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #1e293b;
    outline: none;
    transition: all 0.3s;
}

.form-control:focus {
    background: white;
    border-color: var(--blue);
    box-shadow: 0 0 0 4px rgba(26, 58, 110, 0.08);
}

.form-control.is-invalid {
    border-color: #f43f5e;
    background: #fff1f2;
}

.password-toggle {
    position: absolute;
    right: 14px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: #94a3b8;
    font-size: 14px;
    padding: 8px;
    transition: color 0.3s;
}

.password-toggle:hover {
    color: var(--blue);
}

.error-message {
    font-size: 12px;
    color: #f43f5e;
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.btn-register {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, var(--blue), #2451a3);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 700;
    font-family: 'Plus Jakarta Sans', sans-serif;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.3s;
    box-shadow: 0 8px 20px rgba(26, 58, 110, 0.3);
    margin-top: 8px;
}

.btn-register:hover {
    background: linear-gradient(135deg, var(--navy), var(--blue));
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(26, 58, 110, 0.4);
}

.btn-register:active {
    transform: translateY(0);
}

.login-link {
    text-align: center;
    margin-top: 24px;
    padding-top: 24px;
    border-top: 1px solid #e2e8f0;
    font-size: 14px;
    color: #64748b;
}

.login-link a {
    color: var(--blue);
    font-weight: 700;
    text-decoration: none;
    transition: color 0.3s;
}

.login-link a:hover {
    color: var(--gold);
}

@media (max-width: 600px) {
    .register-container {
        border-radius: 20px;
    }
    
    .register-header {
        padding: 30px 24px 40px;
    }
    
    .register-header h1 {
        font-size: 1.5rem;
    }
    
    .register-body {
        padding: 30px 24px 28px;
    }
    
    .logo-circle {
        width: 70px;
        height: 70px;
    }
    
    .logo-circle i {
        font-size: 2rem;
    }
}
</style>
</head>
<body>

<div class="register-container">
    <div class="register-header">
      <div class="card">
    <div class="card-stripe"></div>

    <div class="card-header">
        <div class="header-logo"><img src="{{ asset('images/logo.login.png') }}" alt="Logo Tolikara" style="height:60px;width:auto;"></div>
       
    </div>
        </div>
        <h1>DAFTAR AKUN</h1>
        <p>Daftarkan Koperasi Anda di DISPERINDAGKOP Tolikara</p>
    </div>

    <div class="register-body">
        @if($errors->any())
        <div class="alert-danger">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <div class="input-wrapper">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" 
                           name="name" 
                           class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" 
                           placeholder="Masukkan nama lengkap Anda" 
                           value="{{ old('name') }}" 
                           required 
                           autofocus>
                </div>
                @error('name')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" 
                           name="email" 
                           class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                           placeholder="email@contoh.com" 
                           value="{{ old('email') }}" 
                           required>
                </div>
                @error('email')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                           placeholder="Minimal 8 karakter" 
                           required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password', 'icon1')">
                        <i class="fas fa-eye" id="icon1"></i>
                    </button>
                </div>
                @error('password')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           class="form-control" 
                           placeholder="Ulangi password Anda" 
                           required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'icon2')">
                        <i class="fas fa-eye" id="icon2"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-register">
                <i class="fas fa-user-plus"></i>
                REGISTER
            </button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>

</body>
</html>
