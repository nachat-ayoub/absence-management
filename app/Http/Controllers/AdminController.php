<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Formateur;
use App\Models\Presence;
use App\Models\Stagiaire;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    // ! Dashboard Admin
    public function dashboard()
    {
        $nbr_absence = DB::table('presences')->where("isPresence", 0)->count();

        $nbr_absence_sans_preuve = DB::select('select COUNT(*) as nbr from presences where UPPER(preuve) =  "RIEN";');

        $nbr_stagiaires = Stagiaire::all()->count();
        if ($nbr_stagiaires != 0) {
            $nbr_absences_par_stagiaire = ((float) $nbr_absence / (float) $nbr_stagiaires) * 100;
        } else {
            $nbr_absences_par_stagiaire = 0;
        }
        $nbr_classes = Classe::all()->count();

        $nbr_absences_par_classe = DB::table('presences')->select('classe_id', DB::raw('count(*) as total'))->where('isPresence', 0)->groupBy('classe_id')->get();

        $stgClasse = DB::table('stagiaires')->select('classe_id', DB::raw('count(*) as stgDeClasse'))->groupBy('classe_id')->get(); // selection le nombre de stagiaire de chaque classe

        $avg_absence_par_classe = 0.0;

        foreach ($nbr_absences_par_classe as $absence) {
            foreach ($stgClasse as $nbrStgClasse) {
                if ($nbrStgClasse->classe_id == $absence->classe_id) {
                    if ($nbrStgClasse->stgDeClasse != 0) {
                        $avg_absence_par_classe += (float) ($absence->total / $nbrStgClasse->stgDeClasse);
                    } else {
                        $avg_absence_par_classe += 0.0;
                    }
                }
            }
        }
        if ($nbr_classes != 0) {
            $avg_absence_par_classe = ($avg_absence_par_classe / $nbr_classes) * 100;
        } else {
            $avg_absence_par_classe = 0.0;
        }

        $derniere_stagiaire_absencet = Presence::select('presences.preuve', 'presences.date', 'stagiaires.nom', 'stagiaires.prenom', 'classes.branche', 'classes.num_group')
            ->join('stagiaires', 'presences.stagiaire_id', '=', 'stagiaires.id')
            ->join('classes', 'stagiaires.classe_id', '=', 'classes.id')
            ->where('presences.isPresence', 0)
            ->orderBy('presences.created_at', 'DESC')
            ->limit(5)
            ->get();

        $classes_en_fonction_absences = DB::table('presences')
            ->select('classes.branche', 'classes.num_group', DB::raw('count(*) as absence_count'))
            ->join('classes', 'presences.classe_id', '=', 'classes.id')
            ->where('presences.isPresence', 0)
            ->groupBy('num_group', 'branche')
            ->orderBy('absence_count', 'desc')
            ->take(5)
            ->get();
        return view('dashboard', [
            'nbr_absence' => $nbr_absence,
            'nbr_absence_sans_preuve' => $nbr_absence_sans_preuve[0]->nbr,
            'nbr_absences_par_stagiaire' => $nbr_absences_par_stagiaire,
            'avg_absence_par_classe' => $avg_absence_par_classe,
            'derniere_stagiaire_absencet' => $derniere_stagiaire_absencet,
            'classes_en_fonction_absences' => $classes_en_fonction_absences,
        ]);
    }

    public function inserInClassesFormateurTable($classesID, $formateurId)
    {
        $classesID = explode(',', $classesID);
        foreach ($classesID as $classeID) {
            DB::table('classe_formateur')->insert(
                ['classe_id' => $classeID, 'formateur_id' => $formateurId]
            );
        }
    }

    public function updateClassesFormateurTable($classesID, $formateurId)
    {
        $classesID = explode(',', $classesID);

        // Delete old records not included in $classesID
        DB::table('classe_formateur')
            ->where('formateur_id', $formateurId)
            ->whereNotIn('classe_id', $classesID)
            ->delete();

        // Insert new records
        foreach ($classesID as $classeID) {
            DB::table('classe_formateur')
                ->updateOrInsert(
                    ['classe_id' => $classeID, 'formateur_id' => $formateurId],
                    ['formateur_id' => $formateurId]
                );
        }
    }

    // todo ========================================== crud formateur =======================================

    // ! afficher les formateurs
    public function indexFormateur()
    {
        $formateurs = Formateur::paginate(10);
        $data = Formateur::all();
        return view('admin.formateurs.indexformateur', compact('formateurs'))->with('data', json_encode($data));
    }

    // ! create formateur
    public function createFormateur()
    {
        $classes = Classe::all();

        return view('admin.formateurs.createFormateur', compact('classes'));
    }

    // ! insert formateur dans db
    public function storeFormateur(Request $request)
    {
        $formateur = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        // ? Hash le met de passe
        $formateur['password'] = Hash::make($request->password);

        $formateur['admin_id'] = 1;
        $formateurId = Formateur::create($formateur)->id;

        $classes_ids = $request->input('classes');
        $this->inserInClassesFormateurTable($classes_ids, $formateurId);

        return redirect()->route('admin.createFormateur')->with('success', 'Le Formateur a été Bien Ajouté !');
    }

    // ! Show detail of Formateur
    public function showFormateur(Request $request, Formateur $formateur)
    {
        $classes = Classe::whereIn('id', $formateur->classes()->pluck('classes.id'))->get();
        return view('admin.formateurs.showFormateur', compact('formateur', 'classes'));
    }

    // ! Show the form for editing the specified resource.
    public function editFormateur(Request $request, Formateur $formateur)
    {
        $classes = Classe::all();
        $classesOfFormateur = DB::table('classe_formateur')
            ->select('classe_id')
            ->where('formateur_id', $formateur->id)
            ->pluck('classe_id')
            ->toArray();

        return view('admin.formateurs.editFormateur', compact('formateur', 'classes', 'classesOfFormateur'));
    }

    // ! save update
    public function updateFormateur(Request $request, Formateur $formateur)
    {

        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'classes' => 'required|string',
            'password' => 'nullable|string',
        ]);

        $classesID = $request->classes;

        $this->updateClassesFormateurTable($classesID, $formateur->id);

        $formateur->nom = $request->nom;
        $formateur->prenom = $request->prenom;
        $formateur->email = $request->email;
        if (isset($request->password) && $request->password) {
            $formateur['password'] = Hash::make($request->password);
        }

        $formateur['admin_id'] = 1;
        $formateur->save();
        return redirect()->route('admin.allFormateur')->with('success', 'Le Formateur a été Bien Modifier !');
    }

    // ! delete formateur
    public function destroyFormateur(Formateur $formateur)
    {
        $formateur->delete();
        return redirect()->route('admin.allFormateur')->with('success', 'Le Formateur a été Bien Supprimé !');
    }

    // todo ========================================== crud formateur =======================================

    // todo ========================================== crud stagiaire =======================================

    // ! afficher les stagiaires
    public function indexStagiaire()
    {
        $stagiaires = Stagiaire::paginate(10);
        $stagiaires_localstor = Stagiaire::all();
        $data = [];
        foreach ($stagiaires_localstor as $stg) {
            $stgInfo = [
                'id' => $stg->id,
                'nom' => $stg->nom,
                'prenom' => $stg->prenom,
                'branche' => $stg->Classe->branche,
                'num_group' => $stg->Classe->num_group,
                'annee_scolaire' => $stg->Classe->annee_scolaire
            ];
            array_push($data, $stgInfo);
        }
        return view('admin.stagiaire.index', compact('stagiaires'))->with('data', json_encode($data));
    }

    // ! create stagiaire
    public function createStagiaire()
    {
        $branches = Classe::distinct()->pluck('branche');
        $groups = Classe::distinct()->pluck('num_group');
        $annee_scolaires = Classe::distinct()->pluck('annee_scolaire');
        $classe = Classe::all();
        return view('admin.stagiaire.createStagiaire', compact('branches', 'groups', 'annee_scolaires'))->with('classe', json_encode($classe));
    }

    // ! insert stagiaire dans db
    public function storeStagiaire(Request $request)
    {
        $classe_id = DB::table('classes')->select('id')
            ->where('branche', $request->branche)
            ->where('num_group', $request->num_group)
            ->get();
        $stagiaire = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
        ]);
        $stagiaire['classe_id'] = $classe_id[0]->id;
        // *
        $id_classe = $stagiaire['classe_id'];
        $classe = Classe::find($id_classe);
        $num_stagiaires = $classe->stagiaires()->count();
        if ($num_stagiaires >= 25) {
            return redirect()->route('admin.createStagiaire')->with('error', 'La Classe A Atteint La Limite Maximale De Stagiaires !');
        } else {
            Stagiaire::create($stagiaire);
            return redirect()->route('admin.createStagiaire')->with('success', 'Le Stagiaire a été Bien Ajouté !');
        }
    }

    // ! Show detail of stagiaire
    public function showStagiaire(Stagiaire $stagiaire)
    {
        return view('admin.stagiaire.showStagiaire', compact('stagiaire'));
    }

    // ! Show the form for editing the specified resource.
    public function editStagiaire(Stagiaire $stagiaire)
    {
        $branches = Classe::distinct()->pluck('branche', 'id');
        $groups = Classe::distinct()->pluck('num_group');
        $annee_scolaires = Classe::distinct()->pluck('annee_scolaire');
        $classe = Classe::all();
        $data = [
            'classes' => $classe,
            'stgGroup' => $stagiaire->Classe->num_group,
        ];
        return view('admin.stagiaire.editStagiaire', compact('stagiaire', 'branches', 'groups', 'annee_scolaires'))->with('data', json_encode($data));
    }

    // ! save update
    public function updateStagiaire(Request $request, Stagiaire $stagiaire)
    {
        $classe_id = DB::table('classes')->select('id')
            ->where('branche', $request->branche)
            ->where('num_group', $request->num_group)
            ->get();
        $formFill = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
        ]);
        $formFill['classe_id'] = $classe_id[0]->id;
        $stagiaire->fill($formFill)->save();
        return redirect()->route('admin.allStagiaire')->with('success', 'Le Stagiaire a été Bien Modifier !');
    }

    // ! delete stagiaire
    public function destroyStagiaire(Stagiaire $stagiaire)
    {
        $stagiaire->delete();
        return redirect()->route('admin.allStagiaire')->with('success', 'Le Stagiaire a été Bien Supprimé !');
    }

    // todo ========================================== crud stagiaire =======================================

    // todo ========================================== crud classe ==========================================

    // ! afficher les classes

    public function indexClasses()
    {
        $classes = Classe::paginate(10);
        $data = Classe::all();
        return view('admin.classe.indexClasse', compact('classes'))->with('data', json_encode($data));
    }

    // ! create classe
    public function createClasse()
    {
        return view('admin.classe.createClasse');
    }

    // ! insert classe dans db
    public function storeClasse(Request $request)
    {
        $classe = $request->validate([
            'branche' => 'required',
            'num_group' => 'required',
            'annee_scolaire' => 'required',
            'admin_id' => 'required',
        ]);
        $classe["branche"] = Str::upper($request->branche);
        Classe::create($classe);
        return redirect()->route('admin.createClasse')->with('success', 'Le Classe a été Bien Ajouté !');

    }

    // ! Show detail of classe
    public function showClasse(Classe $classe)
    {

        $stagiaires = $classe->stagiaires()->paginate(7);
        $stagiaireAbsence = [];
        $totalAbsences = 0;
        $absenceAvecPreuv = 0;
        $absenceSonPreuv = 0;

        foreach ($stagiaires as $stagiaire) {
            // * absence stagiaire
            $absencesCount = $stagiaire->presences()->where('classe_id', $classe->id)
                ->where('isPresence', 0)->count();
            $stagiaire->absencesCount = $absencesCount;
            $stagiaireAbsence[] = $stagiaire;
            // * absence dans classe
            $totalAbsences += $absencesCount;
            $stagiaire->absencesCount = $absencesCount;
            // * absence avec preuv / son preuv
            $absenceSonPreuv = $stagiaire->presences()->where('classe_id', $classe->id)
                ->where('isPresence', 0)->where('preuve', 'rien')->count();

            $absenceAvecPreuv = $stagiaire->presences()->where('classe_id', $classe->id)
                ->where('isPresence', 0)->where('preuve', '<>', 'rien')->count();

            $stagiaire->absenceSonPreuv = $absenceSonPreuv;
            $stagiaire->absenceAvecPreuv = $absenceAvecPreuv;

        }

        return view('admin.classe.showClasse', compact('classe', 'totalAbsences', 'stagiaireAbsence', 'stagiaires', ));
    }

    // ! Show the form for editing the specified resource.
    public function editClasse(Request $request, Classe $classe)
    {
        return view('admin.classe.editClasse', compact('classe'))->with('data', json_encode($classe->annee_scolaire));
    }

    // ! save update
    public function updateClasse(Request $request, Classe $classe)
    {
        $formFill = $request->validate([
            'branche' => 'required',
            'num_group' => 'required',
            'annee_scolaire' => 'required',
            'admin_id' => 'required',
        ]);
        $formFill['branche'] = Str::upper($formFill['branche']);
        $classe->fill($formFill)->save();
        return redirect()->route('admin.allClasses')->with('success', 'La Classe a été Bien Modifier !');
    }

    // ! delete classe
    public function destroyClasse(Classe $classe)
    {
        $classe->delete();
        return redirect()->route('admin.allClasses')->with('success', 'La Classe a été Bien Supprimé !');
    }

    // todo ========================================== crud classe ==========================================

    // todo ========================================== Absence =======================================
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
                    },
                ]);
            },
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
        $classes = Classe::paginate(7);
        return view('absence.index', compact('classes'));
    }
    //
    //
    //
    // * Modification d'un absence de stagiaire :
    function updateStagiairePresence(Request $request)
    {
        // dd($request->all());

        $presenceData = $request->validate([
            'presence_id' => 'required|exists:presences,id',
            'preuve' => 'required|string',
        ]);

        // dd($presenceData);

        $presence = Presence::find($presenceData['presence_id']);
        if (!$presence) {
            return redirect()->back()->withErrors(['error' => 'Presence de stagiaire n\'existe pas!']);
        }

        $presence->update($presenceData);
        return back()->with('success', 'Absence de stagiaire modifier avec succès!');
    }

    // todo ========================================== Absence =======================================

}