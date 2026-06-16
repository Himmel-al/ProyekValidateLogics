<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\KirimOtpMail;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Halaman Form Login Utama
    public function showLogin() { return view('login'); }

    // Proses Validasi Login Tahap 1
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        // Evaluasi Nilai Kebenaran Proposisi
        $p = ($user !== null); // Username benar
        $q = $p && (User::customDecrypt($user->password) === $request->password); // Password benar
        $r = $p && ($user->is_active === true);

        // Cek jika p, q, r terpenuhi
        if ($p && $q && $r) {
            $a = ($user->role->name === 'SuperAdmin'); // Apakah termasuk Himpunan SuperAdmin?

            if ($a) {
                // JIKA SUPERADMIN, JANGAN LANGSUNG MASUK.
                // Simpan ID user dulu di session sementara, lalu pindah ke halaman MINTA EMAIL.
                session(['user_id_mencoba' => $user->id]);
                return redirect()->route('otp.minta_email');
            }

            // Jika User biasa (Bukan SuperAdmin), langsung login sukses tanpa OTP
            Auth::login($user);
            return redirect()->route('dashboard');
        }

        // Penanganan jika Salah Satu Proposisi Bernilai False
        if (!$p) return back()->withErrors(['username' => 'Username salah! (p = False)']);
        if (!$q) return back()->withErrors(['password' => 'Password salah! (q = False)']);
        if (!$r) return back()->withErrors(['status' => 'Akun tidak aktif! (r = False)']);
    }

    // HALAMAN MINTA EMAIL UNTUK KIRIM OTP
    public function showMintaEmail() { return view('otp_minta_email'); }

    // PROSES MINTA EMAIL: GENERATE OTP, KIRIM EMAIL, PINDAH KE VERIFIKASI
    public function prosesMintaEmail(Request $request)
    {
        $request->validate(['email_tujuan' => 'required|email']);

        // Ambil ID User dari session tahap 1
        $userId = session('user_id_mencoba');

        // Generate Token OTP (Kombinatorika 6 digit)
        $otpDibuat = rand(100000, 999999);

        // --- PROSES KIRIM EMAIL ASLI ---
        Mail::to($request->email_tujuan)->send(new KirimOtpMail($otpDibuat));

        // Simpan OTP dan waktu kedaluwarsa ke Session
        session([
            'otp_secret' => $otpDibuat,
            'otp_expires_at' => now()->addMinutes(5),
            // user_id_mencoba tetap di session
        ]);

        // Alihkan ke halaman INPUT OTP (Verifikasi)
        return redirect()->route('otp.view');
    }

    // Halaman Input OTP
    public function showOtp() { return view('otp'); }

    // Proses Validasi OTP Tahap 2
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp_input' => 'required|numeric']);

        $otpServer = session('otp_secret');
        $waktuExpired = session('otp_expires_at');
        $userId = session('user_id_mencoba');

        $p = ($request->otp_input == $otpServer); // Konjungsi p: Angka cocok
        $q = now()->lessThanOrEqualTo($waktuExpired); // Konjungsi q: Waktu valid

        if ($p && $q) {
            Auth::loginUsingId($userId);
            session()->forget(['otp_secret', 'otp_expires_at', 'user_id_mencoba']);
            return redirect()->route('dashboard');
        }

        if (!$p) return back()->withErrors(['otp_input' => 'Token OTP salah! (p = False)']);
        if (!$q) return back()->withErrors(['otp_input' => 'Token OTP Kedaluwarsa! (q = False)']);
    }

    // Halaman Dashboard Berhasil Masuk
    public function dashboard() { return view('dashboard'); }

    // Logout
    public function logout() { Auth::logout(); return redirect()->route('login'); }
}
