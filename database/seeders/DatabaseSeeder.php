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
        $this->call(ClientSeeder::class);
        $this->call(LeaguesSeeder::class);
        $this->call(ClubsSeeder::class);
        $this->call(CoachesSeeder::class);
        $this->call(FootballersSeeder::class);

        $this->call(LeagueClubsSeeder::class);
        $this->call(ClubCoachFootballersSeeder::class);
    }
}
