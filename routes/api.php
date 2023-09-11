<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BebidasController;

/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::get('/', function() {
        return response()-> json([
        'Success' => true
    ]);
});

Route::get('/bebidas',[BebidasController::class,'index']);
Route::get('/bebidas{id}',[BebidasController::class,'show']);
Route::post('/bebidas',[BebidasController::class,'store']);
Route::delete('/bebidas{id}',[BebidasController::class,'destroy']);
Route::put('/bebidas/{id}',[BebidasController::class,'update']);
