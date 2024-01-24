<?php

use App\Http\Controllers\api\v1\RequestController;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->controller(RequestController::class)->group(function (){
        Route::put('/requests/{id}', 'put');
        Route::post('/send-request', 'create');
});

