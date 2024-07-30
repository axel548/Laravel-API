<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V2\Recipecontroller;


Route::prefix('v2')->group(function() {
    Route::apiResource('recipes', Recipecontroller::class);
});


