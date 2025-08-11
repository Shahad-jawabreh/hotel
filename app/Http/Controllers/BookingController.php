<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
        ]);

        Booking::create([
            'user_id' => 1,
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Your booking has been placed successfully!');
    }
    public function show()
    {
        $user = User::findOrFail(1);
        $bookings = Booking::where('user_id', 1)->with('room.hotel')->get();

        return view('bookings.show', compact('user', 'bookings'));
    }
}
