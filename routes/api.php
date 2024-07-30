<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LoginController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('login', [LoginController::class, 'store']);

Route::middleware('auth:sanctum')->group(function() {

    require __DIR__.'/api_V1.php';
    require __DIR__.'/api_V2.php';
});


