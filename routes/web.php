<?php

use App\Http\Controllers\api\v1\RequestController;
use Illuminate\Support\Facades\Route;


require_once __DIR__.'/api.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/requests', [RequestController::class, 'get']);

