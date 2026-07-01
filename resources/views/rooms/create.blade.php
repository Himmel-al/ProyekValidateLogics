@extends('layouts.app')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">{{ isset($room) ? 'Edit Ruangan' : 'Tambah Ruangan' }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ isset($room) ? route('rooms.update', $room->id) : route('rooms.store') }}" method="POST">
            @csrf
            @if(isset($room))
                @method('PUT')
            @endif
            
            <div class="mb-3">
                <label>Nomor Ruangan</label>
                <input type="text" name="room_number" class="form-control" value="{{ old('room_number', $room->room_number ?? '') }}" required>
            </div>
            
            <div class="mb-3">
                <label>Nama Ruangan</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $room->name ?? '') }}">
            </div>

            <div class="mb-3">
                <label>Kapasitas</label>
                <input type="number" name="capacity" class="form-control" value="{{ old('capacity', $room->capacity ?? 0) }}" required>
            </div>
            
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control">{{ old('description', $room->description ?? '') }}</textarea>
            </div>

            <div class="mb-3">
                <label>Status</label>
                <select name="status" class="form-select" required>
                    <option value="Tersedia" {{ (old('status', $room->status ?? '') == 'Tersedia') ? 'selected' : '' }}>Tersedia</option>
                    <option value="Maintenance" {{ (old('status', $room->status ?? '') == 'Maintenance') ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
@endsection
