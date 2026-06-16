<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    protected $fillable = ['username', 'password', 'role_id', 'is_active'];

    // Menghubungkan User ke jajaran Himpunan Peran (Role)
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    // --- FITUR KRIPTOGRAFI MATEMATIKA DISKRIT ---
    // Caesar Cipher Sederhana: Menggeser nilai ASCII karakter sebesar +7 (Mod 256)
    public static function customEncrypt($password)
    {
        $key       = 7;
        $encrypted = "";
        foreach (str_split($password) as $char) {
            $encrypted .= chr((ord($char) + $key) % 256);
        }
        return base64_encode($encrypted);
    }

    // Dekripsi: Mengembalikan geseran sebesar -7 (Mod 256)
    public static function customDecrypt($encryptedPassword)
    {
        $key       = 7;
        $decrypted = "";
        $decoded   = base64_decode($encryptedPassword);
        foreach (str_split($decoded) as $char) {
            $decrypted .= chr((ord($char) - $key + 256) % 256);
        }
        return $decrypted;
    }
}
