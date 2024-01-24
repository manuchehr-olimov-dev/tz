<?php

use App\Http\Controllers\api\v1\RequestController;
use App\Models\Request;
use Illuminate\Support\Facades\Route;


require_once __DIR__.'/api.php';

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin');
});

Route::get('/solve-request/{id}', [RequestController::class, 'solveRequestPage']);

