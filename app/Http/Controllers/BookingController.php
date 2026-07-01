<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $bookings = Booking::with(['user', 'room'])->latest()->get();
            return view('bookings.admin_index', compact('bookings'));
        } else {
            $bookings = Booking::with('room')->where('user_id', $user->id)->latest()->get();
            return view('bookings.user_index', compact('bookings'));
        }
    }

    public function create(Request $request)
    {
        $room_id = $request->get('room_id');
        $rooms = Room::where('status', 'Tersedia')->get();
        return view('bookings.create', compact('rooms', 'room_id'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'activity_name' => 'required|string|max:255',
            'booking_date' => 'required|date',
            'booking_time' => 'required',
        ]);

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'activity_name' => $request->activity_name,
            'booking_date' => $request->booking_date,
            'booking_time' => $request->booking_time,
            'status' => 'Pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Pengajuan peminjaman berhasil dibuat, menunggu persetujuan.');
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:Approved,Rejected',
        ]);

        $booking->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status peminjaman berhasil diupdate.');
    }
}
