<?php

namespace Database\Seeders;

use App\Models\Classe;
use App\Models\Formateur;
use Database\Factories\ClasseFormateurFactory;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClasseFormateurSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Fetch the records of classe and formateur
        $classes = Classe::all();
        $foramteurs = Formateur::all();

        // Loop through the records and create pivot table entries
        foreach ($classes as $classe) {
            foreach ($foramteurs as $formateur) {
                // Create a new pivot table entry
                $classe->formateurs()->attach($formateur);
            }
        }
    }

}