<?php
namespace Database\Seeders;

// use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Isi Anggota Himpunan Peran (R)
        // $superAdminRole = Role::create(['name' => 'SuperAdmin']);
        // $userRole       = Role::create(['name' => 'User']);

        // 2. Isi Anggota Himpunan Pengguna (U) dengan password terenkripsi Matematika
        User::create([
            'username'       => 'admin_server',
            'password'       => User::customEncrypt('rahasia123'),
            // 'role_id'        => $superAdminRole->id,
            'email'          => 'admin@gmail.com',
            'email_verified' => true,
            'is_active'      => true,
            'otp_code'       => null,
            'otp_expired_at' => null,
        ]);

        User::create([
            'username' => 'budi_user',
            'password' => User::customEncrypt('budi123'),
            // 'role_id' => $userRole->id,
            'email' => 'budi@gmail.com',
            'email_verified' => true,
            'is_active' => true,
            'otp_code' => null,
            'otp_expired_at' => null
        ]);

        User::create([
            'username' => 'siti_baru',
            'password' => User::customEncrypt('siti123'),
            // 'role_id' => $userRole->id,
            'email' => null,
            'email_verified' => false,
            'is_active' => false,
            'otp_code' => null,
            'otp_expired_at' => null
        ]);
    }
}
