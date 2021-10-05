<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class FootballersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 2000; $i++) {
            DB::table('footballers')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'surname' => $faker->firstName,
                'birthdate' => $faker->date,
                'transfer_cost' => $faker->randomFloat(2),
                'kicking_foot' => $faker->randomElement(['right' ,'left'])
            ]);
        }
    }
}
