<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Presence::factory()->createMany([
            [
                'stagiaire_id' => 1,
                'classe_id' => 1,
                'formateur_id' => 1,
                'date' => '2023-05-22',
                'seance' => '1,2',
                'isPresence' => true,
                'preuve' => NULL,
            ],
            [
                'stagiaire_id' => 2,
                'classe_id' => 1,
                'formateur_id' => 1,
                'date' => '2023-05-22',
                'seance' => '1,2',
                'isPresence' => false,
                'preuve' => 'rien'
            ],
            [
                'stagiaire_id' => 3,
                'classe_id' => 1,
                'formateur_id' => 1,
                'date' => '2023-05-22',
                'seance' => '1,2',
                'isPresence' => true,
                'preuve' => NULL,
            ],
            [
                'stagiaire_id' => 4,
                'classe_id' => 1,
                'formateur_id' => 1,
                'date' => '2023-05-22',
                'seance' => '1,2',
                'isPresence' => true,
                'preuve' => NULL,
            ],
            [
                'stagiaire_id' => 5,
                'classe_id' => 1,
                'formateur_id' => 1,
                'date' => '2023-05-22',
                'seance' => '1,2',
                'isPresence' => true,
                'preuve' => NULL,
            ],
            [
                'stagiaire_id' => 1,
                'classe_id' => 1,
                'seance' => '3',
                'formateur_id' => 2,
                'date' => '2023-05-23',
                'isPresence' => true,
                'preuve' => NULL,
            ],
            [
                'stagiaire_id' => 2,
                'classe_id' => 1,
                'formateur_id' => 2,
                'date' => '2023-05-23',
                'seance' => '3',
                'isPresence' => false,
                'preuve' => 'rien'
            ],
            [
                'stagiaire_id' => 3,
                'classe_id' => 1,
                'formateur_id' => 2,
                'date' => '2023-05-23',
                'seance' => '3',
                'isPresence' => false,
                'preuve' => 'medicale'
            ],
            [
                'stagiaire_id' => 4,
                'classe_id' => 1,
                'formateur_id' => 2,
                'date' => '2023-05-23',
                'seance' => '3',
                'isPresence' => true,
                'preuve' => NULL,
            ],
            [
                'stagiaire_id' => 5,
                'classe_id' => 1,
                'formateur_id' => 2,
                'date' => '2023-05-23',
                'seance' => '3',
                'isPresence' => false,
                'preuve' => 'rien'
            ],
            [
                'stagiaire_id' => 1,
                'classe_id' => 1,
                'formateur_id' => 1,
                'date' => '2023-05-24',
                'seance' => '3,4',
                'isPresence' => false,
                'preuve' => 'medicale'
            ],
            [
                'stagiaire_id' => 2,
                'classe_id' => 1,
                'formateur_id' => 1,
                'date' => '2023-05-24',
                'seance' => '3,4',
                'isPresence' => false,
                'preuve' => 'rien'
            ],
            [
                'stagiaire_id' => 3,
                'classe_id' => 1,
                'formateur_id' => 1,
                'date' => '2023-05-24',
                'seance' => '3,4',
                'isPresence' => true,
                'preuve' => NULL,
            ],
            [
                'stagiaire_id' => 4,
                'classe_id' => 1,
                'formateur_id' => 1,
                'date' => '2023-05-24',
                'seance' => '3,4',
                'isPresence' => true,
                'preuve' => NULL,
            ],
            [
                'stagiaire_id' => 5,
                'classe_id' => 1,
                'formateur_id' => 1,
                'date' => '2023-05-24',
                'seance' => '3,4',
                'isPresence' => false,
                'preuve' => 'rien'
            ],
            [
                'stagiaire_id' => 1,
                'classe_id' => 1,
                'formateur_id' => 2,
                'date' => '2023-05-25',
                'seance' => '2',
                'isPresence' => true,
                'preuve' => NULL,
            ],
            [
                'stagiaire_id' => 2,
                'classe_id' => 1,
                'formateur_id' => 2,
                'date' => '2023-05-25',
                'seance' => '2',
                'isPresence' => false,
                'preuve' => 'medicale'
            ],
            [
                'stagiaire_id' => 3,
                'classe_id' => 1,
                'formateur_id' => 2,
                'date' => '2023-05-25',
                'seance' => '2',
                'isPresence' => true,
                'preuve' => NULL,
            ],
            [
                'stagiaire_id' => 4,
                'classe_id' => 1,
                'formateur_id' => 2,
                'date' => '2023-05-25',
                'seance' => '2',
                'isPresence' => false,
                'preuve' => 'rien'
            ],
            [
                'stagiaire_id' => 5,
                'classe_id' => 1,
                'seance' => '2',
                'formateur_id' => 2,
                'date' => '2023-05-25',
                'isPresence' => false,
                'preuve' => 'rien'
            ]
        ]);
    }
}