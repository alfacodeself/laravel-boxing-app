<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Trainer\AccountController;
use App\Http\Controllers\Trainer\ProfileController;
use App\Http\Controllers\Trainer\ProgramController;
use App\Http\Middleware\TrainerHasAccountMiddleware;
use App\Http\Controllers\Trainer\DashboardController;
use App\Http\Middleware\CreateTrainerAccountMiddleware;

Route::middleware(CreateTrainerAccountMiddleware::class)->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('programs')->as('program.')->group(function () {
        Route::get('/', [ProgramController::class, 'index'])->name('index');
        Route::get('{programs}/member', [ProgramController::class, 'member'])->name('member');
        Route::get('{programs}/member/{member}/add-weight', [ProgramController::class, 'addWeightMember'])->name('member.addWeight');
        Route::post('{programs}/member/{member}/store-weight', [ProgramController::class, 'storeWeightMember'])->name('member.storeWeight');
    });
    Route::prefix('profile')->as('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('update', [ProfileController::class, 'update'])->name('update');
    });
    Route::prefix('account')->as('account.')->group(function(){
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::post('store', [AccountController::class, 'store'])->name('store');
    });
});

Route::middleware(TrainerHasAccountMiddleware::class)->group(function () {
    Route::get('profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('profile/store', [ProfileController::class, 'store'])->name('profile.store');
});
