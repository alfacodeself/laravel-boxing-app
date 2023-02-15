<?php

use App\Http\Controllers\Admin\{AbsentController, AccountController, DashboardController, EventController, GalleryController, MemberAccountController, MemberController, ProfileController, ProgramClassController, SettingController, TrainerController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', DashboardController::class)->name('dashboard');
Route::prefix('accounts')->as('account.')->group(function () {
    Route::post('{user}/verify', [MemberAccountController::class, 'verifyAccount'])->name('verify');
});
Route::prefix('members')->as('member.')->group(function () {
    Route::get('/', [MemberController::class, 'index'])->name('index');
    Route::prefix('{member}')->group(function () {
        Route::get('account', [MemberController::class, 'account'])->name('account');
        Route::patch('account/{user}/update', [MemberController::class, 'updateAccount'])->name('account.update');
        Route::get('edit', [MemberController::class, 'edit'])->name('edit');
        Route::patch('update', [MemberController::class, 'update'])->name('update');
        Route::get('show', [MemberController::class, 'show'])->name('show');
        Route::get('transactions', [MemberController::class, 'transaction'])->name('transaction');
        Route::get('programs', [MemberController::class, 'program'])->name('program');
        Route::put('status-account', [MemberController::class, 'setStatusAccount'])->name('account.status');
    });
});
Route::prefix('trainers')->as('trainer.')->group(function () {
    Route::get('/', [TrainerController::class, 'index'])->name('index');
    Route::prefix('{trainer}')->group(function () {
        Route::get('account', [TrainerController::class, 'account'])->name('account');
        Route::patch('account/{user}/update', [TrainerController::class, 'updateAccount'])->name('account.update');
        Route::get('edit', [TrainerController::class, 'edit'])->name('edit');
        Route::patch('update', [TrainerController::class, 'update'])->name('update');
        Route::get('show', [TrainerController::class, 'show'])->name('show');
        Route::get('programs', [TrainerController::class, 'program'])->name('program');
    });
});
Route::prefix('absents')->as('absent.')->group(function () {
    Route::get('/', [AbsentController::class, 'index'])->name('index');
    Route::get('create', [AbsentController::class, 'create'])->name('create');
    Route::post('store', [AbsentController::class, 'store'])->name('store');
    Route::prefix('{absent}')->group(function(){
        Route::get('edit', [AbsentController::class, 'edit'])->name('edit');
        Route::get('member', [AbsentController::class, 'member'])->name('member');
        Route::patch('member/{member}/absen', [AbsentController::class, 'memberAbsent'])->name('member.absent');
        Route::get('trainer', [AbsentController::class, 'trainer'])->name('trainer');
        Route::patch('trainer/{trainer}/absen', [AbsentController::class, 'trainerAbsent'])->name('trainer.absent');
        Route::put('update', [AbsentController::class, 'update'])->name('update');
        Route::patch('status', [AbsentController::class, 'destroy'])->name('destroy');
    });
});
Route::prefix('programs')->as('program.')->group(function () {
    Route::get('/', [ProgramClassController::class, 'index'])->name('index');
    Route::get('create', [ProgramClassController::class, 'create'])->name('create');
    Route::post('store', [ProgramClassController::class, 'store'])->name('store');
    Route::prefix('{programClass}')->group(function () {
        Route::get('edit', [ProgramClassController::class, 'edit'])->name('edit');
        Route::patch('update', [ProgramClassController::class, 'update'])->name('update');
        Route::patch('destroy', [ProgramClassController::class, 'destroy'])->name('destroy');
        Route::get('show', [ProgramClassController::class, 'show'])->name('show');
        Route::get('member', [ProgramClassController::class, 'member'])->name('member');
        Route::get('trainer', [ProgramClassController::class, 'trainer'])->name('trainer');
        Route::delete('trainer/{trainerProgram}/delete', [ProgramClassController::class, 'deleteTrainerProgram'])->name('trainer.delete');
        Route::post('trainer/add-trainer', [ProgramClassController::class, 'addTrainerProgram'])->name('trainer.create');
        Route::get('transaction', [ProgramClassController::class, 'transaction'])->name('transaction');
        Route::get('schedule', [ProgramClassController::class, 'schedule'])->name('schedule');
        Route::patch('schedule/{schedule}/edit-note', [ProgramClassController::class, 'editScheduleNote'])->name('schedule.edit.note');
        Route::get('reschedule', [ProgramClassController::class, 'reschedule'])->name('reschedule');
        Route::post('reschedule', [ProgramClassController::class, 'addSchedule'])->name('schedule.create');
    });
});
Route::prefix('settings')->as('setting.')->group(function () {
    Route::get('/', [SettingController::class, 'index'])->name('index'); 
    Route::get('weight/create', [SettingController::class, 'addWeight'])->name('addWeight');
    Route::post('weight/store', [SettingController::class, 'storeWeight'])->name('storeWeight');
    Route::get('weight/{weightClass}/edit', [SettingController::class, 'editWeight'])->name('editWeight');
    Route::put('weight/{weightClass}/update', [SettingController::class, 'updateWeight'])->name('updateWeight');
    Route::delete('weight/{weightClass}/delete', [SettingController::class, 'destroyWeight'])->name('destroyWeight');

    Route::get('time/create', [SettingController::class, 'addTime'])->name('addTime');
    Route::post('time/store', [SettingController::class, 'storeTime'])->name('storeTime');
    Route::get('time/{time}/edit', [SettingController::class, 'editTime'])->name('editTime');
    Route::put('time/{time}/update', [SettingController::class, 'updateTime'])->name('updateTime');
    Route::delete('time/{time}/delete', [SettingController::class, 'destroyTime'])->name('destroyTime');
});
Route::prefix('events')->as('event.')->group(function(){
    Route::get('/', [EventController::class, 'index'])->name('index');
    Route::get('create', [EventController::class, 'create'])->name('create');
    Route::post('store', [EventController::class, 'store'])->name('store');
    Route::prefix('{event}')->group(function(){
        Route::get('edit', [EventController::class, 'edit'])->name('edit');
        Route::put('update', [EventController::class, 'update'])->name('update');
        Route::put('set-status', [EventController::class, 'destroy'])->name('destroy');
        Route::get('members', [EventController::class, 'members'])->name('member');
        Route::get('approve', [EventController::class, 'approve'])->name('approve');
        Route::patch('approve/{member}/acccept', [EventController::class, 'acceptApprove'])->name('approve.accept');
        Route::patch('approve/{member}/reject', [EventController::class, 'rejectApprove'])->name('approve.reject');
    });
});
Route::prefix('profile')->as('profile.')->group(function(){
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::post('/', [ProfileController::class, 'store'])->name('store');
});
Route::prefix('galleries')->as('gallery.')->group(function(){
    Route::get('/', [GalleryController::class, 'index'])->name('index');
    Route::post('/', [GalleryController::class, 'store'])->name('store');
    Route::delete('{gallery}', [GalleryController::class, 'destroy'])->name('destroy');
});
Route::prefix('account')->as('account.')->group(function(){
    Route::get('/', [AccountController::class, 'index'])->name('index');
    Route::patch('/', [AccountController::class, 'store'])->name('store');
});
