<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\AdminProfileController;
//
use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('guest')->name('admin.')->group(function () {
    Route::get('register', [AuthController::class, 'registerView'])->name('register');
    Route::post('register', [AuthController::class, 'register']);

    Route::get('login', [AuthController::class, 'loginView'])->name('login');
    Route::post('login', [AuthController::class, 'login']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', [AdminProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [AdminProfileController::class, 'update'])->name('update');
        Route::put('/password/update', [AdminProfileController::class, 'updatePassword'])->name('updatePassword');
        Route::delete('/', [AdminProfileController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('/absence')->name('absence.')->group(function () {
        Route::get('/', [AdminController::class, 'getCLasses'])->name('index');
        Route::get('/classe/{classe_id}', [AdminController::class, 'getClassPresences'])->name('classeAbsence');
        Route::post('/classe/{classe_id}', [AdminController::class, 'storeStagiairePresence'])->name('storeClasseAbsence');
        Route::put('/classe/{classe_id}', [AdminController::class, 'updateStagiairePresence'])->name('updateClasseAbsence');
    });

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // *  routes of admin/Formateur
    Route::get('formateur/search', [AdminController::class, 'indexFormateur'])->name('allFormateur');
    Route::get('formateur/create', [AdminController::class, 'createFormateur'])->name('createFormateur');
    Route::post('formateur/store', [AdminController::class, 'storeFormateur'])->name('storeFormateur');
    Route::get('formateur/show/{formateur}', [AdminController::class, 'showFormateur'])->name('showFormateur');
    Route::get('formateur/{formateur}/edit', [AdminController::class, 'editFormateur'])->name('editFormateur');
    Route::put('formateur/{formateur}', [AdminController::class, 'updateFormateur'])->name('updateFormateur');
    Route::delete('formateur/{formateur}', [AdminController::class, 'destroyFormateur'])->name('destroyFormateur');

    // *  routes of admin/classe
    Route::get('classe/search', [AdminController::class, 'indexClasses'])->name('allClasses');
    Route::get('classe/create', [AdminController::class, 'createClasse'])->name('createClasse');
    Route::post('classe/store', [AdminController::class, 'storeClasse'])->name('storeClasse');
    Route::get('classe/{classe}/edit', [AdminController::class, 'editClasse'])->name('editClasse');
    Route::get('classe/show/{classe}', [AdminController::class, 'showClasse'])->name('showClasse');
    Route::put('classe/{classe}', [AdminController::class, 'updateClasse'])->name('updateClasse');
    Route::delete('classe/{classe}', [AdminController::class, 'destroyClasse'])->name('destroyClasse');

    // *  routes of admins/stagiaire
    Route::get('stagiaire/search', [AdminController::class, 'indexStagiaire'])->name('allStagiaire');
    Route::get('stagiaire/create', [AdminController::class, 'createStagiaire'])->name('createStagiaire');
    Route::post('stagiaire/store', [AdminController::class, 'storeStagiaire'])->name('storeStagiaire');
    Route::get('stagiaire/search/{stagiaire}', [AdminController::class, 'showStagiaire'])->name('showStagiaire');
    Route::get('stagiaire/{stagiaire}/edit', [AdminController::class, 'editStagiaire'])->name('editStagiaire');
    Route::PUT('stagiaire/{stagiaire}', [AdminController::class, 'updateStagiaire'])->name('updateStagiaire');
    Route::delete('stagiaire/{stagiaire}', [AdminController::class, 'destroyStagiaire'])->name('destroyStagiaire');
});
