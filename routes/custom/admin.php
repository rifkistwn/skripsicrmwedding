<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\News\NewsController;
use App\Http\Controllers\Admin\News\NewsImageController;
use App\Http\Controllers\Admin\PacketController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\Venue\VenueController;
use App\Http\Controllers\Admin\Venue\VenueImageController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GalleryImageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;

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

Route::group(['middleware'=> 'auth'], function() {
    Route::group(['middleware'=> 'role:admin'],function() {
        Route::name('admin.')->group(function(){
            Route::prefix('dashboard')->group(function(){
                Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
            });
            Route::resource('packet', PacketController::class);
            Route::resource('venue', VenueController::class);
            Route::resource('news', NewsController::class);
            Route::resource('promo', PromoController::class);
            Route::resource('event', EventController::class);
            Route::resource('transaction', TransactionController::class);
            Route::resource('gallery', GalleryController::class);
            Route::resource('user', UserController::class);
            Route::resource('question', QuestionController::class);

            Route::prefix('venue')->group(function(){
                Route::get('image/{id}', [VenueController::class, 'image'])->name('venue.image');
                Route::post('upload-Image/', [VenueImageController::class, 'store'])->name('venue.uploadImage');
                Route::post('delete-Image/', [VenueImageController::class, 'destroy'])->name('venue.deleteImage');
            });
            Route::prefix('news')->group(function(){
                Route::get('image/{id}', [NewsController::class, 'image'])->name('news.image');
                Route::post('upload-Image/', [NewsImageController::class, 'store'])->name('news.uploadImage');
                Route::post('delete-Image/', [NewsImageController::class, 'destroy'])->name('news.deleteImage');
            });
            Route::prefix('gallery')->group(function(){
                Route::post('upload-Image/', [GalleryImageController::class, 'store'])->name('gallery.uploadImage');
                Route::post('delete-Image/', [GalleryImageController::class, 'destroy'])->name('gallery.deleteImage');
            });
            Route::prefix('report')->group(function(){
                Route::get('/transaction', [ReportController::class, 'transaction'])->name('report.transaction');
                Route::post('/transaction/export', [ReportController::class, 'exportTransaction'])->name('report.transaction.export');
            });

        });
    });
});

