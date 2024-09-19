<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/auth',[AuthController::class ,'index']);

Route::get('/order/post', function (Request $request) {
    return $request->user();
});
