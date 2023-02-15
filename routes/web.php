<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Member\TransactionController;

Route::view('/', 'app.landingpage.index')->name('index');
Route::view('about', 'app.landingpage.about')->name('about');
Route::view('contact', 'app.landingpage.contact')->name('contact');
Route::view('trainers', 'app.landingpage.trainers')->name('trainers');
Route::prefix('classes')->as('class.')->group(function () {
    Route::view('/','app.landingpage.classes.index')->name('index');
    Route::view('/show','app.landingpage.classes.show')->name('show');
});

Route::prefix('auth')->middleware('guest')->group(function(){
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
    route::get('register',[RegisterController::class,'register'])->name('register');
    route::post('registration',[RegisterController::class,'registration'])->name('registration');
    
});
Route::post('charge', [TransactionController::class, 'charge']);
Route::post('logout', LogoutController::class)->name('logout');