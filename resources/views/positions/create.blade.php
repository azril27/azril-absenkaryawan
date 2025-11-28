@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-briefcase"></i> Tambah Jabatan Baru
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle"></i> <strong>Terjadi Kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="/positions" method="POST" novalidate>
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="form-label">
                            <i class="bi bi-briefcase"></i> Nama Jabatan <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Contoh: Manager, Developer, Designer" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">
                            <i class="bi bi-file-text"></i> Deskripsi
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Deskripsi tugas dan tanggung jawab jabatan ini">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-3 mt-5">
                        <button type="submit" class="btn btn-success flex-grow-1">
                            <i class="bi bi-check-circle"></i> Simpan Jabatan
                        </button>
                        <a href="/positions" class="btn btn-secondary flex-grow-1">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
