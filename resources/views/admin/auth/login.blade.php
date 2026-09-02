<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — DPA Corp</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css'])
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #0f1f4a 0%, #1a3a6e 40%, #0d2847 100%);
            display: flex; align-items: center; justify-content: center;
            padding: 20px;
        }
        body::before {
            content: '';
            position: fixed; inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.02'%3E%3Ccircle cx='30' cy='30' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }
        .login-box {
            background: rgba(255,255,255,.97);
            border-radius: 20px;
            padding: 44px 40px;
            width: 100%; max-width: 420px;
            box-shadow: 0 25px 60px rgba(0,0,0,.4);
        }
        .login-logo { text-align: center; margin-bottom: 32px; }
        .login-logo .brand { font-size: 28px; font-weight: 800; color: #1a3a6e; letter-spacing: -0.5px; }
        .login-logo .brand span { color: #e8a020; }
        .login-logo .subtitle { font-size: 13px; color: #64748b; margin-top: 4px; }
        .form-group { margin-bottom: 18px; }
        .form-label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; color: #1e293b; }
        .form-control {
            width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0;
            border-radius: 10px; font-size: 14px; color: #1e293b;
            outline: none; transition: all .2s; font-family: 'Inter', sans-serif;
        }
        .form-control:focus { border-color: #1a3a6e; box-shadow: 0 0 0 3px rgba(26,58,110,.1); }
        .form-control.is-invalid { border-color: #ef4444; }
        .error-msg { font-size: 12px; color: #ef4444; margin-top: 5px; }
        .btn-login {
            width: 100%; padding: 12px; background: linear-gradient(135deg, #1a3a6e, #2952a3);
            color: #fff; border: none; border-radius: 10px; font-size: 15px;
            font-weight: 600; cursor: pointer; transition: all .2s; margin-top: 8px;
            font-family: 'Inter', sans-serif;
        }
        .btn-login:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(26,58,110,.3); }
        .btn-login:active { transform: translateY(0); }
        .remember { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #475569; margin-bottom: 4px; }
        .remember input { width: 15px; height: 15px; accent-color: #1a3a6e; }
        .divider { text-align: center; font-size: 11px; color: #94a3b8; margin: 20px 0 0; }
    </style>
</head>
<body>
<div class="login-box">
    <div class="login-logo">
        <div class="brand">DPA <span>Corp</span></div>
        <div class="subtitle">Panel Administrasi — Akses Terbatas</div>
    </div>

    @if($errors->has('email'))
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '{{ $errors->first("email") }}',
                confirmButtonColor: '#1a3a6e',
                borderRadius: '14px',
            });
        });
        </script>
    @endif

    <form action="{{ route('cp.login.post') }}" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                   value="{{ old('email') }}" placeholder="admin@dpacorp.id" required autofocus>
        </div>
        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control"
                   placeholder="••••••••" required>
        </div>
        <div class="remember">
            <input type="checkbox" id="remember" name="remember" value="1">
            <label for="remember">Ingat saya</label>
        </div>
        <button type="submit" class="btn-login">Masuk ke Panel</button>
    </form>
    <div class="divider">PT Dharma Putra Airlangga © {{ date('Y') }}</div>
</div>
</body>
</html>
