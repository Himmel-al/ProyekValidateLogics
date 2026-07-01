<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms',
            'name' => 'nullable|string',
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:Tersedia,Maintenance',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $room->id,
            'name' => 'nullable|string',
            'capacity' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:Tersedia,Maintenance',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil diupdate');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Ruangan berhasil dihapus');
    }
}
