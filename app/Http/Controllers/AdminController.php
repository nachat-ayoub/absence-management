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



    // ! Show the form for editing the specified resource.
    public function editFormateur(Request $request, Formateur $formateur)
    {
        //
        return view('edit' , compact('formateur'));
    }


    // ! save update
    public function updateFormateur(Request $request, Formateur $formateur)
    {
        //
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







    public function destroyFormateur(Formateur $formateur)
    {
        //
        $formateur->delete();
        return redirect('formateurs')->with('success','formateur deleted successfully!');
    }




}
