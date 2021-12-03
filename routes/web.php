<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function(){
    return view('index');
});

Route::get('/search', [ContactController::class,'show']);
Route::post('/confirm', [ContactController::class,'confirm']);
Route::post('/thanks', [ContactController::class, 'send']);
Route::get('/search', [ContactController::class, 'search']);
Route::post('/search', [ContactController::class, 'remove']);