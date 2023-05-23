<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Absence;
use App\Models\Presence;
use App\Models\Formateur;
use App\Models\Stagiaire;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    // ! Dashboard Admin
    public function dashboard()
    {
        $nbr_absence = DB::table('presences')->where("isPresence", 0)->count();

        $nbr_absence_sans_preuve = DB::select('select COUNT(*) as nbr from presences where UPPER(preuve) =  "RIEN";');

        $nbr_stagiaires = Stagiaire::all()->count();

        $nbr_absences_par_stagiaire = ((float) $nbr_absence / (float) $nbr_stagiaires) * 100;
        $nbr_classes = Classe::all()->count();

        $nbr_absences_par_classe = DB::table('presences')->select('classe_id', DB::raw('count(*) as total'))->where('isPresence', 0)->groupBy('classe_id')->get();

        $stgClasse = DB::table('stagiaires')->select('classe_id', DB::raw('count(*) as stgDeClasse'))->groupBy('classe_id')->get(); // selection le nombre de stagiaire de chaque classe

        $avg_absence_par_classe = 0.0;

        foreach ($nbr_absences_par_classe as $absence) {
            foreach ($stgClasse as $nbrStgClasse) {
                if ($nbrStgClasse->classe_id == $absence->classe_id) {
                    $avg_absence_par_classe += (float) ($absence->total / $nbrStgClasse->stgDeClasse);
                }
            }
        }
        $avg_absence_par_classe = ($avg_absence_par_classe / $nbr_classes) * 100;

        $derniere_stagiaire_absencet = Presence::select('presences.preuve', 'presences.date', 'stagiaires.nom', 'stagiaires.prenom', 'classes.branche', 'classes.num_group')
            ->join('stagiaires', 'presences.stagiaire_id', '=', 'stagiaires.id')
            ->join('classes', 'stagiaires.classe_id', '=', 'classes.id')
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
            'classes_en_fonction_absences' => $classes_en_fonction_absences
        ]);
    }


    // todo ========================================== crud formateur =======================================

    // ! afficher les formateurs
    public function indexFormateur()
    {
        $formateurs = Formateur::paginate(7);
        $data = Formateur::all();
        return view('admin.formateurs.indexformateur', compact('formateurs'))->with('data', json_encode($data));
    }




    // ! create formateur
    public function createFormateur()
    {
        return view('admin.formateurs.createFormateur');
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
        Formateur::create($formateur);
        return redirect()->route('admin.createFormateur')->with('success', 'formateur created successfully!');
    }











    // ! Show detail of Formateur
    public function showFormateur(Request $request, Formateur $formateur)
    {
        return view('admin.formateurs.showFormateur', compact('formateur'));
    }









    // ! Show the form for editing the specified resource.
    public function editFormateur(Request $request, Formateur $formateur)
    {
        return view('admin.formateurs.editFormateur', compact('formateur'));
    }


    // ! save update
    public function updateFormateur(Request $request, Formateur $formateur)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $formateur->nom = $request->nom;
        $formateur->prenom = $request->prenom;
        $formateur->email = $request->email;
        $formateur['password'] = Hash::make($request->password);
        $formateur['admin_id'] = 1;
        $formateur->save();
        return redirect()->route('admin.formateurs')->with('success', 'formateur updated successfully!');
    }


    // ! delete formateur
    public function destroyFormateur(Formateur $formateur)
    {
        $formateur->delete();
        return redirect()->route('admin.formateurs')->with('success', 'formateur deleted successfully!');
    }

    // todo ========================================== crud formateur =======================================

















    // todo ========================================== crud stagiaire =======================================

    // ! afficher les stagiaires
    public function indexStagiaire()
    {
        $stagiaires = Stagiaire::paginate(6);
        $stagiaires_localstor = Stagiaire::all();
        return view('admin.stagiaire.index', compact('stagiaires'))->with('data', json_encode($stagiaires_localstor));
    }






    // ! create stagiaire
    public function createStagiaire()
    {
        $branches = Classe::distinct()->pluck('branche', 'id');
        return view('admin.stagiaire.createStagiaire', compact('branches'));
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
        Stagiaire::create($stagiaire);
        return redirect()->route('admin.createStagiaire')->with('success', 'le stagiaire a été ajouté!');
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
        return view('admin.stagiaire.editStagiaire', compact('stagiaire', 'branches'));
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
        return redirect()->route('admin.allStagiaire')->with('success', 'le stagiaire a été bien modifier!');
    }






    // ! delete stagiaire
    public function destroyStagiaire(Stagiaire $stagiaire)
    {
        $stagiaire->delete();
        return redirect()->route('admin.allStagiaire')->with('success', 'Stagiaire deleted successfully!');
    }






    // todo ========================================== crud stagiaire =======================================











    // todo ========================================== crud classe ==========================================

    // ! afficher les classes

    public function indexClasses()
    {
        $classes = Classe::paginate(7);
        // return $classes;
        return view('admin.classe.indexClasse', compact('classes'));
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
        return redirect()->route('admin.allClasses')->with('success', 'La classe a été crée avec success');

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

        return view('admin.classe.showClasse', compact('classe', 'totalAbsences', 'stagiaireAbsence', 'stagiaires'));
    }









    // ! Show the form for editing the specified resource.
    public function editClasse(Request $request, Classe $classe)
    {
        return view('admin.classe.editClasse', compact('classe'));
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
        return redirect()->route('admin.allClasses')->with('success', 'classe updated successfully!');
    }





    // ! delete classe
    public function destroyClasse(Classe $classe)
    {
        $classe->delete();
        return redirect('admin.allClasses')->with('success', 'classe deleted successfully!');
    }









    // todo ========================================== crud classe ==========================================
}