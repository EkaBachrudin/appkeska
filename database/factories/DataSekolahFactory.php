<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class DataSekolahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $level = ['SD', 'SMP', 'SMA'];
        return [
            'name' => $this->faker->company(),
            'jenjang' => Arr::random($level),
            'lokasi' => $this->faker->address(),
        ];
    }
}
