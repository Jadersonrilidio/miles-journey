<?php

use App\Http\Controllers\Api\TestimonyController;
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

Route::controller(TestimonyController::class)
    ->whereUuid('testimony:uuid')
    ->missing(fn () => Response::notFound())
    ->group(function () {
        Route::get('testimonies-home', 'home')->name('testimonies.home');

        Route::get('testimonies', 'index')->name('testimonies.index');
        Route::post('testimonies', 'store')->name('testimonies.store');
        Route::get('testimonies/{testimony:uuid}', 'show')->name('testimonies.show');
        Route::delete('testimonies/{testimony:uuid}', 'destroy')->name('testimonies.destroy');
        Route::match(['put', 'patch'], 'testimonies/{testimony:uuid}', 'update')->name('testimonies.update');
    });
