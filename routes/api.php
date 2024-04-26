<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\DepotVoitureController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\FournisseurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::middleware('api')->group(function () {
    Route::resource('articles', ArticleController::class);
    });

    Route::middleware('api')->group(function () {
        Route::resource('depots', DepotVoitureController::class);
        });
        Route::middleware('api')->group(function () {
            Route::resource('fournisseurs', FournisseurController::class);
            });

            Route::middleware('api')->group(function () {
                Route::resource('commandes', CommandeController::class);
                });

        Route::middleware('api')->group(function () {
            Route::resource('factures', FactureController::class);
            });

            Route::get('/fact/{idfact}',
            [FactureController::class,'showFactureByArticle']);
            
            Route::get('/depot/{iddep}',
            [FactureController::class,'showFactureByDepot']);

            Route::post('/login', [LoginController::class, 'login']);
            Route::post('/register', [RegisterController::class, 'register']);
            Route::middleware('auth:sanctum')->post('/logout', [LoginController::class,
            'logout']);

            
            
