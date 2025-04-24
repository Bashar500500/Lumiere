<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Message\MessageController;
use App\Http\Controllers\Reply\ReplyController;
use App\Http\Controllers\Notification\NotificationController;
// use App\Http\Controllers\User\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::middleware('auth:sanctum')->group(function () {

//     Route::apiResource('chat', ChatController::class)->only(['index', 'show', 'store']);
//     Route::apiResource('message', MessageController::class)->only(['index', 'store']);
//     Route::apiResource('user', UserController::class)->only(['index']);
//     Route::apiResource('notification', NotificationController::class)->except(['show', 'update']);

// });

Route::apiResource('chat', ChatController::class)->except(['update']);
Route::apiResource('message', MessageController::class)->except(['show']);
Route::apiResource('reply', ReplyController::class)->except(['show', 'index']);
Route::apiResource('notification', NotificationController::class)->except(['show', 'update']);
// Route::apiResource('user', UserController::class)->only(['index']);
