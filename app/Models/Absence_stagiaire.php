<?php

namespace App\Models;

use App\Models\Absence;
use App\Models\Stagiaire;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absence_stagiaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'absence_id',
        'stagiaire_id',
        'preuve'
    ];

    /*
    relationship  between  table of Absence_stagiaires and stagiaires
    */
    public function stagiaire()
    {
        return $this->belongsTo(Stagiaire::class);
    }

    /*
    relationship  between  table of  Absence_stagiaires and absences
    */
    public function absence()
    {
        return $this->belongsTo(Absence::class);
    }
}