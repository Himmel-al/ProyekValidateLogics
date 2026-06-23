<?php

namespace Database\Seeders;

// use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username'       => 'admin_server',
            'password'       => User::customEncrypt('rahasia123'),
            // 'role_id'        => $superAdminRole->id,
            'email'          => 'ridho24ti@mahasiswa.pcr.ac.id',
            'email_verified' => true,
            'is_active'      => true,
            'otp_code'       => null,
            'otp_expired_at' => null,
        ]);

        User::create([
            'username' => 'hafis_user',
            'password' => User::customEncrypt('hafis123'),
            // 'role_id' => $userRole->id,
            'email' => 'budi@gmail.com',
            'email_verified' => true,
            'is_active' => true,
            'otp_code' => null,
            'otp_expired_at' => null
        ]);

        User::create([
            'username' => 'lady_baru',
            'password' => User::customEncrypt('lady123'),
            // 'role_id' => $userRole->id,
            'email' => null,
            'email_verified' => false,
            'is_active' => false,
            'otp_code' => null,
            'otp_expired_at' => null
        ]);

        User::create([
            'username' => 'najah_baru',
            'password' => User::customEncrypt('najah123'),
            // 'role_id' => $userRole->id,
            'email' => null,
            'email_verified' => false,
            'is_active' => false,
            'otp_code' => null,
            'otp_expired_at' => null
        ]);
    }
}
