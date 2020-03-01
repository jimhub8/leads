<?php

use App\models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
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
            Client::create([
                'user_id' => $faker->numberBetween($min = 1, $max = 4),
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'staff_id' => $faker->numberBetween($min = 1, $max = 4),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'tel' => $faker->phoneNumber,
                'notes' => $faker->text,
            ]);
        }
    }
}
