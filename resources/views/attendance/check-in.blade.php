@extends('layouts.app')

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title mb-0"><i class="bi bi-clock"></i> Absensi Karyawan</h1>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-circle"></i> {{ $errors->first('message') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row justify-content-center">
    <div class="col-lg-8">
        <!-- Attendance Status Card -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="bi bi-calendar-day"></i> Status Absensi Hari Ini - {{ \Carbon\Carbon::parse($today)->format('l, d F Y') }}
            </div>
            <div class="card-body text-center">
                @if($attendance)
                    <div class="alert alert-success mb-3">
                        <i class="bi bi-check-circle"></i> Anda sudah melakukan check-in hari ini
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 10px;">
                                <div style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">Check-in Time</div>
                                <div style="font-size: 1.8rem; color: #38ef7d; font-weight: 700;">
                                    @if($attendance->check_in_time)
                                        @php
                                            $time = is_string($attendance->check_in_time) ? \Carbon\Carbon::createFromFormat('H:i:s', $attendance->check_in_time) : $attendance->check_in_time;
                                        @endphp
                                        {{ $time->format('H:i:s') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div style="padding: 1.5rem; background: #f8f9fa; border-radius: 10px;">
                                <div style="font-size: 0.9rem; color: #666; margin-bottom: 0.5rem;">Check-out Time</div>
                                <div style="font-size: 1.8rem; color: #667eea; font-weight: 700;">
                                    @if($attendance->check_out_time)
                                        @php
                                            $time = is_string($attendance->check_out_time) ? \Carbon\Carbon::createFromFormat('H:i:s', $attendance->check_out_time) : $attendance->check_out_time;
                                        @endphp
                                        {{ $time->format('H:i:s') }}
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    @if(!$attendance->check_out_time)
                    <form action="/attendance/check-out" method="POST">
                        @csrf
                        <input type="hidden" name="employee_id" value="1">
                        <button type="submit" class="btn btn-warning btn-lg w-100">
                            <i class="bi bi-box-arrow-right"></i> Check-Out
                        </button>
                    </form>
                    @else
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Anda sudah melakukan check-out hari ini
                    </div>
                    @endif
                @else
                    <div class="alert alert-warning mb-4">
                        <i class="bi bi-exclamation-triangle"></i> Anda belum melakukan check-in hari ini
                    </div>
                    <form action="/attendance/check-in" method="POST">
                        @csrf
                        <input type="hidden" name="employee_id" value="1">
                        <button type="submit" class="btn btn-success btn-lg w-100">
                            <i class="bi bi-box-arrow-in-right"></i> Check-In Sekarang
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Info Card -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-info-circle"></i> Informasi Absensi
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <strong>Waktu Kerja:</strong>
                        <p class="text-muted">08:00 - 17:00 WIB</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <strong>Keterlambatan:</strong>
                        <p class="text-muted">Maksimal 15 menit</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Istirahat:</strong>
                        <p class="text-muted">12:00 - 13:00 WIB</p>
                    </div>
                    <div class="col-md-6">
                        <strong>Status:</strong>
                        <p class="text-muted">
                            @if($attendance)
                                <span class="badge bg-success">Hadir</span>
                            @else
                                <span class="badge bg-danger">Belum Absen</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
