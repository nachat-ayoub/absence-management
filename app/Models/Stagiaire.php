<?php

namespace App\Models;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model {
    use HasFactory;
    protected $fillable = ['nom', 'prenom', 'classe_id'];
    /*
    relationship  between  table of stagiaires and classes
     */
    public function Classe() {
        return $this->belongsTo(Classe::class);
    }
    /*
    relationship  between  table of stagiaires and presences
     */
    public function presences() {
        return $this->hasMany(Presence::class);
    }
}
