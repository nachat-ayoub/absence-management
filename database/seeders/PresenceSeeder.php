<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PresenceSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        \App\Models\Presence::factory(40)->create();
    }
}
