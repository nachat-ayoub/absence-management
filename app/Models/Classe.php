<?php

namespace App\Models;

use App\Models\Absence;
use App\Models\Admin;
use App\Models\Stagiaire;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model {
    use HasFactory;

    protected $fillable = ['branche', 'num_group', 'annee_scolaire', 'admin_id'];
    /*
    relationship  between  table of classes and admins
     */
    public function admin() {
        return $this->belongsTo(Admin::class);
    }
    /*
    relationship  between  table of classes and stagiaires
     */
    public function stagiaires() {
        return $this->hasMany(Stagiaire::class);
    }
    /*
    relationship  between  table of classes and absences
     */
    public function absences() {
        return $this->hasMany(Absence::class);
    }
}
