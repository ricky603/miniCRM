<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$G4zbovEKHuNQuEGOWC7d.OickeEtqriFL4CZyvsbZV1W6dxpgOzFG'
        ]);
    }
}
