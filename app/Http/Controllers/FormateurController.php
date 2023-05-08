<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Absence_stagiaire;
use App\Models\Stagiaire;
use Illuminate\Http\Request;

class FormateurController extends Controller {

    // * getStagiaire
    function getStagiaire(Request $request, string $absence_id) {
        $error = null;
        $absence = null;

        $absence = Absence::with('absencesStagiaires.stagiaire')->find($absence_id);

        if (!$absence || !$absence->exists()) {
            $error = 'No Absence exist!';
        }

        // return $absence;

        return view('absence.index', compact('absence', 'error'));
    }

    // * FORM de Creation d'absence de stagiaire :
    function createAbsenceStagiaire(Request $request, string $absence_id, string $stagiaire_id) {
        $error = '';
        $absence = null;
        $stagiaire = null;

        $absence = Absence::find($absence_id);
        if (!$absence) {
            $error = 'Ther is no absence with this id: ' . $absence_id;
        }

        $stagiaire = Stagiaire::find($stagiaire_id);
        if (!$stagiaire) {
            $error = 'Ther is no stagiaire with this id: ' . $stagiaire_id;
        }

        return view('absence.stagiare.create', compact('absence', 'stagiaire', 'error'));
    }

    //
    //
    //
    //
    //
    // * Creation un absence de stagiaire :
    function storeAbsenceStagiaire(Request $request) {
        $data = $request->validate([
            'absence_id' => 'required|exists:absences,id',
            'stagiaire_id' => 'required|exists:stagiaires,id',
        ]);

        Absence_stagiaire::create($data);
        return back()->with('success', 'Absence de stagiaire creé avec succès!');
    }

    // * FORM de modification d'absence de stagiaire :
    function editAbsenceStagiaire(Request $request, string $absence_id, string $stagiaire_id) {
        $error = '';
        $absence = null;
        $stagiaire = null;

        $absence = Absence::find($absence_id);
        if (!$absence) {
            $error = 'Ther is no absence with this id: ' . $absence_id;
        }

        $stagiaire = Stagiaire::find($stagiaire_id);
        if (!$stagiaire) {
            $error = 'Ther is no stagiaire with this id: ' . $stagiaire_id;
        }

        return view('absence.stagiare.edit', compact('absence', 'stagiaire', 'error'));
    }

    //
    //
    //
    // * Modification d'un absence de stagiaire :
    function updateAbsenceStagiaire(Request $request) {
        $data = $request->validate([
            'absence_id' => 'required|exists:absences,id',
            'stagiaire_id' => 'required|exists:stagiaires,id',
            'preuve' => 'required',
        ]);

        $absence_stagiaire = Absence_stagiaire::whereStagiaireId($data['stagiaire_id'])->whereAbsenceId($data['absence_id'])->first();

        if (!$absence_stagiaire) {
            return back()->with('error', 'Absence de stagiaire n\'existe pas!');
        }

        $absence_stagiaire->update($data);
        return back()->with('success', 'Absence de stagiaire modifier avec succès!');
    }

    //
    //
    // * Supprimer un absence de stagiaire :
    function destroyAbsenceStagiaire(Request $request) {
        $data = $request->validate([
            'absence_id' => 'required',
            'stagiaire_id' => 'required',
        ]);

        $absence_stagiaire = Absence_stagiaire::whereStagiaireId($data['stagiaire_id'])->whereAbsenceId($data['absence_id'])->first();

        if (!$absence_stagiaire) {
            return back()->with('error', 'Absence de stagiaire n\'existe pas!');
        }

        $absence_stagiaire->delete();
        return back()->with('success', 'Absence de stagiaire supprimer avec succès!');
    }

}

// * Absence Table : create an absence page for a date (day);
// * -- date, classe_id, formateur_id

// * AbsenceStagiaire Table : create an absence for stagiaire with the absence page id;
// * -- absence_id, stagiaire_id, preuve?
