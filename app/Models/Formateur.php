<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;
use App\Models\Absence;

class Formateur extends Model
{
    use HasFactory;
    /*
        relationship  between  table of formateurs and admins
    */
    public function admin(){
        return $this->belongsTo(Admin::class);
    }
    /*
        relationship  between  table of  formateurs and absences
    */
    public function absences() {
        return  $this->hasMany(Absence::class);
    }
}
