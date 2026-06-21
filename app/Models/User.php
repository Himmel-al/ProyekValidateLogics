<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'username',
        'password',
        'role_id',
        'email',
        'email_verified',
        'is_active',
        'otp_code',
        'otp_expired_at',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'email_verified' => 'boolean',
        'otp_expired_at' => 'datetime',
    ];

    // Menghubungkan User ke jajaran Himpunan Peran (Role)
    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }

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

    // Mengecek apakah user sudah verifikasi email
    public function hasVerifiedEmail()
    {
        return $this->email_verified === true;
    }

    // Mengecek apakah akun aktif
    public function isActive()
    {
        return $this->is_active === true;
    }

    // Mengecek apakah OTP masih berlaku
    public function isOtpValid()
    {
        return $this->otp_expired_at &&
               now()->lt($this->otp_expired_at);
    }
}
