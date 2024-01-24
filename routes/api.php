<?php

use App\Http\Controllers\api\v1\RequestController;
use Illuminate\Support\Facades\Route;


Route::prefix('/v1')->controller(RequestController::class)->group(function (){

        Route::get('/get-requests', 'read');
        Route::post('/send-request', 'create');
        Route::put('/requests/{id}', 'put');

});

