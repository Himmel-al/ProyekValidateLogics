@extends('layouts.app')

@section('content')
<style>
    .hero-card { border: none; border-radius: 20px; box-shadow: 0 10px 25px rgba(0,0,0,.1); }
    .status-success { color: #198754; font-size: 50px; }
    .formula-box { background: #eef7ff; border-left: 5px solid #0d6efd; padding: 15px; border-radius: 10px; }
</style>

<div class="card hero-card mb-4">
    <div class="card-body text-center p-5">
        <div class="status-success">✓</div>
        <h2 class="fw-bold text-success">Login Berhasil Ter-validasi</h2>
        <p class="fs-5">Selamat datang di Sistem Peminjaman Ruangan, <strong>{{ auth()->user()->username }}</strong></p>
        
        @if(!auth()->user()->isAdmin())
            <a href="{{ route('bookings.create') }}" class="btn btn-primary mt-3 btn-lg">Buat Pengajuan Peminjaman</a>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Ruangan Tersedia</h5>
            </div>
            <div class="card-body">
                @php
                    $rooms = App\Models\Room::where('status', 'Tersedia')->get();
                @endphp
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No Ruangan</th>
                            <th>Nama Ruangan</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rooms as $room)
                        <tr>
                            <td>{{ $room->room_number }}</td>
                            <td>{{ $room->name }}</td>
                            <td>{{ $room->capacity }} Orang</td>
                            <td>
                                <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="btn btn-sm btn-success">Pinjam</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada ruangan tersedia saat ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Analisis Validasi Login (History)</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Variabel</th>
                            <th>Keterangan</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>p</td><td>Username ditemukan</td><td class="text-success fw-bold">TRUE</td></tr>
                        <tr><td>q</td><td>Password benar</td><td class="text-success fw-bold">TRUE</td></tr>
                        <tr><td>r</td><td>Email terverifikasi</td><td class="text-success fw-bold">TRUE</td></tr>
                        <tr><td>s</td><td>Akun aktif</td><td class="text-success fw-bold">TRUE</td></tr>
                        <tr><td>t</td><td>OTP terverifikasi</td><td class="text-success fw-bold">TRUE</td></tr>
                        <tr class="table-success fw-bold"><td colspan="2"> p ∧ q ∧ r ∧ s ∧ t </td><td> TRUE </td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-success text-white">Formula Login Diskrit</div>
            <div class="card-body">
                <div class="formula-box">
                    <h4 class="text-center">p ∧ q ∧ r ∧ s ∧ t</h4>
                    <hr>
                    <p><b>p</b> = Username ditemukan</p>
                    <p><b>q</b> = Password benar</p>
                    <p><b>r</b> = Email terverifikasi</p>
                    <p><b>s</b> = Akun status aktif</p>
                    <p><b>t</b> = OTP Valid</p>
                </div>
            </div>
        </div>
        
        <div class="card shadow-sm mt-4">
            <div class="card-header bg-dark text-white">Kesimpulan Analisis</div>
            <div class="card-body">
                <p>Login menggunakan logika konjungsi (AND). Login berhasil karena semua kondisi terpenuhi (TRUE).</p>
            </div>
        </div>
    </div>
</div>
@endsection
