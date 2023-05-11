<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Formateur;
use App\Models\Classe;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = ['nom' , 'prenom' , 'email' , 'password'];
    /*
        relationship  between  table of  admins and formateurs
    */
    public function formateurs() {
        return $this->hasMany(Formateur::class);        ;
    }
    /*
        relationship  between  table of  admins and classes
    */
    public function classes() {
        return $this->hasMany(Classe::class);        ;
    }
}