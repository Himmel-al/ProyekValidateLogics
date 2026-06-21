<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body style="font-family: sans-serif; text-align: center; margin-top: 100px;">
    <h1 style="color: green;">✓ Login Berhasil Ter-validasi!</h1>
    <p>Selamat datang di sistem utama, <strong>{{ auth()->user()->username }}</strong></p>
    {{-- <p>Role Anda saat ini: {{ auth()->user()->role->name }}</p> --}}
    <a href="{{ route('logout') }}">Keluar dari Sistem</a>
</body>
</html>
