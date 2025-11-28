<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Absensi Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="1200" height="600" fill="url(%23grid)"/></svg>');
            pointer-events: none;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            from { transform: translate(0, 0); }
            to { transform: translate(100px, 100px); }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 20px;
            box-shadow: 0 30px 90px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            backdrop-filter: blur(10px);
            animation: slideUp 0.5s ease;
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

        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }

        .login-header .logo {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-header p {
            font-size: 0.95rem;
            opacity: 0.9;
            margin: 0;
        }

        .login-body {
            padding: 2.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.6rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 0.8rem 1.2rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background-color: #f8f9ff;
        }

        .form-control.is-invalid {
            border-color: #fa709a;
        }

        .invalid-feedback {
            color: #fa709a;
            font-weight: 500;
            margin-top: 0.5rem;
            display: block;
        }

        .btn-login {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.9rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1rem;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .login-footer {
            text-align: center;
            padding: 1.5rem 2.5rem;
            border-top: 1px solid #f0f0f0;
            background: #f8f9fa;
        }

        .login-footer p {
            color: #666;
            margin: 0;
            font-size: 0.95rem;
        }

        .login-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-footer a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            border: none;
            border-radius: 10px;
            border-left: 4px solid;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            border-left-color: #11998e;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
            border-left-color: #fa709a;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-check {
            margin-top: 1rem;
        }

        .form-check-input {
            border: 2px solid #e0e0e0;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .form-check-input:checked {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-color: #667eea;
        }

        .form-check-label {
            cursor: pointer;
            user-select: none;
            color: #666;
            margin-left: 0.5rem;
        }

        @media (max-width: 600px) {
            .login-card {
                border-radius: 15px;
                margin: 1rem;
            }

            .login-header {
                padding: 2rem 1.5rem;
            }

            .login-header .logo {
                font-size: 2.5rem;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }

            .login-body {
                padding: 2rem;
            }

            .login-footer {
                padding: 1.5rem 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <i class="bi bi-calendar-check"></i>
                </div>
                <h1>Sistem Absensi</h1>
                <p>Manajemen Karyawan & Absensi</p>
            </div>

            @if($errors->any())
                <div style="padding: 1.5rem 2.5rem 0;">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle"></i> {{ $errors->first('email') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif

            @if(session('success'))
                <div style="padding: 1.5rem 2.5rem 0;">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif

            <form method="POST" action="/login" class="login-body">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope"></i> Email
                    </label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        placeholder="Masukkan email Anda"
                        value="{{ old('email') }}"
                        required 
                        autofocus
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock"></i> Password
                    </label>
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="password" 
                        name="password" 
                        placeholder="Masukkan password Anda"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        id="remember" 
                        name="remember"
                    >
                    <label class="form-check-label" for="remember">
                        Ingat saya
                    </label>
                </div>

                <button type="submit" class="btn btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>
            </form>

            <div class="login-footer">
                <p>Belum punya akun? <a href="/register">Daftar di sini</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
