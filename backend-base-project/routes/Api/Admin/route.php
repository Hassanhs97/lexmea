<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['api']], function () {

    // Rooms
    Route::post('/rooms/{room}/assignGuestToRoom/{guest}', [\App\Http\Controllers\Api\Admin\RoomController::class, 'assignGuestToRoom']);
    Route::post('/rooms/{room}/deAssignGuestFromRoom/{guest}', [\App\Http\Controllers\Api\Admin\RoomController::class, 'deAssignGuestFromRoom']);
    Route::post('/rooms/{room}/ready', [\App\Http\Controllers\Api\Admin\RoomController::class, 'ready']);
    Route::apiResource('/rooms', \App\Http\Controllers\Api\Admin\RoomController::class)->except(['delete']);

    // Guests
    Route::apiResource('/guests', \App\Http\Controllers\Api\Admin\GuestController::class)->except(['delete']);
});
