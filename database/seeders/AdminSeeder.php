<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds to update or create Super Administrator account.
     *
     * @return void
     */
    public function run()
    {
        $adminData = [
            'name' => 'Super Administrator',
            'username' => 'atlasstudio90',
            'email' => 'atlasstudio90@gmail.com',
            'password' => Hash::make('mikaliso77-90ky-zack'),
            'is_admin' => true,
            'role' => 'super_admin',
            'status' => 'active',
            'provider' => 'local',
            'email_verified_at' => now(),
        ];

        // Find existing Super Admin or admin user to update without creating duplicates
        $admin = User::where('email', 'atlasstudio90@gmail.com')
            ->orWhere('username', 'atlasstudio90')
            ->orWhere('username', 'mikaliso77')
            ->orWhere('is_admin', true)
            ->orWhere('role', 'super_admin')
            ->first();

        if ($admin) {
            $admin->update($adminData);
        } else {
            User::create($adminData);
        }
    }
}
