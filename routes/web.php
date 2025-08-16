<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController ;
use App\Http\Controllers\RoomController ;

use App\Http\Controllers\BookingController ;

Route::get('/', function () {
    return view('welcome');
})->name('main');
Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::get('/hotels/{id}', [HotelController::class, 'show'])->name('hotels.show');
Route::delete('/hotels/hebronHotel', [HotelController::class, 'delete'])->name('hotels.delete');
Route::get('/rooms', [RoomController::class, 'show'])->name('rooms.show');
Route::get('/rooms/{id}', [RoomController::class, 'show'])->name('rooms.show');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings', [BookingController::class, 'show'])->name('bookings.show');
