<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Absensi Karyawan</title>
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
            padding: 2rem 0;
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

        .register-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 500px;
        }

        .register-card {
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

        .register-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
        }

        .register-header .logo {
            font-size: 2.5rem;
            margin-bottom: 0.8rem;
        }

        .register-header h1 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 0.3rem;
        }

        .register-header p {
            font-size: 0.9rem;
            opacity: 0.9;
            margin: 0;
        }

        .register-body {
            padding: 2rem;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 0.7rem 1rem;
            font-size: 0.9rem;
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
            margin-top: 0.3rem;
            display: block;
            font-size: 0.85rem;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            width: 100%;
            margin-top: 1.5rem;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .register-footer {
            text-align: center;
            padding: 1.2rem 2rem;
            border-top: 1px solid #f0f0f0;
            background: #f8f9fa;
        }

        .register-footer p {
            color: #666;
            margin: 0;
            font-size: 0.9rem;
        }

        .register-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .register-footer a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .alert {
            border: none;
            border-radius: 10px;
            border-left: 4px solid;
            animation: slideIn 0.3s ease;
            font-size: 0.9rem;
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

        .password-info {
            background: #f0f4ff;
            border-left: 3px solid #667eea;
            padding: 0.8rem 1rem;
            border-radius: 5px;
            font-size: 0.85rem;
            color: #666;
            margin-top: 0.5rem;
        }

        @media (max-width: 600px) {
            .register-card {
                border-radius: 15px;
                margin: 1rem;
            }

            .register-header {
                padding: 1.8rem 1.5rem;
            }

            .register-header .logo {
                font-size: 2rem;
            }

            .register-header h1 {
                font-size: 1.3rem;
            }

            .register-body {
                padding: 1.5rem;
            }

            .register-footer {
                padding: 1.2rem 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="logo">
                    <i class="bi bi-person-plus"></i>
                </div>
                <h1>Daftar Akun</h1>
                <p>Buat akun baru Anda</p>
            </div>

            @if($errors->any())
                <div style="padding: 1.2rem 2rem 0;">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle"></i> 
                        <strong>Gagal!</strong>
                        <ul class="mb-0 mt-2" style="font-size: 0.85rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                    </div>
                </div>
            @endif

            <form method="POST" action="/register" class="register-body">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">
                        <i class="bi bi-person"></i> Nama Lengkap
                    </label>
                    <input 
                        type="text" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" 
                        name="name" 
                        placeholder="Masukkan nama lengkap Anda"
                        value="{{ old('name') }}"
                        required
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

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
                        placeholder="Minimal 6 karakter"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="password-info">
                        <i class="bi bi-info-circle"></i> Password minimal 6 karakter
                    </div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        <i class="bi bi-lock-check"></i> Konfirmasi Password
                    </label>
                    <input 
                        type="password" 
                        class="form-control @error('password_confirmation') is-invalid @enderror" 
                        id="password_confirmation" 
                        name="password_confirmation" 
                        placeholder="Ulang password Anda"
                        required
                    >
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-register">
                    <i class="bi bi-person-check"></i> Daftar
                </button>
            </form>

            <div class="register-footer">
                <p>Sudah punya akun? <a href="/login">Login di sini</a></p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
