@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Riwayat Peminjaman Saya</h5>
        <a href="{{ route('bookings.create') }}" class="btn btn-sm btn-light">Pinjam Baru</a>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Ruangan</th>
                    <th>Nama Kegiatan</th>
                    <th>Tanggal & Waktu</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->room->room_number }} - {{ $booking->room->name }}</td>
                    <td>{{ $booking->activity_name }}</td>
                    <td>{{ $booking->booking_date }} | {{ $booking->booking_time }}</td>
                    <td>
                        @if($booking->status == 'Pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @elseif($booking->status == 'Approved')
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada riwayat peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
