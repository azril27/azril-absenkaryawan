@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title mb-0"><i class="bi bi-list-check"></i> Kelola Absensi</h1>
    </div>
    <a href="/admin/attendance" class="btn btn-secondary">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Filter Section -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-funnel"></i> Filter Absensi
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label for="date" class="form-label"><i class="bi bi-calendar"></i> Tanggal</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="employee_id" class="form-label"><i class="bi bi-person"></i> Karyawan</label>
                        <select class="form-select" id="employee_id" name="employee_id">
                            <option value="">-- Semua Karyawan --</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ request('employee_id') == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="status" class="form-label"><i class="bi bi-tag"></i> Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="">-- Semua Status --</option>
                            <option value="hadir" {{ request('status') == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="sakit" {{ request('status') == 'sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="izin" {{ request('status') == 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="alfa" {{ request('status') == 'alfa' ? 'selected' : '' }}>Alfa</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-table"></i> Data Absensi
                <span class="badge bg-primary ms-2">{{ $attendances->total() }} data</span>
            </div>
            <div class="card-body">
                @if($attendances->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-hash"></i> #</th>
                                    <th><i class="bi bi-person"></i> Nama</th>
                                    <th><i class="bi bi-calendar"></i> Tanggal</th>
                                    <th><i class="bi bi-clock"></i> Check-In</th>
                                    <th><i class="bi bi-clock"></i> Check-Out</th>
                                    <th><i class="bi bi-tag"></i> Status</th>
                                    <th><i class="bi bi-gear"></i> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($attendances as $key => $attendance)
                                <tr>
                                    <td><strong>#{{ $key + 1 }}</strong></td>
                                    <td>{{ $attendance->employee->name }}</td>
                                    <td>{{ $attendance->attendance_date->format('d M Y') }}</td>
                                    <td>
                                        @if($attendance->check_in_time)
                                            <span style="color: #38ef7d; font-weight: 600;">{{ $attendance->check_in_time->format('H:i') }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($attendance->check_out_time)
                                            <span style="color: #667eea; font-weight: 600;">{{ $attendance->check_out_time->format('H:i') }}</span>
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
                                    <td>
                                        <a href="/admin/attendance/{{ $attendance->id }}/edit" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="/admin/attendance/{{ $attendance->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?');">
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
                    <div class="mt-4">
                        {{ $attendances->links() }}
                    </div>
                @else
                    <div class="alert alert-info text-center" role="alert">
                        <i class="bi bi-info-circle"></i> Tidak ada data absensi
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
