<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model {
    use HasFactory;
    protected $fillable = ['stagiaire_id', 'classe_id', 'formateur_id', 'date', 'isPresence', 'seance', 'preuve'];

    /**
     * relationship between classes and presences
     */
    public function classe() {
        return $this->belongsTo(Classe::class);
    }
    /**
     * relationship  between stagiaires and presences
     */
    public function stagiaire() {
        return $this->belongsTo(Stagiaire::class);
    }

}
