<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
//
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Formateur\AuthController;
use App\Models\Classe;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;

Route::prefix('formateur')->middleware('guest')->name('formateur.')->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('check');

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::prefix('formateur')->middleware('formateur')->name('formateur.')->group(function () {
    Route::get('/dashboard', function () {
        return view('formateur.dashboard');
    })->name('dashboard');

    Route::prefix('/absence')->name('absence.')->group(function () {
        Route::get('/', function () {
            $classes = Classe::with(['admin'])->get();
            return view('formateur.absence.index', compact('classes'));
        })->name('index');

        Route::get('/classe/{id}', function (int $id) {
            // Get the start and end dates of the current week
            $startDate = Carbon::now()->startOfWeek()->format('Y-m-d');
            $endDate = Carbon::now()->endOfWeek()->format('Y-m-d');

            $classe = Classe::whereId($id)
                ->whereHas('absences', function ($query) use ($startDate, $endDate) {
                    $query->whereBetween('date', [$startDate, $endDate]);
                })
                ->with(['absences.absencesStagiaires'])
                ->get();
            // $classe = Classe::whereId($id)->with(['admin', 'absences.absencesStagiaires', 'stagiaires'])->first();

            return $classe;
            // return view('formateur.absence.classe', compact('classe'));
        })->name('classe');
    });

    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
