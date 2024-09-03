<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['throttle:public_api'])->group(function () {
    Route::get('speakers', function (Request $request) {
        return  \App\Http\Resources\SpeakerResource::collection(\App\Models\User::paginate());
    });

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});

