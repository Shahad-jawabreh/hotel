<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomController;
use App\Http\Middleware\SetLocale;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

$router->get('/test/slow-request', function () {
    usleep(10000000); // 10s
    return response()->json(['message' => 'Slow request done!']);
});

$router->get('/test/exception', function () {
    throw new \Exception('Test Exception for logging');
});

$router->get('/test/db-slow', function () {
    DB::select('SELECT SLEEP(10)');
    return response()->json(['message' => 'Slow DB query done!']);
});

$router->get('/test/http-timeout', function () {
    try {
        Http::timeout(1)->get('https://httpbin.org/delay/5'); // 5s delay → timeout
    } catch (\Exception $e) {
        Log::error('HTTP Timeout Test', ['error' => $e->getMessage()]);
    }
    return response()->json(['message' => 'HTTP Timeout test done!']);
});

Route::middleware([SetLocale::class])->group(function () {
    Route::apiResource('rooms', RoomController::class);
    Route::apiResource('hotels', HotelController::class);
    Route::delete('hotels', [HotelController::class, 'destroy']);
});
