<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Formateur extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'formateur';
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'admin_id'];
    /*
    relationship  between  table of formateurs and admins
     */
    public function admin() {
        return $this->belongsTo(Admin::class);
    }
    /*
    relationship  between  table of  formateurs and absences
     */
    public function presences() {
        return $this->hasMany(Presence::class);
    }
    /**
     * relationship between classes and formateurs
     */

    public function classes() {
        return $this->belongsToMany(Classe::class);
    }
}
