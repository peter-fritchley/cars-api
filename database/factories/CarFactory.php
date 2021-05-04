<?php

namespace Database\Factories;

use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    public function definition()
    {
        $this->faker->addProvider(new Fakecar($this->faker));

        $brand = $this->faker->vehicleBrand();
        $model = $this->faker->vehicleModel($brand);

        return [
            'make' => $brand,
            'model' => $model,
            'build_date' => $this->faker->dateTimeBetween('-4 years', 'now')
        ];
    }
}