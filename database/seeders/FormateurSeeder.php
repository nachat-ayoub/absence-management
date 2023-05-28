<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FormateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Formateur::factory()->createMany([
            [
                'nom' => 'test1',
                'prenom' => 'test1',
                'email' => 'test1@gmail.com',
                'password' => Hash::make('test1@gmail.com'),
                'admin_id' => 1
            ],
            [
                'nom' => 'test2',
                'prenom' => 'test2',
                'email' => 'test2@gmail.com',
                'password' => Hash::make('test2@gmail.com'),
                'admin_id' => 1
            ]
        ]);
    }
}