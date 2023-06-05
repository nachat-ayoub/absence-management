<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Formateur;
use App\Models\Presence;
use App\Models\Stagiaire;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as Auth;
use Illuminate\Support\Facades\DB;

class FormateurController extends Controller {
    // * dashboard
    public function formateurDashboard() {
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

        if ($nbrAbsences[0] != 0) {
            $absenceParFormateur = ($nbr_absences_regestrer_formateur[0] / $nbrAbsences[0]) * 100;
        } else {
            $absenceParFormateur = 0.00;
        }

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
    function getClassPresences(Request $request, string $classeId) {
        $startOfWeek = Carbon::now()->startOfWeek(); // Get the start of the current week (Monday)
        $endOfWeek = Carbon::now()->endOfWeek(); // Get the end of the current week (Friday)

        $formateurId = auth('formateur')->id();

        $classe = Classe::whereHas('formateurs', function ($query) use ($formateurId) {
            $query->where('formateur_id', $formateurId);
        })
            ->with([
                'formateurs',
                'stagiaires' => function ($query) use ($startOfWeek, $endOfWeek) {
                    $query->orderBy('nom', 'asc')->with([
                        'presences' => function ($query) use ($startOfWeek, $endOfWeek) {
                            $query->whereBetween('date', [$startOfWeek, $endOfWeek]);
                        },
                    ]);
                },
            ])
            ->findOrFail($classeId);

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

    function getCLasses(Request $request) {
        $classes = Formateur::find(Auth::guard('formateur')->user()->getAuthIdentifier())->classes()->paginate(7);
        return view('absence.index', compact('classes'));
    }

    // * Creation un absence de stagiaire :
    function storeStagiairePresence(Request $request) {

        $presenceData = $request->validate([
            'classe_id' => 'required|exists:classes,id',
            'stagiaire_id' => 'required|exists:stagiaires,id',
            'seance' => 'required|string',
            'date' => 'required|string',
            'isPresence' => 'string',
            'stagiaire_index' => 'required|string',
        ]);

        $presenceData['isPresence'] = !isset($presenceData['isPresence']) ? false : $presenceData['isPresence'] === 'on';
        $presenceData['formateur_id'] = Auth::guard('formateur')->id();

        // dd($presenceData);

        $seances = explode(',', $presenceData['seance']);

        $seancePresenceExists = Presence::with('stagiaire')->where('date', $presenceData["date"])
            ->where('stagiaire_id', $presenceData["stagiaire_id"])
            ->where('classe_id', $presenceData["classe_id"])
            ->where(function ($query) use ($seances) {
                foreach ($seances as $seance) {
                    $query->orWhereRaw("seance REGEXP '[[:<:]]" . preg_quote($seance, '/') . "[[:>:]]'");
                }
            })->exists();

        if ($seancePresenceExists) {
            $stagiaire = Stagiaire::find($presenceData['stagiaire_id']);

            return redirect()->back()->withErrors([
                'error' =>
                'Cette séance ' . $presenceData['seance'] . ' dans le ' . $presenceData['date'] . ' est déjà notée pour la stagiaire N°' .
                $presenceData['stagiaire_index'] . ' ' . $stagiaire->nom . ' ' . $stagiaire->prenom . '.',
            ]);

        }

        Presence::create($presenceData);
        return redirect()->back()->with('success', 'L\'absence a été crée avec succès !');
    }

    //
    //
    //
    // * Modification d'un absence de stagiaire :
    function updateStagiairePresence(Request $request) {
        $presenceData = $request->validate([
            'presence_id' => 'required|exists:presences,id',
            'seance' => 'required|string',
            'isPresence' => 'string',
        ]);

        $presenceData['isPresence'] = !isset($presenceData['isPresence']) ? false : $presenceData['isPresence'] === 'on';

        // dd($presenceData);

        $presence = Presence::find($presenceData['presence_id']);

        if (!$presence) {
            return redirect()->back()->withErrors(['error' => 'Presence de stagiaire n\'existe pas!']);
        }

        $presence->update($presenceData);
        return back()->with('success', 'Absence de stagiaire modifier avec succès!');
    }

}
