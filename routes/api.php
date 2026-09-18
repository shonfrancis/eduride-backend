<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdvertisementController;
use App\Http\Controllers\Api\TaxonomyController;
use App\Http\Controllers\Api\CmsController;

Route::prefix('v1')->group(function () {
    
    // Auth Routes
    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
        
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::get('/me', [AuthController::class, 'me']);
        });
    });

    // Public Advertisement Routes
    Route::get('/advertisements', [AdvertisementController::class, 'index']);
    Route::get('/advertisements/{slug}', [AdvertisementController::class, 'show']);

    // Protected Advertisement Routes
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/my/advertisements', [AdvertisementController::class, 'myAds']);
        Route::post('/my/advertisements', [AdvertisementController::class, 'store']);
        Route::put('/my/advertisements/{id}', [AdvertisementController::class, 'update']);
        Route::delete('/my/advertisements/{id}', [AdvertisementController::class, 'destroy']);
    });

    // Taxonomies
    Route::get('/categories', [TaxonomyController::class, 'categories']);
    Route::get('/subjects', [TaxonomyController::class, 'subjects']);
    Route::get('/education-levels', [TaxonomyController::class, 'educationLevels']);
    Route::get('/locations', [TaxonomyController::class, 'locations']);

    // CMS & Settings
    Route::get('/cms/pages/{slug}', [CmsController::class, 'page']);
    Route::get('/cms/faqs', [CmsController::class, 'faqs']);
    Route::get('/cms/home-banners', [CmsController::class, 'homeBanners']);
    Route::get('/cms/seo/{page}', [CmsController::class, 'seo']);
    Route::get('/cms/site-settings', [CmsController::class, 'siteSettings']);
    Route::get('/cms/social-media', [CmsController::class, 'socialMediaLinks']);
    Route::get('/cms/contact-info', [CmsController::class, 'contactInfo']);
});
