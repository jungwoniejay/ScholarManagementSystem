<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Donator;
use Illuminate\Support\Facades\Hash;

class AdminAndDonorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * This seeder creates both admin and donor accounts.
     */
    public function run()
    {
        $this->command->info('');
        $this->command->info('========================================');
        $this->command->info('  Creating Admin & Donor Accounts');
        $this->command->info('========================================');
        $this->command->info('');

        // ========== CREATE ADMIN ACCOUNT ==========
        $adminEmail = 'admin@scholarhub.com';
        $admin = User::where('email', $adminEmail)->first();
        
        if (!$admin) {
            User::create([
                'name' => 'Administrator',
                'email' => $adminEmail,
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]);
            
            $this->command->info('✓ Admin Account Created:');
            $this->command->line('  Email:    ' . $adminEmail);
            $this->command->line('  Password: admin123');
            $this->command->line('  Role:     Administrator');
        } else {
            $this->command->warn('⚠ Admin account already exists: ' . $adminEmail);
        }

        $this->command->info('');

        // ========== CREATE DONOR ACCOUNT ==========
        $donorEmail = 'donor@scholarhub.com';
        $donorUser = User::where('email', $donorEmail)->first();
        
        if (!$donorUser) {
            // Create donor user account
            $donorUser = User::create([
                'name' => 'Sample Donor',
                'email' => $donorEmail,
                'password' => Hash::make('donor123'),
                'role' => 'donator',
            ]);

            // Create donor profile
            Donator::create([
                'user_id' => $donorUser->id,
                'organization_name' => 'ScholarHub Foundation',
                'contact_person' => 'Sample Donor',
                'email' => $donorEmail,
                'contact_number' => '+1234567890',
                'total_fund' => 100000.00,
                'available_fund' => 100000.00,
                'account_status' => 'active',
            ]);

            $this->command->info('✓ Donor Account Created:');
            $this->command->line('  Email:        ' . $donorEmail);
            $this->command->line('  Password:     donor123');
            $this->command->line('  Organization: ScholarHub Foundation');
            $this->command->line('  Total Fund:   ₱100,000.00');
            $this->command->line('  Role:         Donor');
        } else {
            $this->command->warn('⚠ Donor account already exists: ' . $donorEmail);
        }

        $this->command->info('');
        $this->command->info('========================================');
        $this->command->info('  Setup Complete!');
        $this->command->info('========================================');
        $this->command->info('');
    }
}
