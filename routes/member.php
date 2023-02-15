<?php

use App\Http\Controllers\Member\{AccountController, DashboardController, EventController, ProgramClassController, ProfileController, TransactionController};
use App\Http\Middleware\CreateMemberAccountMiddleware;
use App\Http\Middleware\MemberHasAccountMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(CreateMemberAccountMiddleware::class)->group(function(){
    Route::get('dashboard', DashboardController::class)->name('dashboard');
    Route::prefix('programs')->as('program.')->group(function(){
        Route::get('/', [ProgramClassController::class, 'index'])->name('index');
        Route::get('{programClass}/detail', [ProgramClassController::class, 'show'])->name('show');
        Route::get('{programClass}/create', [ProgramClassController::class, 'create'])->name('create');
        Route::post('{programClass}/store', [ProgramClassController::class, 'store'])->name('store');
        Route::delete('{memberHasProgramClass}/destroy', [ProgramClassController::class, 'destroy'])->name('destroy');
    });
    Route::prefix('events')->as('event.')->group(function(){
        Route::get('/', [EventController::class, 'index'])->name('index');
        Route::post('{event}/store', [EventController::class, 'store'])->name('store');
        // Route::show('{event}/show', [EventController::class, 'show'])->name('show');
    });
    Route::prefix('profile')->as('profile.')->group(function(){
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('update', [ProfileController::class, 'update'])->name('update');
    });
    Route::prefix('transactions')->as('transaction.')->group(function(){
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('{reference}/show', [TransactionController::class, 'show'])->name('show');
        Route::get('{memberHasProgramClass}/create', [TransactionController::class, 'create'])->name('create');
        Route::post('{memberHasProgramClass}/store', [TransactionController::class, 'store'])->name('store');
    });
    Route::prefix('account')->as('account.')->group(function(){
        Route::get('/', [AccountController::class, 'index'])->name('index');
        Route::post('store', [AccountController::class, 'store'])->name('store');
    });
});


Route::middleware(MemberHasAccountMiddleware::class)->group(function(){
    Route::get('profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('profile/store', [ProfileController::class, 'store'])->name('profile.store');
});
// Route::resource('profile', ProfileController::class)->except('show', 'destroy');
