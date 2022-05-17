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

Route::domain(env('API_URL'))->group(function() {
    Route::post('/signup', [\App\Http\Controllers\Api\AuthController::class, 'signup'])->name('api.signup');
    Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('api.login');

    Route::post('/password/reset', [\App\Http\Controllers\Api\PasswordController::class, 'reset'])->name('api.password.reset');
    Route::post('/reset/process', [\App\Http\Controllers\Api\PasswordController::class, 'process'])->name('api.reset.process');

    Route::post('/otp/verify/{reference}', [\App\Http\Controllers\Api\VerifyController::class, 'otpverify'])->name('otp.verify');
    Route::post('/otp/resend/{reference}', [\App\Http\Controllers\Api\VerifyController::class, 'resendotp'])->name('resend.otp');

    Route::post('/token/resend', [\App\Http\Controllers\Api\VerifyController::class, 'resendtoken'])->name('token.resend');

    Route::post('/email/verify/{token}', [\App\Http\Controllers\Api\VerifyController::class, 'verifyemail'])->name('verify.email');

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::prefix('properties')->group(function () {
            Route::post('/all', [\App\Http\Controllers\Api\PropertiesController::class, 'all'])->name('api.property.all');

            Route::post('/add', [\App\Http\Controllers\Api\PropertiesController::class, 'add'])->name('api.property.add');

            Route::post('/action/change/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'action'])->name('api.property.action.change');

            Route::post('/update/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'update'])->name('api.property.update');

            Route::post('/specifics/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'specifics'])->name('api.property.specifics.update');
        });

        Route::prefix('image')->group(function () {
            Route::post('/upload', [\App\Http\Controllers\Api\ImagesController::class, 'upload'])->name('api.image.upload');
            Route::post('/multiple', [\App\Http\Controllers\Api\ImagesController::class, 'multiple'])->name('api.multiple.images.upload');
            Route::match(['delete', 'post'], '/delete', [\App\Http\Controllers\Api\ImagesController::class, 'delete'])->name('api.image.delete');
        });

        Route::prefix('material')->group(function () {
            Route::post('/add', [\App\Http\Controllers\Api\MaterialsController::class, 'add'])->name('api.material.add');

            Route::post('/update/{id}', [\App\Http\Controllers\Api\MaterialsController::class, 'update'])->name('api.material.update');

            Route::post('/image/upload/{id}/{role}', [\App\Http\Controllers\Api\MaterialsController::class, 'image'])->name('api.material.image.upload');
        });

    });
});
