<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\CityReviewController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::resource('/reviews', ReviewController::class)->only(['store', 'update', 'destroy']);

Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/users/{id}/reviews', [UserReviewController::class, 'index'])->name('users.reviews.index');

Route::get('/city', [CityReviewController::class, 'index'])->name('city.reviews.index');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });
    Route::resource('/reviews', ReviewController::class)->only(['store', 'update', 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);
