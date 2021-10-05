<?php

namespace Database\Seeders;

use App\Models\Club;
use App\Models\Coach;
use App\Models\Footballer;
use Illuminate\Database\Seeder;

class ClubCoachFootballersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Club::all() as $club) {
            $limit = rand(1,5);
            $club->coaches()->sync(Coach::inRandomOrder()->limit($limit)->pluck('id')->toArray());
            $limit = rand(15,30);
            $club->footballers()->sync(Footballer::inRandomOrder()->limit($limit)->pluck('id')->toArray());
        }
    }
}
