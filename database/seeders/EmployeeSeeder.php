<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positionManager = Position::where('name', 'Manager')->first();
        $positionSeniorDev = Position::where('name', 'Senior Developer')->first();
        $positionDesigner = Position::where('name', 'UI/UX Designer')->first();
        $positionJuniorDev = Position::where('name', 'Junior Developer')->first();
        $positionHR = Position::where('name', 'HR Staff')->first();
        $positionQA = Position::where('name', 'QA Engineer')->first();

        Employee::create([
            'name' => 'Azril Harahap',
            'email' => 'azril@example.com',
            'phone' => '081234567890',
            'position' => 'Manager',
            'position_id' => $positionManager->id ?? null,
        ]);

        Employee::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '082345678901',
            'position' => 'Senior Developer',
            'position_id' => $positionSeniorDev->id ?? null,
        ]);

        Employee::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'phone' => '083456789012',
            'position' => 'UI/UX Designer',
            'position_id' => $positionDesigner->id ?? null,
        ]);

        Employee::create([
            'name' => 'Rendi Hermawan',
            'email' => 'rendi@example.com',
            'phone' => '084567890123',
            'position' => 'Junior Developer',
            'position_id' => $positionJuniorDev->id ?? null,
        ]);

        Employee::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@example.com',
            'phone' => '085678901234',
            'position' => 'HR Staff',
            'position_id' => $positionHR->id ?? null,
        ]);

        Employee::create([
            'name' => 'Ahmad Hidayat',
            'email' => 'ahmad@example.com',
            'phone' => '086789012345',
            'position' => 'QA Engineer',
            'position_id' => $positionQA->id ?? null,
        ]);
    }
}
