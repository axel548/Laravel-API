<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\Categorycontroller;
use App\Http\Controllers\Api\V1\Recipecontroller;
use App\Http\Controllers\Api\V1\Tagcontroller;

Route::prefix('v1')->group(function() {
    Route::get('categories', [Categorycontroller::class, 'index']);
    Route::get('categories/{category}', [Categorycontroller::class, 'show']);

    Route::apiResource('recipes', Recipecontroller::class);
    // Route::get('recipes', [Recipecontroller::class, 'index']);
    // Route::post('recipes', [Recipecontroller::class, 'store']);
    // Route::get('recipes/{recipe}', [Recipecontroller::class, 'show']);
    // Route::put('recipes/{recipe}', [Recipecontroller::class, 'update']);
    // Route::delete('recipes/{recipe}', [Recipecontroller::class, 'destroy']);


    Route::get('tags', [Tagcontroller::class, 'index']);
    Route::get('tags/{tag}', [Tagcontroller::class, 'show']);
});


