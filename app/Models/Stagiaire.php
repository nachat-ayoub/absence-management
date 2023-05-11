<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Classe;
use App\Models\Absence_stagiaire;

class Stagiaire extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'classe_id'];
    /*
    relationship  between  table of stagiaires and classes
    */
    public function Classe()
    {
        return $this->belongsTo(Classe::class);
    }
    /*
    relationship  between  table of stagiaires and absence_stagiaires
    */
    public function absencesStagiaires()
    {
        return $this->hasMany(Absence_stagiaire::class);
    }
}