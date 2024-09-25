<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AuthController,OrdenController,WarehouseController};
use App\Http\Middleware\AuthorizationMiddleware;

/**
 * Route for user creation, this has not security methods, DON'T ENABLE
 */
//Route::post('/user/create',[UserController::class ,'create']);

Route::post('/auth',[AuthController::class ,'index']);
Route::post('/auth/validate',[AuthController::class ,'validate']);
Route::middleware([AuthorizationMiddleware::class])->group(function(){
    Route::put('/kitchen/orden/put',[OrdenController::class,'set']);
    Route::get('/kitchen/orden',[OrdenController::class,'getAll']);
    Route::get('/warehoue/purchase-history',[WarehouseController::class,'index']);
    Route::get('/kitchen/ingredient-list',[OrdenController::class,'getIngredients']);
});

