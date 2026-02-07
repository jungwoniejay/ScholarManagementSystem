<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        User::all()->each(function ($user) {
            // Check if password is not hashed with bcrypt
            $info = password_get_info($user->password);
            if ($info['algo'] !== PASSWORD_BCRYPT) {
                // Assume it's plain text and hash it
                $user->password = Hash::make($user->password);
                $user->save();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Cannot reverse password hashing
    }
};
