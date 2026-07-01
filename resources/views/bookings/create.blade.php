@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Buat Pengajuan Peminjaman Ruangan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('bookings.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Ruangan</label>
                        <select name="room_id" class="form-select" required>
                            <option value="">-- Pilih Ruangan --</option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}" {{ (isset($room_id) && $room_id == $room->id) ? 'selected' : '' }}>
                                    {{ $room->room_number }} - {{ $room->name }} (Kapasitas: {{ $room->capacity }})
                                </option>
                            @endforeach
                        </select>
                        @error('room_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Kegiatan</label>
                        <input type="text" name="activity_name" class="form-control" required placeholder="Contoh: Rapat HIMA, Praktikum Susulan">
                        @error('activity_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Peminjaman</label>
                            <input type="date" name="booking_date" class="form-control" required>
                            @error('booking_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jam Pinjam</label>
                            <input type="time" name="booking_time" class="form-control" required>
                            @error('booking_time') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-success">Ajukan Peminjaman</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
