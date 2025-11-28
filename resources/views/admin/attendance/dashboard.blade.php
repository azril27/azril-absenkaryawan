@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title mb-0"><i class="bi bi-pie-chart"></i> Admin Panel - Absensi</h1>
    </div>
    <a href="/admin/attendance/list" class="btn btn-primary">
        <i class="bi bi-list"></i> Kelola Absensi
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Date Filter -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-filter"></i> Filter Tanggal
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label for="date" class="form-label"><i class="bi bi-calendar"></i> Pilih Tanggal</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $dateFilter }}">
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Row -->
<div class="row mb-4">
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="color: #667eea;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-number">{{ $statistics['total_employees'] }}</div>
            <div class="stat-label">Total Karyawan</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="color: #38ef7d;">
                <i class="bi bi-check-circle-fill"></i>
            </div>
            <div class="stat-number">{{ $statistics['hadir'] }}</div>
            <div class="stat-label">Hadir</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="color: #f5576c;">
                <i class="bi bi-x-circle-fill"></i>
            </div>
            <div class="stat-number">{{ $statistics['alfa'] }}</div>
            <div class="stat-label">Alfa</div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="color: #f093fb;">
                <i class="bi bi-info-circle-fill"></i>
            </div>
            <div class="stat-number">{{ $statistics['izin'] + $statistics['sakit'] }}</div>
            <div class="stat-label">Izin/Sakit</div>
        </div>
    </div>
</div>

<!-- Attendance Table -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-table"></i> Daftar Karyawan yang Sudah Absen
                <span class="badge bg-primary ms-2">{{ $attendances->count() }} data</span>
            </div>
            <div class="card-body">
                @if($attendances->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-hash"></i> #</th>
                                    <th><i class="bi bi-person"></i> Nama</th>
                                    <th><i class="bi bi-briefcase"></i> Posisi</th>
                                    <th><i class="bi bi-clock"></i> Check-In</th>
                                    <th><i class="bi bi-clock"></i> Check-Out</th>
                                    <th><i class="bi bi-tag"></i> Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $key => $attendance)
                                <tr>
                                    <td><strong>#{{ $key + 1 }}</strong></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                {{ substr($attendance->employee->name, 0, 1) }}
                                            </div>
                                            <strong>{{ $attendance->employee->name }}</strong>
                                        </div>
                                    </td>
                                    <td><small class="text-muted">{{ $attendance->employee->position }}</small></td>
                                    <td>
                                        @if($attendance->check_in_time)
                                            <span style="color: #38ef7d; font-weight: 600;">{{ $attendance->check_in_time->format('H:i:s') }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($attendance->check_out_time)
                                            <span style="color: #667eea; font-weight: 600;">{{ $attendance->check_out_time->format('H:i:s') }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($attendance->status == 'hadir')
                                            <span class="badge bg-success">Hadir</span>
                                        @elseif($attendance->status == 'sakit')
                                            <span class="badge bg-warning text-dark">Sakit</span>
                                        @elseif($attendance->status == 'izin')
                                            <span class="badge bg-info">Izin</span>
                                        @else
                                            <span class="badge bg-danger">Alfa</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-info text-center" role="alert">
                        <i class="bi bi-info-circle"></i> Belum ada data absensi untuk tanggal {{ \Carbon\Carbon::parse($dateFilter)->format('d F Y') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
