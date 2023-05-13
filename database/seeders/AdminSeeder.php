<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::create([
            'name' => 'Admin Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password 
            'created_at' => now(),
            'updated_at' => now()
        ])->assignRole('admin', 'receiptionist', 'doctor', 'pharmacist');

        User::create([
            'name' => 'Doctor Doctor',
            'email' => 'doctor@doctor.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password 
            'created_at' => now(),
            'updated_at' => now()
        ])->assignRole('doctor');

        User::create([
            'name' => 'Pharmacist Pharmacist',
            'email' => 'pharmacist@pharmacist.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password 
            'created_at' => now(),
            'updated_at' => now()
        ])->assignRole('pharmacist');

        User::create([
            'name' => 'Receiptionist Receiptionist',
            'email' => 'receiptionist@receiptionist.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password 
            'created_at' => now(),
            'updated_at' => now()
        ])->assignRole('receiptionist');
    }
}
