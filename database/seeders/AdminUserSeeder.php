<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        // Check if admin already exists
        $admin = User::where('email', 'admin@scholarhub.com')->first();
        if (!$admin) {
            User::create([
                'name' => 'Administrator',
                'email' => 'admin@scholarhub.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
            
            $this->command->info('✓ Admin account created successfully!');
            $this->command->info('  Email: admin@scholarhub.com');
            $this->command->info('  Password: admin123');
        } else {
            $this->command->info('Admin account already exists.');
        }
    }
}
