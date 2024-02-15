<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedbackController;

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
Route::middleware('guest')->group(function() {
    Route::post('/login', [AuthController::class, 'logIn']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/is-email-exists', [AuthController::class, 'isEmailExists']);
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logOut']);
    Route::get('/logout', [AuthController::class, 'getCurrentUser']);

    Route::prefix('feedbacks')->group(function () {
        Route::post('/', [FeedbackController::class, 'store']);
        Route::post('/{id}', [FeedbackController::class, 'update']);
        Route::get('/', [FeedbackController::class, 'index']);
        Route::get('/{id}', [FeedbackController::class, 'get']);
        Route::delete('/{id}', [FeedbackController::class, 'delete']);
    });

    Route::prefix('comments')->group(function () {
        Route::post('/', [CommentController::class, 'store']);
        Route::post('/{id}', [CommentController::class, 'update']);
        Route::get('/', [CommentController::class, 'index']);
        Route::get('/{id}', [CommentController::class, 'get']);
        Route::delete('/{id}', [CommentController::class, 'delete']);
    });
});
