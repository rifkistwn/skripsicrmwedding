<?php

use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\NewsController;
use App\Http\Controllers\Client\PacketController;
use App\Http\Controllers\Client\VenueController;
use App\Http\Controllers\Client\ContactController;
use App\Http\Controllers\Client\GalleryController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\ProfileController;
use App\Http\Controllers\Client\PromoController;
use App\Http\Controllers\Client\RegisterController;
use App\Http\Controllers\Client\ReviewController;
use App\Http\Controllers\Client\ScheduleController;
use App\Http\Controllers\Client\TransactionController;
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
// start::client midddleware
Route::group(['middleware'=> 'client'], function() {
    // start::auth client
    Route::group(['middleware'=> 'auth'], function() {
        Route::group(['middleware'=> 'role:client'],function() {
            Route::name('client.')->group(function(){
                Route::prefix('cart')->name('cart.')->group(function() {
                    Route::get('/', [CartController::class, 'index'])->name('index');
                    Route::post('/', [CartController::class, 'store'])->name('store');
                    Route::delete('/{cart}', [CartController::class, 'destroy'])->name('destroy');
                });

                Route::prefix('transaction')->name('transaction.')->group(function() {
                    Route::post('/', [TransactionController::class, 'store'])->name('store');
                });

                Route::prefix('pembayaran')->name('payment.')->group(function() {
                    Route::get('/', [PaymentController::class, 'index'])->name('index');
                    Route::get('/{transaction}', [PaymentController::class, 'show'])->name('show');
                    Route::post('/{transaction}', [PaymentController::class, 'update'])->name('update');
                });

                Route::prefix('profil')->name('profile.')->group(function() {
                    Route::get('/', [ProfileController::class, 'index'])->name('index');
                    Route::get('/biodata', [ProfileController::class, 'bidoata'])->name('biodata');
                });
            });
        });
    });
    // end::auth client

    // start::guest client
    Route::name('client.')->group(function() {
        Route::get('/', [HomeController::class, 'index'])->name('index');

        Route::get('/check_date_availability', [TransactionController::class, 'checkAvailabilityDate'])->name('check-availability');

        Route::prefix('jadwal')->name('schedule.')->group(function() {
            Route::get('/', [ScheduleController::class, 'index'])->name('index');
            Route::get('/{date}', [ScheduleController::class, 'show'])->name('show');
        });

        Route::get('/cara-pemesanan', [ContactController::class, 'guide'])->name('guide.index');

        Route::prefix('gallery')->name('gallery.')->group(function() {
            Route::get('/', [GalleryController::class, 'index'])->name('index');
            Route::get('/{slug}', [GalleryController::class, 'show'])->name('show');
        });

        Route::prefix('daftar')->name('register.')->group(function() {
            Route::get('/', [RegisterController::class, 'index'])->name('index');
            Route::post('/', [RegisterController::class, 'store'])->name('store');
        });

        Route::prefix('berita')->name('news.')->group(function() {
            Route::get('/', [NewsController::class, 'index'])->name('index');
            Route::get('/{slug}', [NewsController::class, 'show'])->name('show');
        });
        
        Route::prefix('paket')->name('packet.')->group(function() {
            Route::get('/', [PacketController::class, 'index'])->name('index');
            Route::get('/{code}', [PacketController::class, 'show'])->name('show');
        });

        Route::prefix('promo')->name('promo.')->group(function() {
            Route::get('/', [PromoController::class, 'index'])->name('index');
            Route::get('/{code}', [PromoController::class, 'show'])->name('show');
        });
        
        Route::prefix('venue')->name('venue.')->group(function() {
            Route::get('/', [VenueController::class, 'index'])->name('index');
            Route::get('/{slug}', [VenueController::class, 'show'])->name('show');
        });

        Route::prefix('kontak')->name('contact.')->group(function() {
            Route::get('/', [ContactController::class, 'index'])->name('index');
            Route::post('/question', [ContactController::class, 'storeQuestion'])->name('question');
        });

        Route::prefix('ulasan')->name('review.')->group(function() {
            Route::get('/', [ReviewController::class, 'index'])->name('index');
            
            Route::group(['middleware'=> ['auth', 'role:client']], function() {
                Route::get('/{transaction}', [ReviewController::class, 'create'])->name('create');
                Route::post('/', [ReviewController::class, 'store'])->name('store');
            });
        });
    });
    // end::guest client
});
// end::client midddleware