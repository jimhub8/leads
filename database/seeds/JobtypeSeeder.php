<?php

use App\models\Jobtype;
use Illuminate\Database\Seeder;

class JobtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        foreach (range(1, 5) as $index) {
            Jobtype::create([
                'user_id' => $faker->numberBetween($min = 1, $max = 4),
                'jobtype' => $faker->word,
                'description' => $faker->text,
            ]);
        }
    }
}
