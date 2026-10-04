<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Package::updateOrCreate(
            ['slug' => 'free'],
            [
                'name' => 'Starter',
                'description' => 'Solusi sederhana untuk memulai pengelolaan kelas, siswa, dan aktivitas pembelajaran secara terorganisir.',
                'price' => 0,
                'billing_period' => null,
                'class_limit' => 2,
                'student_limit' => 70,
                'is_active' => true,
            ]
        );

        Package::updateOrCreate(
            ['slug' => 'subscription'],
            [
                'name' => 'Langganan',
                'description' => 'Solusi lengkap untuk guru yang membutuhkan kapasitas lebih besar dalam mengelola kelas, siswa, dan aktivitas pembelajaran.',
                'price' => 29000,
                'billing_period' => 'month',
                'class_limit' => 10,
                'student_limit' => 350,
                'is_active' => true,
            ]
        );
    }
}
