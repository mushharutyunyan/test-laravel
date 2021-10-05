<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class CoachesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 80; $i++) {
            DB::table('coaches')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'surname' => $faker->firstName,
                'birthdate' => $faker->date
            ]);
        }
    }
}
