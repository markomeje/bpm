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

    Route::prefix('properties')->group(function () {
        Route::post('/all', [\App\Http\Controllers\Api\PropertiesController::class, 'all'])->name('api.properties');
        Route::post('/promoted', [\App\Http\Controllers\Api\PropertiesController::class, 'promoted']);
        Route::post('/categories', [\App\Http\Controllers\Api\PropertiesController::class, 'categories']);

        Route::post('/search', [\App\Http\Controllers\Api\PropertiesController::class, 'search'])->name('api.property.search');
        Route::post('/{type}/{filter?}', [\App\Http\Controllers\Api\PropertiesController::class, 'filter']);
    });

    Route::post('/materials', [\App\Http\Controllers\Api\MaterialsController::class, 'materials']);
    Route::post('/realtors', [\App\Http\Controllers\Api\RealtorsController::class, 'realtors']);
    Route::post('/services', [\App\Http\Controllers\Api\ServicesController::class, 'services']);

    Route::post('/units', [\App\Http\Controllers\Api\UnitsController::class, 'all']);
    Route::post('/skills', [\App\Http\Controllers\Api\SkillsController::class, 'all']);
    Route::post('/countries', [\App\Http\Controllers\Api\CountriesController::class, 'all']);
    Route::post('/currencies', [\App\Http\Controllers\Api\CurrencyController::class, 'all']);

    
    Route::post('/views/record', [\App\Http\Controllers\Api\ClicksController::class, 'record']);

    Route::post('/memberships/{package_id}', [\App\Http\Controllers\Api\MembershipController::class, 'find']);
    Route::post('/packages', [\App\Http\Controllers\Api\PackagesController::class, 'index']);

    Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'user'], function () {

        Route::prefix('payment')->group(function () {
            Route::post('/initialize', [\App\Http\Controllers\Api\PaymentController::class, 'initialize'])->name('api.subscription.initialize'); 
            Route::post('/status/{id}', [\App\Http\Controllers\Api\PaymentController::class, 'status'])->name('api.subscription.status');
        });

        Route::prefix('subscription')->group(function () {
            Route::post('/initialize', [\App\Http\Controllers\User\SubscriptionController::class, 'initialize'])->name('api.subscription.initialize'); 
            Route::post('/edit/{id}', [\App\Http\Controllers\User\SubscriptionController::class, 'edit'])->name('api.subscription.edit');
            Route::post('/delete/{id}', [\App\Http\Controllers\User\SubscriptionController::class, 'delete'])->name('api.subscription.delete');
        });

        Route::prefix('credit')->group(function () {
            Route::post('/buy', [\App\Http\Controllers\Api\CreditsController::class, 'buy'])->name('user.credit.buy');
            Route::post('/verify', [\App\Http\Controllers\User\CreditsController::class, 'verify'])->name('user.credit.verify');
        });

        Route::post('/account/delete/{id}', [\App\Http\Controllers\Api\UserController::class, 'delete'])->name('api.user.delete');

        Route::post('/credits', [\App\Http\Controllers\Api\UserController::class, 'credits'])->name('api.credits');
        Route::post('/payments', [\App\Http\Controllers\Api\UserController::class, 'payments'])->name('api.user.payments');

        Route::post('/services', [\App\Http\Controllers\Api\UserController::class, 'services'])->name('api.user.services');
        Route::post('/certifications', [\App\Http\Controllers\Api\UserController::class, 'certifications']);

        Route::prefix('certification')->group(function () {
            Route::post('/add', [\App\Http\Controllers\Api\CertificationsController::class, 'add']);
            Route::post('/edit/{id}', [\App\Http\Controllers\Api\CertificationsController::class, 'edit']);
            Route::post('/delete/{id}', [\App\Http\Controllers\Api\CertificationsController::class, 'delete']);
        });

        Route::prefix('service')->group(function () {
            Route::post('/create', [\App\Http\Controllers\Api\ServicesController::class, 'create']);
            Route::post('/edit/{id}', [\App\Http\Controllers\Api\ServicesController::class, 'edit']);
            Route::post('/delete/{id}', [\App\Http\Controllers\Api\ServicesController::class, 'delete']);
        });

        Route::prefix('property')->group(function () {
            Route::post('/all', [\App\Http\Controllers\Api\UserController::class, 'properties'])->name('api.property.all');
            Route::post('/add', [\App\Http\Controllers\Api\PropertiesController::class, 'add'])->name('api.property.add');
            Route::post('/action/change/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'action'])->name('api.property.action.change'); 
            Route::post('/update/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'update'])->name('api.property.edit');

            Route::post('/specifics/update/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'specifics'])->name('api.property.specifics.update');
            Route::post('/delete/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'delete'])->name('api.property.delete');
        });

        Route::prefix('promotions')->group(function () {
            Route::post('/promote', [\App\Http\Controllers\Api\PromotionsController::class, 'promote']);
            Route::post('/types', [\App\Http\Controllers\Api\PromotionsController::class, 'types']);
        });

        Route::prefix('profile')->group(function () {
            Route::post('/', [\App\Http\Controllers\Api\UserController::class, 'profile'])->name('api.user.profile');
            Route::post('/add', [\App\Http\Controllers\Api\ProfileController::class, 'add'])->name('api.profile.add');
            Route::post('/details', [\App\Http\Controllers\Api\ProfileController::class, 'details'])->name('api.profile.details');
            
            Route::post('/update/{id}', [\App\Http\Controllers\Api\ProfileController::class, 'edit'])->name('api.profile.update');
            Route::post('/company/details/update/{id}', [\App\Http\Controllers\Api\ProfileController::class, 'company'])->name('api.profile.company.update');
        });

        Route::prefix('image')->group(function () {
            Route::post('/upload', [\App\Http\Controllers\Api\ImagesController::class, 'upload'])->name('api.image.upload');
            Route::post('/multiple', [\App\Http\Controllers\Api\ImagesController::class, 'multiple'])->name('api.multiple.images.upload');
            Route::post('/delete', [\App\Http\Controllers\Api\ImagesController::class, 'delete'])->name('api.image.delete');


            Route::post('/mobile', [\App\Http\Controllers\Api\ImagesController::class, 'mobile'])->name('api.image.mobile');
        });

        Route::prefix('advert')->group(function () {
            Route::post('/all', [\App\Http\Controllers\Api\UserController::class, 'adverts'])->name('api.advert.all');
            Route::post('/sizes', [\App\Http\Controllers\Api\AdvertsController::class, 'sizes'])->name('api.advert.sizes');

            Route::post('/post', [\App\Http\Controllers\Api\AdvertsController::class, 'post'])->name('api.advert.post');
            Route::post('/edit/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'edit'])->name('api.advert.edit');
            Route::post('/edit/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'edit'])->name('api.advert.edit'); 
            Route::post('/delete/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'delete'])->name('api.advert.delete');

            Route::post('/pause/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'pause'])->name('api.advert.pause');
            Route::post('/resume/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'resume'])->name('api.advert.resume');
            Route::post('/activate/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'activate'])->name('api.advert.activate');
        });

        Route::post('/materials', [\App\Http\Controllers\Api\UserController::class, 'materials'])->name('api.user.materials');
        Route::prefix('material')->group(function () {
            Route::post('/add', [\App\Http\Controllers\Api\MaterialsController::class, 'add'])->name('api.material.add'); 
            Route::post('/edit/{id}', [\App\Http\Controllers\Api\MaterialsController::class, 'edit'])->name('api.material.edit');
            Route::post('/delete/{id}', [\App\Http\Controllers\Api\MaterialsController::class, 'delete'])->name('api.material.delete');
        });

        Route::prefix('socials')->group(function () {
            Route::post('/companies', [\App\Http\Controllers\Api\SocialsController::class, 'companies'])->name('api.social.companies');
            Route::post('/add', [\App\Http\Controllers\Api\SocialsController::class, 'add'])->name('api.social.add');
            Route::post('/edit/{id}', [\App\Http\Controllers\Api\SocialsController::class, 'edit'])->name('api.social.edit');
            Route::post('/delete/{id}', [\App\Http\Controllers\Api\SocialsController::class, 'delete'])->name('api.social.delete');
        });

    });
});
