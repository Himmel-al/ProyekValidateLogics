<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Room;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['name' => 'Admin', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'User', 'created_at' => now(), 'updated_at' => now()],
        ]);

        User::create([
            'username'       => 'admin_server',
            'password'       => User::customEncrypt('rahasia123'),
            'email'          => 'ridho24ti@mahasiswa.pcr.ac.id',
            'email_verified' => true,
            'is_active'      => true,
            'otp_code'       => null,
            'otp_expired_at' => null,
            'role_id'        => 1,
        ]);

        User::create([
            'username' => 'hafis_user',
            'password' => User::customEncrypt('hafis123'),
            'email' => 'budi@gmail.com',
            'email_verified' => true,
            'is_active' => true,
            'otp_code' => null,
            'otp_expired_at' => null,
            'role_id' => 2,
        ]);

        User::create([
            'username' => 'lady_baru',
            'password' => User::customEncrypt('lady123'),
            'email' => null,
            'email_verified' => false,
            'is_active' => false,
            'otp_code' => null,
            'otp_expired_at' => null,
            'role_id' => 2,
        ]);

        User::create([
            'username' => 'najah_baru',
            'password' => User::customEncrypt('najah123'),
            'email' => null,
            'email_verified' => false,
            'is_active' => false,
            'otp_code' => null,
            'otp_expired_at' => null,
            'role_id' => 2,
        ]);

        Room::create([
            'room_number' => '314',
            'name' => 'Lab Komputer 1',
            'capacity' => 40,
            'description' => 'Laboratorium Komputer untuk Praktikum Pemrograman',
            'status' => 'Tersedia'
        ]);

        Room::create([
            'room_number' => '325',
            'name' => 'Ruang Teori 1',
            'capacity' => 50,
            'description' => 'Ruang kelas untuk teori',
            'status' => 'Tersedia'
        ]);
    }
}
