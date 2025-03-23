<?php

use Illuminate\Support\Facades\Route;
use App\Http\Responses\Response;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertySetController;
use App\Http\Controllers\PropertyController;

Route::get('/', function () {
    return new Response();
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
});

Route::group(['prefix' => 'property-sets'], function () {
    Route::get('/', [PropertySetController::class, 'index'])->name('property-sets.index');
    Route::get('/{property_set}', [PropertySetController::class, 'show'])->name('property-sets.show');

    Route::group(['middleware' => ['auth.jwt']], function () {
        Route::post('/', [PropertySetController::class, 'store'])->name('property-sets.store');
        Route::patch('/{property_set}', [PropertySetController::class, 'update'])->name('property-sets.update');
        Route::delete('/{property_set}', [PropertySetController::class, 'destroy'])->name('property-sets.destroy');
    });

    Route::group(['prefix' => '{property_set}/properties'], function () {
        Route::get('/', [PropertyController::class, 'index'])->name('property-sets.properties.index');
        Route::get('/{property}', [PropertyController::class, 'show'])->name('property-sets.properties.show');

        Route::group(['middleware' => ['auth.jwt']], function () {
            Route::post('/', [PropertyController::class, 'store'])->name('property-sets.properties.store');
            Route::patch('/{property}', [PropertyController::class, 'update'])->name('property-sets.properties.update');
            Route::delete('/{property}', [PropertyController::class, 'destroy'])->name('property-sets.properties.destroy');
        });
    });
});
