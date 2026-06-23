<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;

class VerifikasiEmail extends Mailable
{
    public $link;
    public function __construct($link)
    {$this->link = $link;}public function build()
    {return $this->subject('Verifikasi Email')->view('emails.verify');}
}
