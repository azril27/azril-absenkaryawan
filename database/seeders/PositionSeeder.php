<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::create([
            'name' => 'Manager',
            'description' => 'Mengelola dan mengawasi tim karyawan',
        ]);

        Position::create([
            'name' => 'Senior Developer',
            'description' => 'Mengembangkan dan memelihara aplikasi software',
        ]);

        Position::create([
            'name' => 'Junior Developer',
            'description' => 'Membantu pengembangan software di bawah bimbingan senior',
        ]);

        Position::create([
            'name' => 'UI/UX Designer',
            'description' => 'Mendesain interface dan pengalaman pengguna aplikasi',
        ]);

        Position::create([
            'name' => 'QA Engineer',
            'description' => 'Melakukan testing dan quality assurance pada aplikasi',
        ]);

        Position::create([
            'name' => 'HR Staff',
            'description' => 'Menangani administrasi dan pengembangan SDM',
        ]);

        Position::create([
            'name' => 'System Administrator',
            'description' => 'Mengelola infrastruktur dan sistem jaringan',
        ]);

        Position::create([
            'name' => 'Business Analyst',
            'description' => 'Menganalisis kebutuhan bisnis dan solusi teknis',
        ]);
    }
}
