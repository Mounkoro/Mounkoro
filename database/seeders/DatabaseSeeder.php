<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a Client
        $client = User::create([
            'name' => 'Jean Client',
            'email' => 'client@point.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);
        \App\Models\ClientProfile::create(['user_id' => $client->id]);

        // Create an Engineer
        $engineer = User::create([
            'name' => 'Thomas Expert',
            'email' => 'expert@point.com',
            'password' => bcrypt('password'),
            'role' => 'engineer',
        ]);
        \App\Models\EngineerProfile::create([
            'user_id' => $engineer->id,
            'skills' => 'Installation, Domotique, Dépannage',
            'intervention_zone' => 'Paris',
            'bio' => 'Expert électricien avec 10 ans d\'expérience.',
        ]);
    }
}
