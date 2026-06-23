<?php
namespace App\Http\Controllers;

use App\Mail\KirimOtpMail;
use App\Mail\VerifikasiEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLogin()
    {return view('login');}

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where(
            'username',
            $request->username
        )->first();

        $p = ($user !== null);

        $q = $p &&
            (User::customDecrypt($user->password)
            === $request->password);

        if (! $p) {
            return back()->withErrors([
                'username' => 'Username salah! (p=False)',
            ]);
        }

        if (! $q) {
            return back()->withErrors([
                'password' => 'Password salah! (q=False)',
            ]);
        }

        session([
            'user_id_mencoba' => $user->id,
        ]);

        $r = $user->email_verified;

        if (! $r) {
            return redirect()
                ->route('email.form');
        }

        return redirect()
            ->route('otp.kirim');
    }

    public function showEmailForm()
    {
        return view('email_form');
    }

    public function kirimVerifikasiEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::find(
            session('user_id_mencoba')
        );

        $token = Str::random(64);

        $user->email = $request->email;

        $user->email_verify_token = $token;

        $user->save();

        $link = route(
            'email.verify.link',
            $token
        );

        Mail::to($user->email)
            ->send(
                new VerifikasiEmail($link)
            );

        return back()->with(
            'success',
            'Link verifikasi telah dikirim'
        );
    }



    public function verifyEmail(Request $request)
    {
        $request->validate([
            'otp_input' => 'required',
        ]);

        $user = User::find(
            session('user_id_mencoba')
        );

        if (
            $request->otp_input ==
            $user->otp_code
        ) {

            $user->email_verified = true;
            $user->is_active      = true;

            $user->otp_code       = null;
            $user->otp_expired_at = null;

            $user->save();

            return redirect()
                ->route('otp.kirim');
        }

        return back()->withErrors([
            'otp_input' => 'Kode verifikasi salah',
        ]);
    }

    public function verifyEmailByLink($token)
    {
        $user = User::where(
            'email_verify_token',
            $token
        )->first();

        if (! $user) {

            abort(404);

        }

        $user->email_verified = true;

        $user->email_verify_token = null;

        $user->save();

        session([
            'user_id_mencoba' => $user->id,
        ]);

        return redirect()
            ->route('otp.kirim')
            ->with(
                'success',
                'Email berhasil diverifikasi'
            );
    }

    public function kirimOtpLogin()
    {
        $user = User::find(
            session('user_id_mencoba')
        );

        $otp = rand(100000, 999999);

        $user->otp_code       = $otp;
        $user->otp_expired_at =
        now()->addMinutes(5);

        $user->save();

        Mail::to($user->email)
            ->send(
                new KirimOtpMail($otp)
            );

        return redirect()
            ->route('otp.view');
    }

    public function showOtp()
    {
        return view('otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_input' => 'required',
        ]);

        $user = User::find(
            session('user_id_mencoba')
        );

        $s = (
            $request->otp_input ==
            $user->otp_code
        );

        $t = now()->lt(
            $user->otp_expired_at
        );

        if ($s && $t) {

            Auth::login($user);

            session()->put('analisis_login', [
                'p'     => true,
                'q'     => true,
                'r'     => true,
                's'     => $s,
                'hasil' => true,
            ]);

            $user->otp_code       = null;
            $user->otp_expired_at = null;
            $user->save();

            session()->forget([
                'user_id_mencoba',
            ]);

            return redirect()
                ->route('dashboard');
        }

        if (! $s) {
            return back()->withErrors([
                'otp_input' => 'OTP salah! (s=False)',
            ]);
        }

        if (! $t) {
            return back()->withErrors([
                'otp_input' => 'OTP kadaluarsa! (t=False)',
            ]);
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()
            ->route('login');
    }
}
