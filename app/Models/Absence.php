<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\Formateur;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence extends Model {
    use HasFactory;

    /*
    relationship  between  table of  absences and formateurs
     */
    public function formateur() {
        return $this->belongsTo(Formateur::class);
    }

    /*
    relationship  between  table of  absences and classes
     */
    public function classe() {
        return $this->belongsTo(Classe::class);
    }

    /*
    relationship  between  table of  absences and Absence_stagiaires
     */
    public function absencesStagiaires() {
        return $this->hasMany(Absence_stagiaire::class);
    }
}
