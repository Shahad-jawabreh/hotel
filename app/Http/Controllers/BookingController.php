<?php

namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreBookingRequest;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    // Show all bookings
    public function index()
    {
        $bookings = Booking::with('room.hotel')->where('user_id', Auth::id())->get();
        return response()->json(['success' => true, 'bookings' => $bookings]);
    }
    public function store(StoreBookingRequest $request)
    {
        $booking = Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Your booking has been placed successfully!',
            'data' => $booking
        ], 201);
    }

    public function show(Booking $booking)
    {
       return response()->json(['success' => true, 'booking' => $booking]);
    }

    public function update(StoreBookingRequest $request, Booking $booking)
    {
        $booking->update([
            'room_id' => $request->room_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking updated successfully!',
            'data' => $booking
        ]);
    }

    // Delete booking
     public function delete(Request $request)
    {
        if ($request->has('ids')) {
            $deletedCount = Booking::whereIn('id', $request->ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Booking deleted successfully',
                'deleted_count' => $deletedCount
            ]);
        }

        if ($request->has('id')) {
            $Booking = Booking::find($request->id);
            $Booking->delete();

            return response()->json([
                'success' => true,
                'message' => "Booking with ID {$request->id} deleted successfully"
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'No ID(s) provided for deletion'
        ], 400);
    }
}
