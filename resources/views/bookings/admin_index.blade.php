@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Manajemen Pengajuan Peminjaman</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Pemohon</th>
                    <th>Ruangan</th>
                    <th>Kegiatan</th>
                    <th>Jadwal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                <tr>
                    <td>{{ $booking->user->username }}</td>
                    <td>{{ $booking->room->room_number }}</td>
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
                    <td>
                        @if($booking->status == 'Pending')
                        <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="Approved">
                            <button class="btn btn-sm btn-success">Setujui</button>
                        </form>
                        <form action="{{ route('bookings.updateStatus', $booking->id) }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="status" value="Rejected">
                            <button class="btn btn-sm btn-danger">Tolak</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data peminjaman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
