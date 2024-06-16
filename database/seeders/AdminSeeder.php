<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin user
        $admin = User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminpassword'),
            'role' => 'Super-admin',
        ]);

        // You can add additional attributes as needed
        // Example:
        // $admin->update(['name' => 'Admin User']);

        // Output a message indicating success
        $this->command->info('Admin user created successfully.');
    }
}
