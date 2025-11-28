@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title mb-0"><i class="bi bi-briefcase"></i> Manajemen Jabatan</h1>
    </div>
    <a href="/positions/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Jabatan
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-list-ul"></i> Daftar Jabatan
            </div>
            <div class="card-body">
                @if($positions->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th><i class="bi bi-hash"></i> #</th>
                                    <th><i class="bi bi-briefcase"></i> Nama Jabatan</th>
                                    <th><i class="bi bi-file-text"></i> Deskripsi</th>
                                    <th><i class="bi bi-gear"></i> Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($positions as $key => $position)
                                <tr>
                                    <td><strong>#{{ $key + 1 }}</strong></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            <div style="width: 35px; height: 35px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                                <i class="bi bi-briefcase"></i>
                                            </div>
                                            <strong>{{ $position->name }}</strong>
                                        </div>
                                    </td>
                                    <td><small class="text-muted">{{ $position->description ?? '-' }}</small></td>
                                    <td>
                                        <a href="/positions/{{ $position->id }}/edit" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="/positions/{{ $position->id }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?');">
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
                        <i class="bi bi-info-circle"></i> Belum ada data jabatan. <a href="/positions/create" class="alert-link">Tambah jabatan baru</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
