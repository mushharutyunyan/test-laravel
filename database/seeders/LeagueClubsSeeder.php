<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\League;
use Illuminate\Database\Seeder;

class LeagueClubsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (League::all() as $league) {
            $limit = rand(18,22);
            $league->clubs()->sync(Club::inRandomOrder()->limit($limit)->pluck('id')->toArray());
        }
    }
}
