<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Formateur;
use App\Models\Stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


// todo ========================================== crud formateur ==========================================

// ! afficher les formateurs
    public function indexFormateur()
    {
        $formateurs = Formateur::all();
        // return $formateures;
        return view('formateurs' , compact('formateurs'));
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
        // $formateur -> username = 'AHatim';
        // $formateur -> mot_de_passe = Hash::make('hatim2002') ;
        // $formateur -> admin_id = 1 ;
        // $formateur->save();
        // return'good';


        $formateur = $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'username'=>'required',
            'mot_de_passe'=>'required',
            // 'admin_id'=>'required',
        ]);
        // $formateur=new Formateur();
        // $formateur->nom=$request->nom;
        // $formateur->prenom=$request->prenom;
        // $formateur->username=$request->username;
        // $formateur->mot_de_passe=$request->mot_de_passe;
        // $formateur->admin_id= 1;
        // $formateur->save();
        $formateur['admin_id'] = 1;
        Formateur::create($formateur);
        return redirect('formateurs')->with('success','formateur created successfully!');
    }











    // ! Show detail of Formateur
    public function showFormateur(Request $request, Formateur $formateur)
    {
        //

        return view('showFormateur' , compact('formateur'));
    }









    // ! Show the form for editing the specified resource.
    public function editFormateur(Request $request, Formateur $formateur)
    {
        //
        return view('editFormateur' , compact('formateur'));
    }


    // ! save update
    public function updateFormateur(Request $request, Formateur $formateur)
    {
        //
        // $formateur=Formateur::find(6);
        // $formateur->id=6;
        // $formateur->nom='NACHAT';
        // $formateur->prenom="Ayoub";
        // $formateur->username='NAyoub';
        // $formateur->mot_de_passe=Hash::make('nachat');
        // $formateur->admin_id= 1;
        // $formateur->save();
        // return 'good';



        $request->validate([
            'id'=>'required',
            'nom'=>'required',
            'prenom'=>'required',
            'username'=>'required',
            'mot_de_passe'=>'required',
            'admin_id'=>'required',
        ]);
        $formateur->id=$request->id;
        $formateur->nom=$request->nom;
        $formateur->prenom=$request->prenom;
        $formateur->username=$request->username;
        $formateur->mot_de_passe=$request->mot_de_passe;
        $formateur->admin_id= 1;
        $formateur->save();
        return redirect('formateurs')->with('success','formateur updated successfully!');
    }


// ! delete formateur
    public function destroyFormateur(Formateur $formateur)
    {
        //
        // $formateur=Formateur::find(1);
        $formateur->delete();
        // return 'good';
        return redirect('formateurs')->with('success','formateur deleted successfully!');
    }

// todo ========================================== crud formateur ==========================================

















// todo ========================================== crud stagiaire ==========================================

// ! afficher les stagiaires
public function indexStagiaire()
    {
        //
        $stagiaires = Stagiaire::all();
        // return $data;
        return view('stagiaires' , compact('stagiaires'));
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
            'nom'=>'required',
            'prenom'=>'required',
            'classe_id'=>'required',
        ]);
        $stagiaire['classe_id'] = 1 ;
        Stagiaire::create($stagiaire);

        // $stagiaire = new Stagiaire();
        // $stagiaire->nom = $request->nom;
        // $stagiaire->prenom = $request->prenom;
        // $stagiaire->Username = $request->username;
        // $stagiaire->filiere = $request->filiere;
        // $stagiaire->save();
        return redirect('stagiaires')->with('success','Stagiaire created successfully!');
    }







    // ! Show detail of stagiaire
    public function showStagiaire(Stagiaire $stagiaire)
    {
        //
        // return $stagiaire;
        return view('showStagiaire' , compact('stagiaire'));
    }








    // ! Show the form for editing the specified resource.
    public function editStagiaire(Stagiaire $stagiaire)
    {
        //
        return view('editStagiaire' , compact('stagiaire'));
    }








    // ! save update
    public function updateStagiaire(Request $request, Stagiaire $stagiaire)
    {
        //

        // $stagiaire=Stagiaire::find(62);
        // $stagiaire->id=62;
        // $stagiaire->nom='ZAARAOUI';
        // $stagiaire->prenom="Mustapha";
        // $stagiaire->classe_id=1;
        // $stagiaire->save();
        // return 'good';


        $request->validate([
            'id'=>'required',
            'nom'=>'required',
            'prenom'=>'required',
            'classe_id'=>'required',
        ]);
        $stagiaire->id=$request->id;
        $stagiaire->nom=$request->nom;
        $stagiaire->prenom=$request->prenom;
        $stagiaire->classe_id=$request->classe_id;
        $stagiaire->save();
        return redirect('stagiaires')->with('success','Stagiaire updated successfully!');
    }






    // ! delete stagiaire
    public function destroyStagiaire(Stagiaire $stagiaire)
    {
        //
        // $stagiaire=Stagiaire::find(1);
        $stagiaire->delete();
        // return 'good';
        return redirect('stagiaires')->with('success','Stagiaire deleted successfully!');
    }


// todo ========================================== crud stagiaire ==========================================











// todo ========================================== crud classe ============================================

// ! afficher les classes

    public function indexClasses()
    {
        $classes=Classe::all();
        // return $classes;
        return view('classes' , compact('classes'));
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
            'branche'=>'required',
            'num_group'=>'required',
            'annee_scolaire'=>'required',
            'admin_id'=>'required',
        ]);
        $classe['admin_id']=1;
        Classe::create($classe);
        return redirect('classes')->with('success','Classe created successfully!');

    }





    // ! Show detail of classe
    public function showClasse(Classe $classe)
    {
        // return $classe;
        return view('showClasse' , compact('classe'));
    }









    // ! Show the form for editing the specified resource.
    public function editClasse(Request $request, Classe $classe)
    {
        //
        return view('editClasse' , compact('classe'));
    }





    // ! save update
    public function updateClasse(Request $request, Classe $classe)
    {
        //

        $request->validate([
            'id'=>'required',
            'branche'=>'required',
            'num_group'=>'required',
            'annee_scolaire'=>'required',
            'admin_id'=>'required',
        ]);

        // $classe = Classe::find(17);
        // $classe->id = 17;
        // $classe->branche = 'DD';
        // $classe->num_group = 103;
        // $classe->annee_scolaire = '2012';
        // $classe->admin_id = 1;
        // $classe->save();


        $classe->id=$request->id;
        $classe->branche=$request->branche;
        $classe->num_group=$request->num_group;
        $classe->annee_scolaire=$request->annee_scolaire;
        $classe->admin_id= 1;
        $classe->save();
        return redirect('classes')->with('success','classe updated successfully!');
    }





    // ! delete classe
    public function destroyClasse(Classe $classe)
    {
        //
        // $classe=Classe::find(13);
        $classe->delete();
        // return 'good';
        return redirect('classes')->with('success','classe deleted successfully!');
    }



// todo ========================================== crud classe ============================================
}
