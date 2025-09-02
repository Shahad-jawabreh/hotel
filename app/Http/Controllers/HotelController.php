<?php
namespace App\Http\Controllers;
use App\Http\Resources\HotelResource;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Http\Requests\HotelRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;


class HotelController extends Controller
{
    public function index(Request $request)
    {
        $hotels = Hotel::query()
            ->location($request->location)
            ->priceRange($request->min_price, $request->max_price)
            ->get();
    return HotelResource::collection($hotels);
    }

    public function show(Hotel $hotel)
{
    return new HotelResource($hotel->load('rooms'));
}

    public function destroy(Request $request)
    {
        // delete photos corraspand on hotel deleted

        $ids = $request->input('ids');
        if (empty($ids)) {
            return response()->json([
                'success' => false,
                'message' => 'No booking ID(s) provided!',
            ], 400);
        }

        $hotels = Hotel::whereIn('id', $ids)->get();
        if ($hotels->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Booking(s) not found!',
            ], 404);
        }
        DB::transaction(function () use ($hotels) {
            foreach ($hotels as $hotel) {
                $hotel->delete();
            }
        });


        return response()->json([
            'success' => true,
            'message' => count($ids) > 1
                ? 'Bookings deleted successfully!'
                : 'Booking deleted successfully!',
        ]);
    }

    public function store(HotelRequest $request)
    {
        $data = $request->only(['name', 'location', 'description']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hotels', 'public');
        }

        $hotel = new Hotel();
        $hotel->fill($data);
         $hotel->save();
       $roomData = [
            'hotel_id' => $hotel->id,
            'price' => $request['price'],
            'capacity' => $request['capacity'],
            'type' => $request['type'],
        ];
        $response = Http::post(env('ROOM_API'.''), $roomData);
//edit
        if ($response->successful()) {
            return response()->json([
                'success' => true,
                'message' => 'Hotel and Room created successfully',
                'hotel'   => $hotel,
                'room'    => $response->json(),
            ]);
        }


        return response()->json([
            'success' => false,
            'message' => 'failed to create Room',
            'error'   => $response->body(),
        ], $response->status());
    }

}


