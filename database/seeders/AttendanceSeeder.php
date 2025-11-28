<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();
        $statuses = ['hadir', 'sakit', 'izin', 'alfa'];
        
        // Create attendance records for the last 10 days
        foreach ($employees as $employee) {
            for ($i = 0; $i < 10; $i++) {
                $date = Carbon::now()->subDays($i);
                $status = $statuses[array_rand($statuses)];
                
                $checkIn = null;
                $checkOut = null;
                
                // Only add check-in/out times if status is 'hadir'
                if ($status === 'hadir') {
                    $checkIn = $date->copy()->setHour(rand(7, 9))->setMinute(rand(0, 59))->setSecond(0);
                    $checkOut = $date->copy()->setHour(rand(16, 18))->setMinute(rand(0, 59))->setSecond(0);
                }
                
                Attendance::create([
                    'employee_id' => $employee->id,
                    'attendance_date' => $date->toDateString(),
                    'check_in_time' => $checkIn,
                    'check_out_time' => $checkOut,
                    'status' => $status,
                    'notes' => $status === 'sakit' ? 'Sakit' : ($status === 'izin' ? 'Izin' : null),
                ]);
            }
        }
    }
}
