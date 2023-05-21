<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe_formateur extends Model
{
    use HasFactory;
    protected $fillable = ['classe_id', 'formateur_id'];
}