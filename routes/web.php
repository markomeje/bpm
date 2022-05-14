<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['web'])->domain(env('APP_URL'))->group(function() {
    Route::get('/translate', [\App\Http\Controllers\TranslationController::class, 'index'])->name('translate');

    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/about', [\App\Http\Controllers\AboutController::class, 'index'])->name('about');

    Route::get('/logout', [\App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login'])->name('auth.login');
    
    Route::group(['prefix' => 'login', 'middleware' => 'guest'], function () {
        Route::get('/', [\App\Http\Controllers\LoginController::class, 'index'])->name('login');
    });

    Route::group(['prefix' => 'signup', 'middleware' => 'guest'], function () {
        Route::get('/', [\App\Http\Controllers\SignupController::class, 'index'])->name('signup');
        Route::post('/signup', [\App\Http\Controllers\Api\AuthController::class, 'signup'])->name('auth.signup');
        Route::get('/success', [\App\Http\Controllers\SignupController::class, 'success'])->name('signup.success');
    });

    Route::group(['prefix' => 'verify'], function () {
        Route::get('/phone/{reference}', [\App\Http\Controllers\VerifyController::class, 'phone'])->name('phone.verify');
        Route::post('/otp/{reference}', [\App\Http\Controllers\VerifyController::class, 'otpverify'])->name('otp.verify');
        Route::post('/resendotp/{reference}', [\App\Http\Controllers\VerifyController::class, 'resendotp'])->name('resend.otp');
        Route::get('/email/{token}', [\App\Http\Controllers\VerifyController::class, 'email'])->name('verify.email');
        Route::post('/resendtoken/{token}', [\App\Http\Controllers\VerifyController::class, 'resendtoken'])->name('token.resend');
        Route::get('/resent', [\App\Http\Controllers\VerifyController::class, 'resent'])->name('token.resent');
    });

    Route::prefix('contact')->group(function () {
        Route::get('/', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
        Route::post('/send', [\App\Http\Controllers\ContactController::class, 'send'])->name('contact.send');
        Route::get('/thanks', [\App\Http\Controllers\ContactController::class, 'thanks'])->name('contact.thanks');
    });

    Route::prefix('properties')->group(function () {
        Route::get('/', [\App\Http\Controllers\PropertiesController::class, 'index'])->name('properties');

        Route::post('/property/like', [\App\Http\Controllers\Api\PropertiesController::class, 'like'])->name('property.like');

        Route::get('/country/{iso2}', [\App\Http\Controllers\PropertiesController::class, 'country'])->name('properties.country');
        Route::get('/category/{category}', [\App\Http\Controllers\PropertiesController::class, 'category'])->name('properties.category');

        Route::get('/{category}/{id}/{slug}', [\App\Http\Controllers\PropertiesController::class, 'property'])->name('property.category.id.slug');
        Route::get('/{country}/{id}/{slug}', [\App\Http\Controllers\PropertiesController::class, 'country'])->name('property.country.id.slug');

        Route::get('/search', [\App\Http\Controllers\PropertiesController::class, 'search'])->name('properties.search');
        Route::get('/action/{action}', [\App\Http\Controllers\PropertiesController::class, 'action'])->name('properties.action');

        Route::get('/group/{group}', [\App\Http\Controllers\PropertiesController::class, 'group'])->name('properties.group');
    });

    Route::prefix('news')->group(function () {
        Route::get('/', [\App\Http\Controllers\NewsController::class, 'index'])->name('news');
        Route::get('/{id}/{slug}', [NewsController::class, 'read'])->name('news.read');
    });

    Route::prefix('blog')->group(function () {
        Route::get('/{category?}', [\App\Http\Controllers\BlogController::class, 'index'])->name('blog');
        Route::get('/{id}/{slug}', [\App\Http\Controllers\BlogController::class, 'read'])->name('blog.read');
    });

    Route::prefix('profiles')->group(function () {
        Route::get('/profile/{id}/{name}', [\App\Http\Controllers\ProfilesController::class, 'profile'])->name('account.profile');
    });

    Route::get('/dealers', [\App\Http\Controllers\DealersController::class, 'index'])->name('dealers');
    Route::get('/artisans', [\App\Http\Controllers\ArtisansController::class, 'index'])->name('artisans');
    Route::get('/realtors', [\App\Http\Controllers\RealtorsController::class, 'index'])->name('realtors');

    Route::group(['prefix' => 'password', 'middleware' => 'guest'], function () {
        Route::get('/', [\App\Http\Controllers\PasswordController::class, 'index'])->name('forgot.password');
        Route::post('/email', [\App\Http\Controllers\PasswordController::class, 'email'])->name('password.email');
        Route::get('/reset/{token}', [\App\Http\Controllers\PasswordController::class, 'verify'])->name('reset.verify');
        Route::post('/reset', [\App\Http\Controllers\PasswordController::class, 'reset'])->name('password.reset');
    });

    Route::prefix('materials')->group(function () {
        Route::get('/', [\App\Http\Controllers\MaterialsController::class, 'index'])->name('materials');
        Route::get('/category/{category}', [\App\Http\Controllers\MaterialsController::class, 'category'])->name('materials.category');

        Route::get('/{id}/{slug}', [\App\Http\Controllers\MaterialsController::class, 'material'])->name('material.id.slug');
        Route::get('/search', [\App\Http\Controllers\MaterialsController::class, 'search'])->name('materials.search');
    });

    Route::prefix('review')->group(function () {
        Route::post('/edit/{id}', [\App\Http\Controllers\Api\ReviewsController::class, 'edit'])->name('review.edit');
        Route::post('/add/{profileid}', [\App\Http\Controllers\Api\ReviewsController::class, 'add'])->name('review.add');
    });
});

Route::middleware(['web', 'auth', 'admin', 'revalidate'])->domain(env('ADMIN_URL'))->group(function() {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/countries', [\App\Http\Controllers\Admin\CountriesController::class, 'index'])->name('admin.countries');

    Route::prefix('staffs')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\StaffController::class, 'index'])->name('admin.staff');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\StaffController::class, 'edit'])->name('admin.staff.edit');

        Route::post('/edit/{id}', [\App\Http\Controllers\Api\StaffController::class, 'edit'])->name('admin.staff.edit');
        Route::post('/delete/{id}', [\App\Http\Controllers\Api\StaffController::class, 'delete'])->name('admin.staff.delete');
        Route::post('/add', [\App\Http\Controllers\Api\StaffController::class, 'add'])->name('admin.staff.add');
        Route::post('/status/{id}', [\App\Http\Controllers\Api\StaffController::class, 'status'])->name('admin.staff.status');
    });

    Route::prefix('permissions')->group(function () {
        Route::post('/assign', [\App\Http\Controllers\Api\PermissionsController::class, 'assign'])->name('admin.permission.assign');
        Route::post('/remove/{id}', [\App\Http\Controllers\Api\PermissionsController::class, 'remove'])->name('admin.permission.remove');
    });

    Route::prefix('subscriptions')->group(function () {
        Route::get('/{status?}', [\App\Http\Controllers\Admin\SubscriptionsController::class, 'index'])->name('admin.subscriptions');
    });

    Route::prefix('reviews')->group(function () {
        Route::get('/{status?}', [\App\Http\Controllers\Admin\SubscriptionsController::class, 'index'])->name('admin.reviews');
    });

    Route::prefix('adverts')->group(function () {
        Route::get('/{status?}', [\App\Http\Controllers\Admin\AdvertsController::class, 'index'])->name('admin.adverts');
    });

    Route::prefix('units')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\UnitsController::class, 'index'])->name('admin.units');
        Route::post('/edit/{id}', [\App\Http\Controllers\Api\UnitsController::class, 'edit'])->name('admin.unit.edit');
        Route::post('/delete/{id}', [\App\Http\Controllers\Api\UnitsController::class, 'delete'])->name('admin.unit.delete');
        Route::post('/add', [\App\Http\Controllers\Api\UnitsController::class, 'add'])->name('admin.unit.add');
    });

    Route::prefix('plans')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Admin\PlansController::class, 'add'])->name('admin.plan.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\PlansController::class, 'edit'])->name('admin.plan.edit');
    });

    Route::get('/skills', [\App\Http\Controllers\Admin\SkillsController::class, 'index'])->name('admin.skills');
    Route::prefix('skill')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Admin\SkillsController::class, 'add'])->name('admin.skill.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\SkillsController::class, 'edit'])->name('admin.skill.edit');
    });

    Route::prefix('payments')->group(function () {
        Route::get('/search/{query?}', [\App\Http\Controllers\Admin\PaymentsController::class, 'search'])->name('admin.payments.search');
        Route::get('/{type?}', [\App\Http\Controllers\Admin\PaymentsController::class, 'index'])->name('admin.payments');
    });

    Route::post('visitors/chart/timezone', [\App\Http\Controllers\Admin\Charts\VisitorsController::class, 'chart'])->name('admin.visitors.chart.timezones');

    Route::prefix('properties')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PropertiesController::class, 'index'])->name('admin.properties');

        Route::post('/chart/{year}', [\App\Http\Controllers\Admin\Charts\PropertiesController::class, 'chart'])->name('admin.properties.chart');

        Route::get('/search/{query?}', [\App\Http\Controllers\Admin\PropertiesController::class, 'search'])->name('admin.properties.search');

        Route::get('/categories', [\App\Http\Controllers\Admin\PropertiesController::class, 'categories'])->name('admin.properties.categories');

        Route::get('/country/{countryid}', [\App\Http\Controllers\Admin\PropertiesController::class, 'country'])->name('admin.properties.country');

        Route::get('/add', [\App\Http\Controllers\Admin\PropertiesController::class, 'add'])->name('admin.property.add');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\PropertiesController::class, 'edit'])->name('admin.property.edit');
        Route::get('/category/{category}', [\App\Http\Controllers\Admin\PropertiesController::class, 'category'])->name('admin.properties.category');


        Route::post('/add', [\App\Http\Controllers\Api\PropertiesController::class, 'add'])->name('admin.property.add');

        Route::post('/action/change/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'action'])->name('admin.property.action.change');

        Route::post('/update/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'update'])->name('admin.property.update');

        Route::post('/specifics/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'specifics'])->name('admin.property.specifics.update');


        Route::get('/action/{action}', [\App\Http\Controllers\Admin\PropertiesController::class, 'action'])->name('admin.properties.action');

        Route::post('/specifics/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'specifics'])->name('admin.property.specifics.update');
    });

    Route::get('/categories', [\App\Http\Controllers\Admin\CategoriesController::class, 'index'])->name('admin.categories');
    Route::prefix('category')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Admin\CategoriesController::class, 'add'])->name('admin.category.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Admin\CategoriesController::class, 'edit'])->name('admin.category.edit');
    });

    Route::prefix('memberships')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\MembershipsController::class, 'index'])->name('admin.memberships');
        Route::post('/add', [\App\Http\Controllers\Api\MembershipsController::class, 'add'])->name('admin.membership.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Api\MembershipsController::class, 'edit'])->name('admin.membership.edit');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\UsersController::class, 'index'])->name('admin.users');
        Route::get('/search', [\App\Http\Controllers\Admin\UsersController::class, 'search'])->name('admin.users.search');
        
        Route::get('/role/{role}', [\App\Http\Controllers\Admin\UsersController::class, 'role'])->name('admin.users.role');
        Route::get('/profile/{id}', [\App\Http\Controllers\Admin\UsersController::class, 'profile'])->name('admin.user.profile');
    });

    Route::prefix('blogs')->group(function () {

        Route::post('/store', [\App\Http\Controllers\Api\BlogsController::class, 'store'])->name('admin.blog.store');
        Route::post('/status/{id}', [\App\Http\Controllers\Api\BlogsController::class, 'status'])->name('admin.blog.status.update');
        Route::post('/delete/{id}', [\App\Http\Controllers\Api\BlogsController::class, 'delete'])->name('admin.blog.delete');
        Route::post('/edit/{id}', [\App\Http\Controllers\Api\BlogsController::class, 'edit'])->name('admin.blog.edit');

        Route::get('/add', [\App\Http\Controllers\Admin\BlogsController::class, 'add'])->name('admin.blog.add');
        Route::get('/edit/{id}', [\App\Http\Controllers\Admin\BlogsController::class, 'edit'])->name('admin.blog.edit');
        
        Route::get('/{category?}', [\App\Http\Controllers\Admin\BlogsController::class, 'index'])->name('admin.blogs');
    });

    Route::prefix('image')->group(function () {
        Route::post('/upload', [\App\Http\Controllers\Api\ImagesController::class, 'upload'])->name('admin.image.upload');
        Route::post('/multiple', [\App\Http\Controllers\Api\ImagesController::class, 'multiple'])->name('admin.multiple.images.upload');
        Route::match(['delete', 'post'], '/delete', [\App\Http\Controllers\Api\ImagesController::class, 'delete'])->name('admin.image.delete');
    });

});

Route::middleware(['web', 'auth', 'user', 'revalidate', 'profile.setup'])->domain(env('USER_URL'))->group(function() {
    Route::get('/', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/subscription', [\App\Http\Controllers\User\DashboardController::class, 'index'])->name('user.subscription');

    Route::prefix('services')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\ServicesController::class, 'index'])->name('user.services');
        Route::post('/create', [\App\Http\Controllers\Api\ServicesController::class, 'create'])->name('user.service.create');
        Route::post('/edit/{id}', [\App\Http\Controllers\Api\ServicesController::class, 'edit'])->name('user.service.edit');
    });

    Route::prefix('image')->group(function () {
        Route::post('/upload', [\App\Http\Controllers\Api\ImagesController::class, 'upload'])->name('user.image.upload');
        Route::post('/multiple', [\App\Http\Controllers\Api\ImagesController::class, 'multiple'])->name('user.multiple.images.upload');
        Route::match(['delete', 'post'], '/delete', [\App\Http\Controllers\Api\ImagesController::class, 'delete'])->name('user.image.delete');
    });

    Route::prefix('socials')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Api\SocialsController::class, 'add'])->name('user.social.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Api\SocialsController::class, 'edit'])->name('user.social.edit');
        Route::post('/delete/{id}', [\App\Http\Controllers\Api\SocialsController::class, 'delete'])->name('user.social.delete');
    });

    Route::prefix('certifications')->group(function () {
        Route::post('/add', [\App\Http\Controllers\Api\CertificationsController::class, 'add'])->name('user.certification.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Api\CertificationsController::class, 'edit'])->name('user.certification.edit');

        Route::post('/delete/{id}', [\App\Http\Controllers\Api\CertificationsController::class, 'delete'])->name('user.certification.delete');
    });

    Route::prefix('adverts')->group(function () {
        Route::post('/post', [\App\Http\Controllers\Api\AdvertsController::class, 'post'])->name('user.advert.post');
        Route::post('/edit/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'edit'])->name('user.advert.edit');
        Route::post('/pause/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'pause'])->name('user.advert.pause');
        
        Route::post('/resume/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'resume'])->name('user.advert.resume');

        Route::post('/activate/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'activate'])->name('user.advert.activate');
        Route::post('/delete/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'delete'])->name('user.advert.delete');
        Route::post('/renew/{id}', [\App\Http\Controllers\Api\AdvertsController::class, 'renew'])->name('user.advert.renew');

    });

    
    Route::prefix('promotions')->group(function () {
        Route::post('/promote', [\App\Http\Controllers\Api\PromotionsController::class, 'promote'])->name('user.promotions.promote');
    });

    Route::post('/image/upload/{id}', [\App\Http\Controllers\Api\ProfileController::class, 'upload'])->name('user.profile.image.upload');

    Route::prefix('profile')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\ProfileController::class, 'index'])->name('user.profile');
        Route::post('/add', [\App\Http\Controllers\Api\ProfileController::class, 'add'])->name('user.profile.add');
        Route::post('/edit/{id}', [\App\Http\Controllers\Api\ProfileController::class, 'edit'])->name('user.profile.edit');
        Route::post('/image/upload/{id}', [\App\Http\Controllers\Api\ProfileController::class, 'remove'])->name('user.profile.image.remove');
        Route::post('/company/details/{id}', [\App\Http\Controllers\Api\ProfileController::class, 'company'])->name('user.profile.company.update');
    });

    Route::get('/credits', [\App\Http\Controllers\User\CreditsController::class, 'index'])->name('user.credits');
    Route::get('/reviews', [\App\Http\Controllers\User\ReviewsController::class, 'index'])->name('user.reviews');

    Route::post('/initialize', [App\Http\Controllers\User\SubscriptionController::class, 'initialize'])->name('user.subscription.payment.initialize');

    Route::post('/cancel/{id}', [\App\Http\Controllers\User\SubscriptionController::class, 'cancel'])->name('user.subscription.cancel');
    Route::post('/renew/{id}', [\App\Http\Controllers\User\SubscriptionController::class, 'renew'])->name('user.subscription.renew');
    Route::post('/activate/{id}', [\App\Http\Controllers\User\SubscriptionController::class, 'activate'])->name('user.subscription.activate');

    Route::post('/credits/buy', [\App\Http\Controllers\User\CreditsController::class, 'buy'])->name('user.credits.buy');

    Route::prefix('properties')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\PropertiesController::class, 'index'])->name('user.properties');

        Route::get('/edit/{category}/{id}', [\App\Http\Controllers\User\PropertiesController::class, 'edit'])->name('user.property.edit');
        Route::get('/add', [\App\Http\Controllers\User\PropertiesController::class, 'add'])->name('user.property.add');

        Route::post('/specifics/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'specifics'])->name('user.property.specifics.update');
        Route::post('/update/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'update'])->name('user.property.update');
        Route::post('/add', [\App\Http\Controllers\Api\PropertiesController::class, 'add'])->name('user.property.add');

        Route::post('/action/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'action'])->name('user.property.action.change');
        Route::post('/delete/{id}', [\App\Http\Controllers\Api\PropertiesController::class, 'delete'])->name('user.property.delete');
    });

    Route::prefix('materials')->group(function () {
        Route::get('/', [\App\Http\Controllers\User\MaterialsController::class, 'index'])->name('user.materials');

        Route::get('/edit/{id}', [\App\Http\Controllers\User\MaterialsController::class, 'edit'])->name('user.material.edit');
        Route::get('/add', [\App\Http\Controllers\User\MaterialsController::class, 'add'])->name('user.material.add');

        Route::post('/edit/{id}', [\App\Http\Controllers\Api\MaterialsController::class, 'edit'])->name('user.material.edit');
        Route::post('/add', [\App\Http\Controllers\Api\MaterialsController::class, 'add'])->name('user.material.add');
    });
});

Route::middleware(['web', 'auth', 'blogger', 'revalidate'])->domain(env('BLOG_URL'))->group(function() {
    Route::get('/', [\App\Http\Controllers\Blog\BlogController::class, 'index'])->name('blog.dashboard');
    Route::post('/store', [\App\Http\Controllers\Api\BlogsController::class, 'store'])->name('blog.store');
    Route::post('/status/{id}', [\App\Http\Controllers\Api\BlogsController::class, 'status'])->name('blog.status.update');

    Route::post('/delete/{id}', [\App\Http\Controllers\Api\BlogsController::class, 'delete'])->name('blog.delete');
    Route::post('/edit/{id}', [\App\Http\Controllers\Api\BlogsController::class, 'edit'])->name('blog.edit');

    Route::get('/add', [\App\Http\Controllers\Blog\BlogController::class, 'add'])->name('blog.add');
    Route::get('/edit/{id}', [\App\Http\Controllers\Blog\BlogController::class, 'edit'])->name('blog.edit');
    
    Route::get('category/{category?}', [\App\Http\Controllers\Blog\BlogController::class, 'index'])->name('blog.category');

    Route::prefix('image')->group(function () {
        Route::post('/upload', [\App\Http\Controllers\Api\ImagesController::class, 'upload'])->name('admin.image.upload');
    });

});

Route::middleware(['web', 'auth'])->get('/dashboard', function () {
    $role = auth()->user()->role;
    switch ($role) {
        case 'blogger':
            $sudomain = 'blog';
            break;
        case 'user':
            $sudomain = 'user';
            break;
        default:
            $sudomain = 'admin';
            break;
    }

    return redirect()->route("{$sudomain}.dashboard");
})->name('dashboard');

Route::fallback(function () {
    Route::middleware(['web'])->domain('https://www.bestpropertymarket.com')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
    });

    return redirect()->route('home');
});



    

