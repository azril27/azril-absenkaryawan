@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div>
        <h1 class="page-title mb-0"><i class="bi bi-speedometer2"></i> Dashboard Karyawan</h1>
    </div>
    <div style="display: flex; gap: 0.5rem;">
        <a href="/employees/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Karyawan
        </a>
        <a href="/employees" class="btn btn-info">
            <i class="bi bi-list"></i> Lihat Semua
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Statistics Row -->
<div class="row mb-4">
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="color: #667eea;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-number">{{ $employees->count() }}</div>
            <div class="stat-label">Total Karyawan</div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="color: #38ef7d;">
                <i class="bi bi-briefcase-fill"></i>
            </div>
            <div class="stat-number">{{ $employees->pluck('position')->unique()->count() }}</div>
            <div class="stat-label">Posisi Tersedia</div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="color: #f5576c;">
                <i class="bi bi-envelope-fill"></i>
            </div>
            <div class="stat-number">{{ $employees->count() }}</div>
            <div class="stat-label">Email Terdaftar</div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-bar-chart"></i> Statistik Bulanan
            </div>
            <div class="card-body">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-table"></i> Daftar Karyawan Terbaru
            </div>
            <div class="card-body">
                @if($employees->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-hash"></i> #</th>
                                    <th><i class="bi bi-person"></i> Nama</th>
                                    <th><i class="bi bi-envelope"></i> Email</th>
                                    <th><i class="bi bi-telephone"></i> Telepon</th>
                                    <th><i class="bi bi-briefcase"></i> Posisi</th>
                                    <th><i class="bi bi-gear"></i> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employees->take(5) as $key => $employee)
                                <tr>
                                    <td><strong>#{{ $key + 1 }}</strong></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                {{ substr($employee->name, 0, 1) }}
                                            </div>
                                            <strong>{{ $employee->name }}</strong>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted">{{ $employee->email }}</small>
                                    </td>
                                    <td>
                                        <a href="tel:{{ $employee->phone }}" style="text-decoration: none; color: #667eea;">
                                            {{ $employee->phone }}
                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
                                            <i class="bi bi-briefcase"></i> {{ $employee->position }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="/employees/{{ $employee->id }}/edit" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="/employees/{{ $employee->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus karyawan ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div style="text-align: center; margin-top: 1rem;">
                        <a href="/employees" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-arrow-right"></i> Lihat Semua Karyawan
                        </a>
                    </div>
                @else
                    <div class="alert alert-info text-center" role="alert">
                        <i class="bi bi-info-circle"></i> Belum ada data karyawan. <a href="/employees/create" class="alert-link">Tambah karyawan baru</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    // Chart untuk Statistik Bulanan
    @if($employees->count() > 0)
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const monthlyData = {!! json_encode($employees->groupBy(function($item) { return $item->created_at->month; })->map->count()->pad(12, 0)) !!};
    
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: months,
            datasets: [{
                label: 'Jumlah Karyawan',
                data: monthlyData,
                backgroundColor: 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                borderColor: '#667eea',
                borderWidth: 2,
                borderRadius: 5,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: { size: 12, weight: 'bold' }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        font: { size: 11 }
                    }
                }
            }
        }
    });
    @endif
</script>
@endsection
