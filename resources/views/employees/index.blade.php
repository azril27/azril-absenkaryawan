@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title mb-0"><i class="bi bi-people"></i> Manajemen Karyawan</h1>
    </div>
    <div style="display: flex; gap: 0.5rem;">
        <a href="/employees/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Karyawan
        </a>
        <a href="/employees/export/csv" class="btn btn-success" title="Export CSV">
            <i class="bi bi-download"></i> CSV
        </a>
        <a href="/employees/export/json" class="btn btn-info" title="Export JSON">
            <i class="bi bi-download"></i> JSON
        </a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<!-- Search & Filter Row -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form method="GET" action="/employees" class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label"><i class="bi bi-search"></i> Cari</label>
                        <input type="text" name="search" class="form-control" placeholder="Cari nama, email, atau posisi..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label"><i class="bi bi-filter"></i> Filter Posisi</label>
                        <select name="position" class="form-select">
                            <option value="">-- Semua Posisi --</option>
                            @foreach($positions as $pos)
                                <option value="{{ $pos }}" {{ request('position') == $pos ? 'selected' : '' }}>
                                    {{ $pos }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3" style="display: flex; align-items: flex-end; gap: 0.5rem;">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                        <a href="/employees" class="btn btn-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </a>
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
                <i class="bi bi-list-ul"></i> Daftar Karyawan ({{ $employees->count() }})
            </div>
            <div class="card-body">
                @if($employees->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-hash"></i> #</th>
                                    <th>
                                        <a href="?sort=name&order={{ request('order') == 'asc' ? 'desc' : 'asc' }}&search={{ request('search') }}&position={{ request('position') }}" style="text-decoration: none; color: inherit;">
                                            <i class="bi bi-person"></i> Nama
                                            @if(request('sort') == 'name')
                                                <i class="bi {{ request('order') == 'asc' ? 'bi-arrow-up' : 'bi-arrow-down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
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
                                    <td><a href="tel:{{ $employee->phone }}" style="text-decoration: none; color: #667eea;">{{ $employee->phone }}</a></td>
                                    <td><span class="badge" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">{{ $employee->position }}</span></td>
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
                        <i class="bi bi-info-circle"></i> Tidak ada data karyawan yang sesuai. <a href="/employees/create" class="alert-link">Tambah karyawan baru</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection