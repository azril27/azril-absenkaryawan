@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil-square"></i> Edit Data Karyawan
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

                <form action="/employees/{{ $employee->id }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="name" class="form-label">
                            <i class="bi bi-person"></i> Nama Lengkap <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name', $employee->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Masukkan email" value="{{ old('email', $employee->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="form-label">
                            <i class="bi bi-telephone"></i> Telepon <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="Masukkan nomor telepon" value="{{ old('phone', $employee->phone) }}" required>
                        @error('phone')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="position" class="form-label">
                            <i class="bi bi-briefcase"></i> Posisi <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" placeholder="Masukkan posisi/jabatan" value="{{ old('position', $employee->position) }}" required>
                        @error('position')
                            <div class="invalid-feedback"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-3 mt-5">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-check-circle"></i> Update Karyawan
                        </button>
                        <a href="/employees" class="btn btn-secondary flex-grow-1">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection