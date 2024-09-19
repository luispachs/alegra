<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/order/post', function (Request $request) {
    return $request->user();
});
