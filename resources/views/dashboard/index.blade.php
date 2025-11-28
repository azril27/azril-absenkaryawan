@extends('layouts.app')

@section('content')
<!-- Page Header -->
<div class="page-header">
    <div>
        <h1 class="page-title mb-0"><i class="bi bi-speedometer2"></i> Analytics</h1>
    </div>
    <a href="/employees/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Karyawan
    </a>
</div>

<!-- Statistics Row -->
<div class="row mb-4">
    <div class="col-md-6 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="color: #667eea;">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-number">{{ $statistics['total_employees'] }}</div>
            <div class="stat-label">Total Karyawan</div>
        </div>
    </div>
    <div class="col-md-6 mb-3">
        <div class="stat-card">
            <div class="stat-icon" style="color: #f5576c;">
                <i class="bi bi-briefcase-fill"></i>
            </div>
            <div class="stat-number">{{ $statistics['total_positions'] }}</div>
            <div class="stat-label">Total Posisi</div>
        </div>
    </div>
</div>

<!-- Search & Filter Section -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-funnel"></i> Pencarian & Filter
            </div>
            <div class="card-body">
                <form method="GET" class="row g-3">
                    <div class="col-md-6">
                        <label for="search" class="form-label"><i class="bi bi-search"></i> Cari Karyawan</label>
                        <input type="text" class="form-control" id="search" name="search" placeholder="Cari nama, email, atau telepon..." value="{{ $search ?? '' }}">
                    </div>
                    <div class="col-md-4">
                        <label for="position" class="form-label"><i class="bi bi-briefcase"></i> Filter Posisi</label>
                        <select class="form-select" id="position" name="position">
                            <option value="">-- Semua Posisi --</option>
                            @foreach($positions as $pos)
                                <option value="{{ $pos->name }}" {{ $filterPosition == $pos->name ? 'selected' : '' }}>
                                    {{ $pos->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </form>
                @if($search || $filterPosition)
                    <div class="mt-3">
                        <a href="/dashboard" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-x-circle"></i> Reset Filter
                        </a>
                        <span class="badge bg-info ms-2">
                            Ditemukan {{ $employees->count() }} hasil
                        </span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Position Distribution Chart -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-bar-chart"></i> Distribusi Karyawan Per Posisi
            </div>
            <div class="card-body">
                @if($statistics['employees_by_position']->count() > 0)
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                        @foreach($statistics['employees_by_position'] as $item)
                            <div style="padding: 1rem; background: #f8f9fa; border-radius: 10px; border-left: 4px solid #667eea;">
                                <div style="font-weight: 600; margin-bottom: 0.5rem;">{{ $item->position }}</div>
                                <div style="font-size: 1.5rem; color: #667eea; font-weight: 700;">{{ $item->count }}</div>
                                <div style="font-size: 0.85rem; color: #999; margin-top: 0.5rem;">
                                    {{ round(($item->count / $statistics['total_employees']) * 100, 1) }}% dari total
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-info">Belum ada data distribusi posisi</div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-table"></i> Daftar Karyawan
                @if($employees->count() > 0)
                    <span class="badge bg-primary ms-2">{{ $employees->count() }} data</span>
                @endif
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
                                @foreach($employees as $key => $employee)
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
                                    <td><small class="text-muted">{{ $employee->email }}</small></td>
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
                                        <form action="/employees/{{ $employee->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?');">
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
                @else
                    <div class="alert alert-info text-center" role="alert">
                        <i class="bi bi-info-circle"></i> 
                        @if($search || $filterPosition)
                            Tidak ditemukan data yang sesuai dengan filter.
                        @else
                            Belum ada data karyawan.
                        @endif
                        <a href="/employees/create" class="alert-link">Tambah karyawan baru</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
