<?php

namespace Database\Factories;

use App\Models\DataSekolah;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class DataFasilitasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sekolah = DataSekolah::pluck('id')->all();
        return [
            'sekolah_id' => Arr::random($sekolah),
            'name' => $this->faker->sentence(),
            'jumlah' => rand(1,20),
        ];
    }
}
