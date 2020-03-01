<?php

use App\models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
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
            Job::create([
                'staff_id' => $faker->numberBetween($min = 1, $max = 4),
                'user_id' => $faker->numberBetween($min = 1, $max = 4),
                'client_id' => $faker->numberBetween($min = 1, $max = 4),
                'jobtype_id' => $faker->numberBetween($min = 1, $max = 4),
                'status' => $faker->word,
                'completed_on' => $faker->dateTime(),
                'cancelled_on' => $faker->dateTime(),
                'description' => $faker->text,
                'staff_comments' => $faker->text,

            ]);
        }
    }
}
