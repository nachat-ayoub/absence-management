<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\Formateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'admin';
    protected $fillable = ['nom', 'prenom', 'email', 'password'];

    /*
    relationship  between  table of  admins and formateurs
     */
    public function formateurs() {
        return $this->hasMany(Formateur::class);
    }
    /*
    relationship  between  table of  admins and classes
     */
    public function classes() {
        return $this->hasMany(Classe::class);
    }
}
