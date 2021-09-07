<?php

namespace Database\Factories;

use App\Models\Clasificacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClasificacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Clasificacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_clasificacion' => $this->faker->numberBetween(1,100),
            'nombre_clasificacion' => $this->faker->text(),
        ];
    }
}
