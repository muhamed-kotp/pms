<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HumanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\ExpertController;
use App\Http\Controllers\VisionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MissionController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QualityController;
use App\Http\Controllers\DivisionController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\NewsuserController;
use App\Http\Controllers\WebannerController;
use App\Http\Controllers\ManegmentController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...
        //About
        // Route::resource('/about',AboutController::class)->only(['index', 'show']);
         //Divisions
        // Route::resource('/divisions',DivisionController::class)->only(['index', 'show']);
        //  //Divisions
        // Route::resource('/divisions',DivisionController::class)->only(['index', 'show']);
        //  //Divisions
        // Route::resource('/divisions',DivisionController::class)->only(['index', 'show']);
         //Partners
        Route::get('/division/{id}',[FrontendController::class,'division'])->name('division');
        Route::get('/event/{id}',[FrontendController::class,'showEvent'])->name('event');
        Route::get('/partners',[FrontendController::class,'partners'])->name('partners');
        Route::get('/events',[FrontendController::class,'events'])->name('Frontevents');
        Route::get('/careers',[FrontendController::class,'careers'])->name('careers');
        Route::get('/contact',[FrontendController::class,'contact'])->name('contact');
        Route::get('/manegments',[FrontendController::class,'manegments'])->name('about.2');
        Route::get('/profiles',[FrontendController::class,'profiles'])->name('about.1');
        Route::get('/values',[FrontendController::class,'values'])->name('about.3');
        Route::post('/newsuser',[FrontendController::class,'newsuser'])->name('newsuser.store');
        Route::post('contact', [AdminController::class, 'contactEmail'])->name('contactEmail');

        // Career
            Route::post('careers', [AdminController::class, 'careersEmail'])->name('careersEmail');
        //Home
        Route::get('/', [HomeController::class, 'home'])->name('home');
    });

    Route::group(
        [
            'prefix' => 'admin',
            'middleware' => [ 'auth:sanctum' ]
        ], function(){ //...
        //Banners
        Route::resource('/banners',BannerController::class);
        //Who We Are Banners
        Route::resource('/webanners',WebannerController::class);
        //About
        Route::resource('/abouts',AboutController::class);
        //Partners
        Route::resource('/partners',PartnerController::class);
        //Careers
        Route::resource('/careers',CareerController::class);
        //Divisions
        Route::resource('/divisions',DivisionController::class);
        //Events
        Route::resource('/events',EventController::class);
        //Messions
        Route::resource('/missions',MissionController::class);
        //visions
        Route::resource('/visions',VisionController::class);
        //Skills
        Route::resource('/skills',SkillController::class);
        //Qualities
        Route::resource('/qualities',QualityController::class);
        //Humans
        Route::resource('/humans',HumanController::class);
        //Experts
        Route::resource('/experts',ExpertController::class);
        //Contact
        Route::resource('/contacts',ContactController::class);
        //Contact
        Route::resource('/manegments',ManegmentController::class);
        //Contact
        Route::resource('/newsusers',NewsuserController::class);
        //Contact
        Route::resource('/profiles',ProfileController::class);

        Route::get('users',[AdminController::class, 'users'])->name('users');
        Route::get('/',[AdminController::class, 'index'])->name('admin');
    });
    Route::get('/login', [LoginController::class,'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class,'login'])->name('supmitlogin');
