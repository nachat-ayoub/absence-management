<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Stagiaire;
use App\Models\Absence;

class Absence_stagiaire extends Model
{
    use HasFactory;
    /*
        relationship  between  table of Absence_stagiaires and stagiaires
    */
    public function stagiaire() {
        return $this->belongsTo(Stagiaire::class);
    }

    /*
        relationship  between  table of  Absence_stagiaires and absences
    */
    public function absence() {
        return $this->belongsTo(Absence::class);
    }
}
