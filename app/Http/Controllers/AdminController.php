<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Classe;
use App\Models\Formateur;
use App\Models\Stagiaire;
use Illuminate\Http\Request;
use App\Models\Absence_stagiaire;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    // ! Dashboard Admin
    public function dashboard()
    {
        $nbr_absence = Absence_stagiaire::all()->count();

        $nbr_absence_sans_preuve = DB::select('select COUNT(*) as nbr from absence_stagiaires where UPPER(preuve) =  "RIEN";');

        $nbr_stagiaires = Stagiaire::all()->count();

        $nbr_absences_par_stagiaire = ((float) $nbr_absence / (float) $nbr_stagiaires) * 100;
        $nbr_classes = Classe::all()->count();

        $nbr_absences_par_classe = DB::table('absences')->select('classe_id', DB::raw('count(*) as total'))->groupBy('classe_id')->get();

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

        $derniere_stagiaire_absencet = DB::table('absence_stagiaires')
            ->select('absence_stagiaires.preuve', 'absences.date', 'stagiaires.nom', 'stagiaires.prenom', 'classes.branche', 'classes.num_group')
            ->join('stagiaires', 'absence_stagiaires.stagiaire_id', '=', 'stagiaires.id')
            ->join('classes', 'stagiaires.classe_id', '=', 'classes.id')
            ->join('absences', 'classes.id', '=', 'absences.classe_id')
            ->orderBy('absence_stagiaires.created_at', 'desc')
            ->take(5)
            ->get();

        $classes_en_fonction_absences = DB::table('absences')
            ->select('classes.branche', 'classes.num_group', DB::raw('count(*) as absence_count'))
            ->join('classes', 'absences.classe_id', '=', 'classes.id')
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


    // todo ========================================== crud formateur ==========================================

    // ! afficher les formateurs
    public function indexFormateur()
    {
        $formateurs = Formateur::all();
        // return $formateures;
        return view('formateurs', compact('formateurs'));
    }




    // ! create formateur
    public function createFormateur()
    {
        return view('createFormateur');
    }



    // ! insert formateur dans db
    public function storeFormateur(Request $request)
    {
        // $formateur = new Formateur();
        // $formateur -> prenom = 'ABODO';
        // $formateur -> nom = 'Hatim';
        // $formateur -> email = 'AHatim';
        // $formateur -> password = Hash::make('hatim2002') ;
        // $formateur -> admin_id = 1 ;
        // $formateur->save();
        // return'good';


        $formateur = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'password' => 'required',
            // 'admin_id'=>'required',
        ]);
        // $formateur=new Formateur();
        // $formateur->nom=$request->nom;
        // $formateur->prenom=$request->prenom;
        // $formateur->email=$request->email;
        // $formateur->password=$request->password;
        // $formateur->admin_id= 1;
        // $formateur->save();
        // ? Hash le met de passe
        $formateur['password'] = Hash::make($request->password);

        $formateur['admin_id'] = 1;
        Formateur::create($formateur);
        return redirect('formateurs')->with('success', 'formateur created successfully!');
    }











    // ! Show detail of Formateur
    public function showFormateur(Request $request, Formateur $formateur)
    {
        //

        return view('showFormateur', compact('formateur'));
    }









    // ! Show the form for editing the specified resource.
    public function editFormateur(Request $request, Formateur $formateur)
    {
        //
        return view('editFormateur', compact('formateur'));
    }


    // ! save update
    public function updateFormateur(Request $request, Formateur $formateur)
    {
        //
        // $formateur=Formateur::find(6);
        // $formateur->id=6;
        // $formateur->nom='NACHAT';
        // $formateur->prenom="Ayoub";
        // $formateur->email='NAyoub';
        // $formateur->password=Hash::make('nachat');
        // $formateur->admin_id= 1;
        // $formateur->save();
        // return 'good';



        $request->validate([
            'id' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'email' => 'required',
            'password' => 'required',
            'admin_id' => 'required',
        ]);
        $formateur->id = $request->id;
        $formateur->nom = $request->nom;
        $formateur->prenom = $request->prenom;
        $formateur->email = $request->email;
        $formateur->password = Hash::make($request->password);
        $formateur->admin_id = 1;
        $formateur->save();
        return redirect('formateurs')->with('success', 'formateur updated successfully!');
    }


    // ! delete formateur
    public function destroyFormateur(Formateur $formateur)
    {
        //
        // $formateur=Formateur::find(1);
        $formateur->delete();
        // return 'good';
        return redirect('formateurs')->with('success', 'formateur deleted successfully!');
    }

    // todo ========================================== crud formateur ==========================================

















    // todo ========================================== crud stagiaire ==========================================

    // ! afficher les stagiaires
    public function indexStagiaire()
    {
        //
        $stagiaires = Stagiaire::all();
        // return $data;
        return view('stagiaires', compact('stagiaires'));
    }






    // ! create stagiaire
    public function createStagiaire()
    {
        //
        return view('createStagiaire');
    }






    // ! insert stagiaire dans db
    public function storeStagiaire(Request $request)
    {
        //
        // $stagiaire = new Stagiaire();
        // $stagiaire->nom = 'ABODO';
        // $stagiaire->prenom = 'Hatim';
        // $stagiaire->classe_id = 1;
        // $stagiaire->save();
        // return 'good';



        $stagiaire = $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'classe_id' => 'required',
        ]);
        $stagiaire['classe_id'] = 1;
        Stagiaire::create($stagiaire);

        // $stagiaire = new Stagiaire();
        // $stagiaire->nom = $request->nom;
        // $stagiaire->prenom = $request->prenom;
        // $stagiaire->email = $request->email;
        // $stagiaire->filiere = $request->filiere;
        // $stagiaire->save();
        return redirect('stagiaires')->with('success', 'Stagiaire created successfully!');
    }







    // ! Show detail of stagiaire
    public function showStagiaire(Stagiaire $stagiaire)
    {
        return view('showStagiaire', compact('stagiaire'));
    }








    // ! Show the form for editing the specified resource.
    public function editStagiaire(Stagiaire $stagiaire)
    {
        return view('editStagiaire', compact('stagiaire'));
    }








    // ! save update
    public function updateStagiaire(Request $request, Stagiaire $stagiaire)
    {



        $request->validate([
            'id' => 'required',
            'nom' => 'required',
            'prenom' => 'required',
            'classe_id' => 'required',
        ]);
        $stagiaire->id = $request->id;
        $stagiaire->nom = $request->nom;
        $stagiaire->prenom = $request->prenom;
        $stagiaire->classe_id = $request->classe_id;
        $stagiaire->save();
        return redirect('stagiaires')->with('success', 'Stagiaire updated successfully!');
    }






    // ! delete stagiaire
    public function destroyStagiaire(Stagiaire $stagiaire)
    {

        $stagiaire->delete();
        return redirect('stagiaires')->with('success', 'Stagiaire deleted successfully!');
    }






    // ! search stagiaires de la branche 'nameBranch'
    public function searchStagiaire(Request $request)
    {

        // * test good


        // ! use idee

        $element = $request->input('element');

        $stagiaires = Classe::join('stagiaires', 'stagiaires.classe_id', '=', 'classes.id')
            ->select('stagiaires.nom', 'classes.branche')
            ->where('classes.branche', '=', $element)
            ->get();
        return view('stagiaires.search_branche', ['stagiaires' => $stagiaires]);




        // view
        // <form action="{{ route('search_stagiaires_branche') }}" method="GET">
        //     <input type="text" name="element" placeholder="Search for element...">
        //     <button type="submit">Search</button>
        // </form>



        // route
        // Route::get('/search_stagiaires_branche', [AdminController::class ,'search'])->name('search')


    }


    // todo ========================================== crud stagiaire ==========================================











    // todo ========================================== crud classe ============================================

    // ! afficher les classes

    public function indexClasses()
    {
        $classes = Classe::all();
        // return $classes;
        return view('classes', compact('classes'));
    }








    // ! create classe
    public function createClasse()
    {
        return view('createClasse');
    }






    // ! insert classe dans db
    public function storeClasse(Request $request)
    {
        // $classe = new Classe();
        // $classe->branche = 'AA';
        // $classe->num_group = 102;
        // $classe->annee_scolaire = '2022';
        // $classe->admin_id = 1;
        // $classe -> save();
        // return 'good';


        $classe = $request->validate([
            'branche' => 'required',
            'num_group' => 'required',
            'annee_scolaire' => 'required',
            'admin_id' => 'required',
        ]);
        $classe['admin_id'] = 1;
        Classe::create($classe);
        return redirect('classes')->with('success', 'Classe created successfully!');

    }





    // ! Show detail of classe
    public function showClasse(Classe $classe)
    {
        // return $classe;
        return view('showClasse', compact('classe'));
    }









    // ! Show the form for editing the specified resource.
    public function editClasse(Request $request, Classe $classe)
    {
        //
        return view('editClasse', compact('classe'));
    }





    // ! save update
    public function updateClasse(Request $request, Classe $classe)
    {
        //

        $request->validate([
            'id' => 'required',
            'branche' => 'required',
            'num_group' => 'required',
            'annee_scolaire' => 'required',
            'admin_id' => 'required',
        ]);

        // $classe = Classe::find(17);
        // $classe->id = 17;
        // $classe->branche = 'DD';
        // $classe->num_group = 103;
        // $classe->annee_scolaire = '2012';
        // $classe->admin_id = 1;
        // $classe->save();


        $classe->id = $request->id;
        $classe->branche = $request->branche;
        $classe->num_group = $request->num_group;
        $classe->annee_scolaire = $request->annee_scolaire;
        $classe->admin_id = 1;
        $classe->save();
        return redirect('classes')->with('success', 'classe updated successfully!');
    }





    // ! delete classe
    public function destroyClasse(Classe $classe)
    {
        //
        // $classe=Classe::find(13);
        $classe->delete();
        // return 'good';
        return redirect('classes')->with('success', 'classe deleted successfully!');
    }






    // ! select * from stagiaire where classe_id = 1
    public function allStagiaires(Classe $classe)
    {
        $classe = Classe::find(6);
        $stagiaire = $classe->stagiaires;
        return $stagiaire;
    }


    // todo ========================================== crud classe ============================================
}