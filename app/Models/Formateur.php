<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Admin;
use App\Models\Absence;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Formateur extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'formateur';
    protected $fillable = ['nom', 'prenom', 'email', 'password', 'admin_id'];
    /*
    relationship  between  table of formateurs and admins
    */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
    /*
    relationship  between  table of  formateurs and absences
    */
    public function absences()
    {
        return $this->hasMany(Absence::class);
    }
}