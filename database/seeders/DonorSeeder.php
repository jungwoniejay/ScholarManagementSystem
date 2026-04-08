<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Donator;
use Illuminate\Support\Facades\Hash;

class DonorSeeder extends Seeder
{
    public function run()
    {
        // Check if donor user already exists
        $donorUser = User::where('email', 'donor@scholarhub.com')->first();
        
        if (!$donorUser) {
            // Create donor user account
            $donorUser = User::create([
                'name' => 'Sample Donor',
                'email' => 'donor@scholarhub.com',
                'password' => Hash::make('donor123'),
                'role' => 'donator',
            ]);

            // Create donor profile
            Donator::create([
                'user_id' => $donorUser->id,
                'organization_name' => 'ScholarHub Foundation',
                'contact_person' => 'Sample Donor',
                'email' => 'donor@scholarhub.com',
                'contact_number' => '+1234567890',
                'total_fund' => 100000.00,
                'available_fund' => 100000.00,
                'account_status' => 'active',
            ]);

            $this->command->info('✓ Donor account created successfully!');
            $this->command->info('  Email: donor@scholarhub.com');
            $this->command->info('  Password: donor123');
            $this->command->info('  Organization: ScholarHub Foundation');
            $this->command->info('  Total Fund: ₱100,000.00');
        } else {
            $this->command->info('Donor account already exists.');
        }
    }
}
