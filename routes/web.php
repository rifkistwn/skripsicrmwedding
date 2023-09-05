<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenerateController;

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


Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');

Auth::routes();


// start::client auth
Route::get('/login', [LoginController::class, 'showLoginClientForm'])->name('login');
// end::client auth