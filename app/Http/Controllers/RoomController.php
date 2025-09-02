<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomReqest;
use Illuminate\Http\Request;
use App\Models\Room; 

class RoomController extends Controller
{
   public function show($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.show', compact('room'));
    }
     public function store(Request $request)
{
    $data = $request->only(keys: ['hotel_id', 'type', 'price', 'capacity']); 

    if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('rooms', 'public'); // مكان التخزين
    }
    $room = Room::create($data);

    return response()->json([
        'success' => true,
        'message' => 'Room created successfully!',
        'data'    => $room
    ]);
}

}
