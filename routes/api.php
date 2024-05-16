<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\DestinationController;
use App\Http\Responses\ApiResponse as Response;
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

Route::controller(ReviewController::class)
    ->whereUuid('review:uuid')
    ->missing(fn () => Response::notFound())
    ->group(function () {
        Route::get('reviews', 'index')->name('reviews.index');
        Route::get('reviews/{review:uuid}', 'show')->name('reviews.show');
        Route::get('reviews-home', 'home')->name('reviews.home');

        Route::middleware('auth:sanctum')->group(function () {
            Route::post('reviews', 'store')->name('reviews.store');
            Route::delete('reviews/{review:uuid}', 'destroy')->name('reviews.destroy');
            Route::match(['put', 'patch'], 'reviews/{review:uuid}', 'update')->name('reviews.update');
        });
    });

Route::controller(DestinationController::class)
    ->whereUuid('destination:uuid')
    ->missing(fn () => Response::notFound())
    ->group(function () {
        Route::get('destinations/{destination:uuid}', 'show')->name('destinations.show');
        
        Route::get('destinations', 'index')->name('destinations.index');
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('destinations', 'store')->name('destinations.store');
            Route::delete('destinations/{destination:uuid}', 'destroy')->name('destinations.destroy');
            Route::match(['put', 'patch'], 'destinations/{destination:uuid}', 'update')->name('destinations.update');
        });
    });

Route::controller(AuthController::class)->prefix('/auth')->group(function () {
    Route::post('/login', 'login')->name('auth.login');
    Route::post('/register', 'register')->name('auth.register');
    Route::middleware('auth:sanctum')->get('/me', 'me')->name('auth.me');
});
