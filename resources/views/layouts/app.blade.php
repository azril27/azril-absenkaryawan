<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi Karyawan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            position: relative;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="1200" height="600" fill="url(%23grid)"/></svg>');
            pointer-events: none;
            z-index: 0;
        }

        .navbar {
            background: rgba(20, 20, 50, 0.95) !important;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid rgba(102, 126, 234, 0.5);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: 0.5px;
        }

        .navbar-nav .nav-link {
            color: #e0e0e0 !important;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            margin: 0 0.3rem;
            border-radius: 8px;
        }

        .navbar-nav .nav-link:hover {
            background: rgba(102, 126, 234, 0.2);
            color: #fff !important;
            transform: translateY(-2px);
        }

        .container {
            margin-top: 40px;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            margin-bottom: 25px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
            color: white !important;
            border: none;
            padding: 1.5rem;
            font-weight: 600;
        }

        .card-body {
            padding: 2rem;
        }

        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8f9fa;
            color: #333;
            font-weight: 600;
            border-bottom: 2px solid #667eea;
            padding: 1rem;
        }

        .table tbody tr {
            transition: all 0.2s ease;
            border-bottom: 1px solid #f0f0f0;
        }

        .table tbody tr:hover {
            background-color: #f8f9ff;
            transform: scale(1.01);
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
        }

        .badge {
            padding: 0.6rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
            padding: 0.6rem 1.2rem;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #38ef7d 0%, #11998e 100%);
            transform: translateY(-2px);
        }

        .btn-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white !important;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
            transform: translateY(-2px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white !important;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #fee140 0%, #fa709a 100%);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #a8a8a8 0%, #686868 100%);
        }

        .btn-secondary:hover {
            background: linear-gradient(135deg, #686868 0%, #a8a8a8 100%);
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 0.5rem 0.8rem;
            font-size: 0.85rem;
        }

        .alert {
            border: none;
            border-radius: 10px;
            font-weight: 500;
            animation: slideIn 0.3s ease;
        }

        .alert-success {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
            border-left: 4px solid #11998e;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            color: white;
            border-left: 4px solid #fa709a;
        }

        .alert-info {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-left: 4px solid #667eea;
        }

        .btn-close {
            filter: brightness(0) invert(1);
        }

        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .is-invalid {
            border-color: #fa709a !important;
        }

        .invalid-feedback {
            color: #fa709a;
            font-weight: 500;
        }

        .stat-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0.9) 100%);
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        }

        .stat-card .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .stat-card .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-card .stat-label {
            color: #666;
            font-weight: 600;
            margin-top: 0.5rem;
            font-size: 1rem;
        }

        .page-title {
            color: white;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
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

        .footer {
            text-align: center;
            padding: 2rem;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 4rem;
            position: relative;
            z-index: 1;
        }

        .breadcrumb {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 2rem;
        }

        .breadcrumb-item {
            color: rgba(255, 255, 255, 0.7);
        }

        .breadcrumb-item.active {
            color: white;
            font-weight: 600;
        }

        .text-danger {
            color: #fa709a !important;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.8rem;
            }

            .container {
                margin-top: 20px;
            }

            .card-body {
                padding: 1rem;
            }

            .btn {
                padding: 0.5rem 0.8rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="bi bi-calendar-check"></i> Sistem Absensi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="bi bi-house"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/employees"><i class="bi bi-people"></i> Karyawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/positions"><i class="bi bi-briefcase"></i> Jabatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/users"><i class="bi bi-person-circle"></i> User</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="absensiDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-clock"></i> Absensi
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="absensiDropdown">
                            <li><a class="dropdown-item" href="/attendance/check-in"><i class="bi bi-clock"></i> Check-In</a></li>
                            <li><a class="dropdown-item" href="/admin/attendance"><i class="bi bi-graph-up"></i> Dashboard</a></li>
                            <li><a class="dropdown-item" href="/admin/attendance/list"><i class="bi bi-list-ul"></i> Kelola Data</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <div class="footer">
        <p>&copy; 2025 Azril.my.web.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>