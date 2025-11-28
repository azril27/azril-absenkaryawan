@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-pencil-square"></i> Edit Data Absensi
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

                <form action="/admin/attendance/{{ $attendance->id }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="employee_id" class="form-label">
                            <i class="bi bi-person"></i> Karyawan <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id" name="employee_id" required>
                            <option value="">-- Pilih Karyawan --</option>
                            @foreach($employees as $emp)
                                <option value="{{ $emp->id }}" {{ old('employee_id', $attendance->employee_id) == $emp->id ? 'selected' : '' }}>
                                    {{ $emp->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('employee_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="attendance_date" class="form-label">
                            <i class="bi bi-calendar"></i> Tanggal <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control @error('attendance_date') is-invalid @enderror" id="attendance_date" name="attendance_date" value="{{ old('attendance_date', $attendance->attendance_date->format('Y-m-d')) }}" required>
                        @error('attendance_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="check_in_time" class="form-label">
                                    <i class="bi bi-clock"></i> Check-In Time
                                </label>
                                <input type="time" class="form-control @error('check_in_time') is-invalid @enderror" id="check_in_time" name="check_in_time" value="{{ old('check_in_time', $attendance->check_in_time ? $attendance->check_in_time->format('H:i') : '') }}">
                                @error('check_in_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="check_out_time" class="form-label">
                                    <i class="bi bi-clock"></i> Check-Out Time
                                </label>
                                <input type="time" class="form-control @error('check_out_time') is-invalid @enderror" id="check_out_time" name="check_out_time" value="{{ old('check_out_time', $attendance->check_out_time ? $attendance->check_out_time->format('H:i') : '') }}">
                                @error('check_out_time')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="form-label">
                            <i class="bi bi-tag"></i> Status <span class="text-danger">*</span>
                        </label>
                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="hadir" {{ old('status', $attendance->status) == 'hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="sakit" {{ old('status', $attendance->status) == 'sakit' ? 'selected' : '' }}>Sakit</option>
                            <option value="izin" {{ old('status', $attendance->status) == 'izin' ? 'selected' : '' }}>Izin</option>
                            <option value="alfa" {{ old('status', $attendance->status) == 'alfa' ? 'selected' : '' }}>Alfa</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="notes" class="form-label">
                            <i class="bi bi-file-text"></i> Catatan
                        </label>
                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3" placeholder="Masukkan catatan jika ada">{{ old('notes', $attendance->notes) }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-3 mt-5">
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-check-circle"></i> Update
                        </button>
                        <a href="/admin/attendance/list" class="btn btn-secondary flex-grow-1">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
