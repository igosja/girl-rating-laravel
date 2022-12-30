<?php

use App\Http\Controllers\Admin\GirlController;
use App\Http\Controllers\Admin\VoteController as AdminVoteController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\VoteController;
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

Route::middleware(['auth'])->prefix('/admin')->group(function () {
    Route::controller(\App\Http\Controllers\Admin\SiteController::class)->group(function () {
        Route::get('/', 'index')->name('admin_home')->middleware('auth');
    });
    Route::resources([
        'girls' => GirlController::class,
    ]);
    Route::resources([
        'votes' => AdminVoteController::class,
    ]);
});

Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(VoteController::class)->group(function () {
    Route::get('/vote', 'index')->name('vote');
    Route::get('/vote/{vote}', 'view')->name('vote_view');
    Route::get('/vote/{vote}/vote/{girl}', 'vote')->name('vote_vote');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'processLogin')->name('processLogin');
});

Route::controller(SignupController::class)->group(function () {
    Route::get('/signup', 'signup')->name('signup');
    Route::post('/signup', 'processSignup')->name('processSignup');
});
