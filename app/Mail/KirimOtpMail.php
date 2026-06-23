<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class KirimOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp; // Variabel untuk menampung OTP agar bisa dibaca di View

    public function __construct($otp)
    {
        $this->otp = $otp; // Masukkan OTP yang dibuat ke variabel
    }

    // Mengatur Subjek Email
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Kode OTP Keamanan Portal Anda',
        );

    }

    // Menghubungkan ke View Tampilan Email
    public function content(): Content
    {
        return new Content(
            view: 'emails.otp', // Kita akan buat file view ini nanti
        );
    }

    public function build()
    {
        return $this
            ->subject(
                'Verifikasi Email'
            )
            ->view(
                'emails.verify'
            );
    }
}
