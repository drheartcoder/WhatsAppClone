<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\ChatroomController;
use App\Http\Controllers\MessageController;

Route::middleware('auth:sanctum')->group(function () {
   Route::post('/chatrooms', [ChatroomController::class, 'create']);
   Route::get('/chatrooms', [ChatroomController::class, 'index']);
   Route::post('/chatrooms/{chatroom}/join', [ChatroomController::class, 'join']);
   Route::post('/chatrooms/{chatroom}/leave', [ChatroomController::class, 'leave']);
   Route::post('/chatrooms/{chatroom}/messages', [MessageController::class, 'sendMessage']);
   Route::get('/chatrooms/{chatroom}/messages', [MessageController::class, 'listMessages']);
});

