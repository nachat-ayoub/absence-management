<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\Classe;
use App\Models\Presence;
use App\Models\Formateur;
use Illuminate\Http\Request;
use App\Models\Absence_stagiaire;
use Illuminate\Support\Facades\DB;

class FormateurController extends Controller
{

    // * dashboard
    public function formateurDashboard()
    {
        $formateur_id = Auth::guard('formateur')->user()->id;
        $data = Presence::selectRaw('MONTH(date) AS mois, COUNT(*) AS total')
            ->where('formateur_id', $formateur_id)
            ->where('isPresence', 0)
            ->groupBy('mois')
            ->pluck('total', 'mois')
            ->toArray();
        $nbr_absences_regestrer_formateur = Presence::selectRaw('COUNT(*) as totalAbsences')
            ->where('formateur_id', $formateur_id)
            ->where('isPresence', 0)
            ->pluck('totalAbsences');
        $nbrAbsences = Presence::selectRaw('COUNT(*) as totalAbsences')
            ->where('isPresence', 0)
            ->pluck('totalAbsences')
            ->toArray();
        $absenceParFormateur = ($nbr_absences_regestrer_formateur[0] / $nbrAbsences[0]) * 100;

        $classeDeFormateur = DB::table('classe_formateur')->select('classe_id')
            ->where('formateur_id', $formateur_id)
            ->pluck('classe_id')
            ->count();

        $classes_en_fonction_absences = DB::table('presences')
            ->select('classes.branche', 'classes.num_group', DB::raw('count(*) as absence_count'))
            ->join('classes', 'presences.classe_id', '=', 'classes.id')
            ->where('formateur_id', $formateur_id)
            ->where('presences.isPresence', 0)
            ->groupBy('num_group', 'branche')
            ->orderBy('absence_count', 'desc')
            ->take(6)
            ->get();

        return view('dashboardFormateur', compact('nbr_absences_regestrer_formateur', 'nbrAbsences', 'absenceParFormateur', 'classeDeFormateur', 'classes_en_fonction_absences'))->with('data', json_encode($data));
    }

    // * getStagiaire
    function getClassPresences(Request $request, string $classeId)
    {
        $startOfWeek = Carbon::now()->startOfWeek(); // Get the start of the current week (Monday)
        $endOfWeek = Carbon::now()->endOfWeek(); // Get the end of the current week (Friday)

        $classe = Classe::with([
            'formateurs',
            'stagiaires' => function ($query) use ($startOfWeek, $endOfWeek) {
                $query->orderBy('nom', 'asc')->with([
                    'presences' => function ($query) use ($startOfWeek, $endOfWeek) {
                        $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
                    }
                ]);
            }
        ])->findOrFail($classeId);

        $week = [
            'start' => $startOfWeek->format('d/m/Y'),
            'end' => $endOfWeek->format('d/m/Y'),
        ];

        // Get the current date
        $today = Carbon::now();

        // Set the start of the week to Monday
        $today->startOfWeek(Carbon::MONDAY);

        // Initialize the array to store week information

        // Iterate over the days of the week
        for ($i = 0; $i < 6; $i++) {
            // Get the day name in French
            $dayName = ucfirst($today->locale('fr_FR')->isoFormat('dddd'));

            // Get the date in the desired format
            $date = $today->format('Y-m-d');

            // Add the day and date to the weekInfo array
            $week['jours'][$dayName] = $date;

            // Move to the next day
            $today->addDay();
        }

        if ($request->has('json')) {
            return compact('classe', 'week');
        }

        return view('absence.classeAbsence', compact('classe', 'week'));

    }

    function getCLasses(Request $request)
    {
        $classes = Formateur::find(Auth::guard('formateur')->user()->getAuthIdentifier())->classes;
        return view('absence.index', compact('classes'));
    }

    // * Creation un absence de stagiaire :
    function storeStagiairePresence(Request $request, string $classe_id, string $stagiaire_id)
    {
        $presenceData = $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'stagiaire_id' => 'required|exists:stagiaires,id',
            'seance' => 'required|string',
            'isPresence' => 'required|boolean',
            'preuve' => 'sometimes|nullable|string|max:100',
        ]);

        Presence::create($presenceData);
        return redirect()->back()->with('success', 'L\'absence a été crée avec succès !');
    }

    //
    //
    //
    // * Modification d'un absence de stagiaire :
    function updateStagiairePresence(Request $request)
    {
        $presenceData = $request->validate([
            'id' => 'required|exists:presences,id',
            'isPresence' => 'required|boolean',
            'preuve' => 'sometimes|nullable|string|max:100',
        ]);

        $presence = Presence::find($presenceData['id']);

        if (!$presence) {
            return back()->with('error', 'Presence de stagiaire n\'existe pas!');
        }

        $presence->update($presenceData);
        return back()->with('success', 'Absence de stagiaire modifier avec succès!');
    }

    //
    //
    // * Supprimer un absence de stagiaire :
    // function destroyAbsenceStagiaire(Request $request)
    // {
    //     $data = $request->validate([
    //         'absence_id' => 'required',
    //         'stagiaire_id' => 'required',
    //     ]);

    //     $absence_stagiaire = Absence_stagiaire::whereStagiaireId($data['stagiaire_id'])->whereAbsenceId($data['absence_id'])->first();

    //     if (!$absence_stagiaire) {
    //         return back()->with('error', 'Absence de stagiaire n\'existe pas!');
    //     }

    //     $absence_stagiaire->delete();
    //     return back()->with('success', 'Absence de stagiaire supprimer avec succès!');
    // }

}

// * Absence Table : create an absence page for a date (day);
// * -- date, classe_id, formateur_id

// * AbsenceStagiaire Table : create an absence for stagiaire with the absence page id;
// * -- absence_id, stagiaire_id, preuve?