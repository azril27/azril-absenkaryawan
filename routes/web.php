<?php
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\AttendanceController;

Route::get('/', [EmployeeController::class, 'home'])->name('home');
Route::resource('employees', EmployeeController::class);
Route::resource('users', UserController::class);
Route::resource('positions', PositionController::class);

// Export routes
Route::get('/employees/export/csv', [EmployeeController::class, 'exportCsv'])->name('employees.export.csv');
Route::get('/employees/export/json', [EmployeeController::class, 'exportJson'])->name('employees.export.json');

// Attendance routes
Route::get('/attendance/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.checkin');
Route::post('/attendance/check-in', [AttendanceController::class, 'doCheckIn'])->name('attendance.doCheckin');
Route::post('/attendance/check-out', [AttendanceController::class, 'doCheckOut'])->name('attendance.doCheckout');

// Admin Attendance routes
Route::get('/admin/attendance', [AttendanceController::class, 'adminDashboard'])->name('admin.attendance.dashboard');
Route::get('/admin/attendance/list', [AttendanceController::class, 'adminIndex'])->name('admin.attendance.index');
Route::get('/admin/attendance/{id}/edit', [AttendanceController::class, 'adminEdit'])->name('admin.attendance.edit');
Route::put('/admin/attendance/{id}', [AttendanceController::class, 'adminUpdate'])->name('admin.attendance.update');
Route::delete('/admin/attendance/{id}', [AttendanceController::class, 'adminDestroy'])->name('admin.attendance.destroy');

?>