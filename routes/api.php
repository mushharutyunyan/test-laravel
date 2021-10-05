<?php

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

Route::group(['middleware' => 'auth:api'],function () {
    Route::group(['prefix' => 'v1'], function () {
        // LEAGUES
        Route::group(['prefix' => 'leagues'], function () {
            // Queries
            Route::get('/', [\App\Http\Controllers\Api\V1\Leagues\QueryController::class,'index']);
            Route::get('/{id}', [\App\Http\Controllers\Api\V1\Leagues\QueryController::class,'show'])->middleware(['league.exists']);

            // Commands
            Route::post('/', [\App\Http\Controllers\Api\V1\Leagues\CommandController::class,'store']);
            Route::patch('/{id}', [\App\Http\Controllers\Api\V1\Leagues\CommandController::class,'update'])->middleware(['league.exists']);
            Route::delete('/{id}', [\App\Http\Controllers\Api\V1\Leagues\CommandController::class,'delete'])->middleware(['league.exists']);
        });

        // CLUBS
        Route::group(['prefix' => 'clubs'], function () {
            // Queries
            Route::get('/', [\App\Http\Controllers\Api\V1\Clubs\QueryController::class,'index']);
            Route::get('/{id}', [\App\Http\Controllers\Api\V1\Clubs\QueryController::class,'show'])->middleware(['club.exists']);
            Route::get('/league/{id}', [\App\Http\Controllers\Api\V1\Clubs\QueryController::class,'byLeague'])->middleware(['league.exists']);

            // Commands
            Route::post('/', [\App\Http\Controllers\Api\V1\Clubs\CommandController::class,'store']);
            Route::patch('/{id}', [\App\Http\Controllers\Api\V1\Clubs\CommandController::class,'update'])->middleware(['club.exists']);
            Route::delete('/{id}', [\App\Http\Controllers\Api\V1\Clubs\CommandController::class,'delete'])->middleware(['club.exists']);
        });

        // COACHES
        Route::group(['prefix' => 'coaches'], function () {
            // Queries
            Route::get('/', [\App\Http\Controllers\Api\V1\Coaches\QueryController::class,'index']);
            Route::get('/{id}', [\App\Http\Controllers\Api\V1\Coaches\QueryController::class,'show'])->middleware(['coach.exists']);

            // Commands
            Route::post('/', [\App\Http\Controllers\Api\V1\Coaches\CommandController::class,'store']);
            Route::patch('/{id}', [\App\Http\Controllers\Api\V1\Coaches\CommandController::class,'update'])->middleware(['coach.exists']);
            Route::delete('/{id}', [\App\Http\Controllers\Api\V1\Coaches\CommandController::class,'delete'])->middleware(['coach.exists']);
        });

        // FOOTBALLERS
        Route::group(['prefix' => 'footballers'], function () {
            // Queries
            Route::get('/', [\App\Http\Controllers\Api\V1\Footballers\QueryController::class,'index']);
            Route::get('/{id}', [\App\Http\Controllers\Api\V1\Footballers\QueryController::class,'show'])->middleware(['footballer.exists']);

            // Commands
            Route::post('/', [\App\Http\Controllers\Api\V1\Footballers\CommandController::class,'store']);
            Route::patch('/{id}', [\App\Http\Controllers\Api\V1\Footballers\CommandController::class,'update'])->middleware(['footballer.exists']);
            Route::delete('/{id}', [\App\Http\Controllers\Api\V1\Footballers\CommandController::class,'delete'])->middleware(['footballer.exists']);
        });
    });
});
