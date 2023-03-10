<?php

use App\Http\Controllers\FacebookController;
use App\Http\Controllers\GoogleController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('facebook')->name('facebook.')->group(function(){
    Route::get('auth',[FacebookController::class,'LoginUsingFacebook'])->name('login');
    Route::get('callback',[FacebookController::class,'CallboackFromFacebook'])->name('callback');
});

Route::prefix('google')->name('google.')->group(function(){
    Route::get('auth',[GoogleController::class,'LoginUsingGoogle'])->name('login');
    Route::get('callback',[GoogleController::class,'CallboackFromGoogle'])->name('callback');
});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(App\Http\Controllers\Auth\AuthOtpController::class)->group(function(){
    Route::get('otp/login', 'login')->name('otp.login');
    Route::post('otp/generate', 'generate')->name('otp.generate');
    Route::get('otp/verification/{user_id}', 'verification')->name('otp.verification');
    Route::post('otp/login', 'loginWithOtp')->name('otp.getlogin');
});
