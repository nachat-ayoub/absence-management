<?php

use App\Http\Controllers\FormateurController;
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

Route::group(['prefix' => 'absence'], function () {
    Route::get('/{absence_id}',
        [FormateurController::class, 'getStagiaire']
    );

    // * Creation :
    Route::get('/{absence_id}/stagiaire/{stagiaire_id}',
        [FormateurController::class, 'createAbsenceStagiaire']
    );

    Route::post('/{absence_id}/stagiaire/{stagiaire_id}',
        [FormateurController::class, 'storeAbsenceStagiaire']
    );

    // * Update :
    Route::get('/{absence_id}/stagiaire/{stagiaire_id}',
        [FormateurController::class, 'editAbsenceStagiaire']
    );

    Route::put('/{absence_id}/stagiaire/{stagiaire_id}',
        [FormateurController::class, 'updateAbsenceStagiaire']
    );

    // * Delete :
    Route::delete('/{absence_id}/stagiaire/{stagiaire_id}',
        [FormateurController::class, 'destroyAbsenceStagiaire']
    );
});

/*

Route::get('/', function () {
$admin = App\Models\Admin::find(1); // badr
return $admin->formateurs;
});

Route::get('/classes', function () {
$admin = App\Models\Admin::find(1); // badr
return $admin->classes;
});

Route::get('/stagiaire', function () {
$class = App\Models\Classe::find(1);
return $class->stagiaires;
});

Route::get('/absence', function () {
$abs = App\Models\Absence::find(1);
return $abs->formateur;
});

Route::get('/absence_stg', function () {
$prv = App\Models\Absence_stagiaire::find(2);
return "<p>" . $prv->stagiaire->nom . "   " . $prv->absence->date . "</p>";
});

Route::get('formateurs', [AdminController::class, 'indexFormateur']);

 */
