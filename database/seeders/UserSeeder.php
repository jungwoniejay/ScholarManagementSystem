<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Donator;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create donator user
        $donatorUser = User::create([
            'name' => 'Donator User',
            'email' => 'donator@example.com',
            'password' => Hash::make('password'),
            'role' => 'donator',
            'email_verified_at' => now(),
        ]);

        // Create corresponding Donator record
        Donator::create([
            'user_id' => $donatorUser->id,
            'organization_name' => 'Donator Organization',
            'contact_person' => 'Donator User',
            'email' => 'donator@example.com',
            'contact_number' => '1234567890',
            'total_fund' => 10000,
            'available_fund' => 10000,
        ]);

        // Create student user
        $studentUser = User::create([
            'name' => 'Student User',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Create corresponding Student record
        Student::create([
            'user_id' => $studentUser->id,
            'first_name' => 'Student',
            'last_name' => 'User',
            'email' => 'student@example.com',
        ]);
    }
}
