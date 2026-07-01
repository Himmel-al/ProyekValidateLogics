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

    public static function customEncrypt($password)
    {
        $key       = 7;
        $encrypted = "";
        foreach (str_split($password) as $char) {
            $encrypted .= chr((ord($char) + $key) % 256);
        }
        return base64_encode($encrypted);
    }


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

    public function hasVerifiedEmail()
    {
        return $this->email_verified === true;
    }

    public function isActive()
    {
        return $this->is_active === true;
    }

    public function isOtpValid()
    {
        return $this->otp_expired_at &&
               now()->lt($this->otp_expired_at);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAdmin()
    {
        return $this->role_id === 1; // Assuming 1 is Admin
    }
}
