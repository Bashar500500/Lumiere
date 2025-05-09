<?php

use App\Http\Controllers\Auth\CustomPasswordResetController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Category\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Chat\ChatController;
use App\Http\Controllers\Message\MessageController;
use App\Http\Controllers\Reply\ReplyController;
use App\Http\Controllers\Notification\NotificationController;
use App\Http\Controllers\Course\CourseController;
use App\Http\Controllers\Permission\PermissionController;
use App\Http\Controllers\Permission\PermissionToUserController;
use App\Http\Controllers\SubCategory\SubCategoryController;
use App\Http\Controllers\User\AssignRoleController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserProfileController;

// use App\Http\Controllers\User\UserController;

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
});
////user
Route::middleware('auth:api')->prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{user}', [UserController::class, 'show']);
});
    

/////password
Route::post('/forgot-password-code', [CustomPasswordResetController::class, 'sendResetCode']);
Route::post('/reset-password-code', [CustomPasswordResetController::class, 'verifyResetCode']);

//////profile
Route::middleware('auth:api')->prefix('user_profile')->group(function () {
    Route::get('/', [UserProfileController::class, 'show']);
    Route::post('/', [UserProfileController::class, 'store']);
    Route::put('/', [UserProfileController::class, 'update']);
});
/////add and delete permissions for user
// Route::middleware(['auth:api'])->prefix('admin')->group(function () {
//     Route::post('permissions/assign', [PermissionController::class, 'assign']);
//     Route::post('permissions/revoke', [PermissionController::class, 'revoke']);
// });
///// permission
Route::middleware(['auth:api'])->prefix('permissions')->group(function () {
    Route::post('/', [PermissionController::class, 'store']);
    Route::get('/', [PermissionController::class, 'index']);
    Route::put('/{permission}', [PermissionController::class, 'update']);
    Route::delete('/{permission}', [PermissionController::class, 'destroy']);
    Route::get('/roles/{role}', [PermissionController::class, 'getPermissionsByRole']);
    Route::get('/users/{user}', [PermissionController::class, 'getPermissionsByUser']);
});


////assign and revoke permission for user
Route::middleware(['auth:api'])->prefix('permissions')->group(function () {
    Route::post('/assign', [PermissionToUserController::class, 'assignPermission']);
    Route::post('/revoke', [PermissionToUserController::class, 'revokePermission']);
});

//     Route::apiResource('chat', ChatController::class)->only(['index', 'show', 'store']);
//     Route::apiResource('message', MessageController::class)->only(['index', 'store']);
//     Route::apiResource('user', UserController::class)->only(['index']);
//     Route::apiResource('notification', NotificationController::class)->except(['show', 'update']);

// });

Route::apiResource('chat', ChatController::class)->except(['update']);
Route::apiResource('message', MessageController::class)->except(['show']);
Route::apiResource('reply', ReplyController::class)->except(['show', 'index']);
Route::apiResource('notification', NotificationController::class)->except(['show', 'update']);
Route::apiResource('course', CourseController::class);
Route::apiResource('category', CategoryController::class);
Route::apiResource('sub_category', SubCategoryController::class);
// Route::apiResource('user', UserController::class)->only(['index']);
