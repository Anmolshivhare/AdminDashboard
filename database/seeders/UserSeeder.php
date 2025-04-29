<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $superAdminUser = [
            'id'                => 1,
            'name'              => 'Super Admin',
            'email'             => 'sadmin@admin.com',
            'email_verified_at' => null,
            'password'          => 'Admin@123', //i.e Admin@123
            'remember_token'    => null,
            'profile_pic'    => null,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];

        $superAdmin = User::create($superAdminUser);
        $superAdmin->assignRole('Super Admin');
        //user  details
        $adminUser = [
            'id'                => 2,
            'name'              => 'Admin',
            'email'             => 'admin@admin.com',
            'email_verified_at' => null,
            'password'          => 'Admin@123', //i.e Admin@123
            'remember_token'    => null,
            'profile_pic'        => null,
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
        $admin = User::create($adminUser);
        $admin->assignRole('Admin');
    }
}
