<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/send-message', [ChatController::class, 'sendMessage']);
Route::get('/chat', function () {
    return view('chat');
});