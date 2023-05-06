<?php

namespace App\Http\Controllers;

use App\Models\Formateur;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // ! afficher les formateur
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
        $request->validate([
            'nom'=>'required',
            'prenom'=>'required',
            'username'=>'required',
            'mot_de_passe'=>'required',
        ]);
        $formateur=new Formateur();
        $formateur->nom=$request->nom;
        $formateur->prenom=$request->prenom;
        $formateur->username=$request->username;
        $formateur->mot_de_passe=$request->mot_de_passe;
        $formateur->save();
        return redirect('stagiaires')->with('success','formateur created successfully!');

    }










}
