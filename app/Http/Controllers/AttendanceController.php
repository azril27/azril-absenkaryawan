<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // User - Halaman Absensi
    public function checkIn()
    {
        $today = Carbon::now()->toDateString();
        $attendance = Attendance::where('attendance_date', $today)->first();
        
        return view('attendance.check-in', compact('attendance', 'today'));
    }

    public function doCheckIn(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $today = Carbon::now()->toDateString();
        $now = Carbon::now()->toTimeString();

        $attendance = Attendance::where('employee_id', $request->employee_id)
            ->where('attendance_date', $today)
            ->first();

        if ($attendance) {
            return back()->withErrors(['message' => 'Anda sudah melakukan check-in hari ini!']);
        }

        Attendance::create([
            'employee_id' => $request->employee_id,
            'attendance_date' => $today,
            'check_in_time' => $now,
            'status' => 'hadir',
        ]);

        return back()->with('success', 'Check-in berhasil! Selamat bekerja.');
    }

    public function doCheckOut(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
        ]);

        $today = Carbon::now()->toDateString();
        $now = Carbon::now()->toTimeString();

        $attendance = Attendance::where('employee_id', $request->employee_id)
            ->where('attendance_date', $today)
            ->first();

        if (!$attendance) {
            return back()->withErrors(['message' => 'Anda belum melakukan check-in hari ini!']);
        }

        if ($attendance->check_out_time) {
            return back()->withErrors(['message' => 'Anda sudah melakukan check-out hari ini!']);
        }

        $attendance->update([
            'check_out_time' => $now,
        ]);

        return back()->with('success', 'Check-out berhasil. Terima kasih sudah bekerja hari ini.');
    }

    // Admin - Dashboard Absensi
    public function adminDashboard(Request $request)
    {
        $today = Carbon::now()->toDateString();
        $dateFilter = $request->get('date', $today);

        $attendances = Attendance::with('employee')
            ->where('attendance_date', $dateFilter)
            ->orderBy('check_in_time', 'desc')
            ->get();

        $statistics = [
            'total_employees' => Employee::count(),
            'hadir' => $attendances->where('status', 'hadir')->count(),
            'sakit' => $attendances->where('status', 'sakit')->count(),
            'izin' => $attendances->where('status', 'izin')->count(),
            'alfa' => Employee::count() - $attendances->count(),
        ];

        return view('admin.attendance.dashboard', compact('attendances', 'statistics', 'dateFilter'));
    }

    // Admin - Kelola Absensi
    public function adminIndex(Request $request)
    {
        $query = Attendance::with('employee');

        if ($request->get('date')) {
            $query->where('attendance_date', $request->get('date'));
        }

        if ($request->get('employee_id')) {
            $query->where('employee_id', $request->get('employee_id'));
        }

        if ($request->get('status')) {
            $query->where('status', $request->get('status'));
        }

        $attendances = $query->orderBy('attendance_date', 'desc')->paginate(20);
        $employees = Employee::all();

        return view('admin.attendance.index', compact('attendances', 'employees'));
    }

    // Admin - Edit Absensi
    public function adminEdit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees = Employee::all();

        return view('admin.attendance.edit', compact('attendance', 'employees'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'attendance_date' => 'required|date',
            'check_in_time' => 'nullable|date_format:H:i',
            'check_out_time' => 'nullable|date_format:H:i',
            'status' => 'required|in:hadir,sakit,izin,alfa',
            'notes' => 'nullable|string',
        ]);

        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->all());

        return redirect('/admin/attendance')->with('success', 'Data absensi berhasil diperbarui!');
    }

    public function adminDestroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return back()->with('success', 'Data absensi berhasil dihapus!');
    }
}
