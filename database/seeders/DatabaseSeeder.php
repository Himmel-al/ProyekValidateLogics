<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Isi Anggota Himpunan Peran (R)
        $superAdminRole = Role::create(['name' => 'SuperAdmin']);
        $userRole = Role::create(['name' => 'User']);

        // 2. Isi Anggota Himpunan Pengguna (U) dengan password terenkripsi Matematika
        User::create([
            'username' => 'admin_server',
            'password' => User::customEncrypt('rahasia123'),
            'role_id' => $superAdminRole->id,
            'is_active' => true
        ]);

        User::create([
            'username' => 'budi_user',
            'password' => User::customEncrypt('budi123'),
            'role_id' => $userRole->id,
            'is_active' => true
        ]);

        User::create([
            'username' => 'siti_blokir',
            'password' => User::customEncrypt('siti123'),
            'role_id' => $userRole->id,
            'is_active' => false
        ]);
    }
}
