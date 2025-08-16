<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel; 
use Carbon\Carbon;

class HotelController extends Controller
{
    public function index(Request $request)
{
    $query = Hotel::query();

    if ($request->filled('location')) {
        $query->where('location', 'like', '%' . $request->location . '%');
    }

    if ($request->filled('min_price') || $request->filled('max_price')) {
        $query->whereHas('rooms', function ($q) use ($request) {
            if ($request->filled('min_price') && $request->filled('max_price')) {
                $q->whereBetween('price', [$request->min_price, $request->max_price]);
            } elseif ($request->filled('min_price')) {
                $q->where('price', '>=', $request->min_price);
            } elseif ($request->filled('max_price')) {
                $q->where('price', '<=', $request->max_price);
            }
        });
    }

    $hotels = $query->get();

    return view('hotels.index', compact('hotels'));
}

    public function show($id)
    {
        $hotel = Hotel::with('rooms')->findOrFail($id);
        return view('hotels.show', compact('hotel'));
    }
    public function delete() {
        $dataDelete = Hotel::where('location', 'hebron')->delete();
        
        return response()->json([
            'message' => ' hotels in Hebron deleted successfully',
            'deleted_count' => $dataDelete
        ]);
    }
}
