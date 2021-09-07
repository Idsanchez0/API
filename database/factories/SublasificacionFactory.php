<?php

namespace Database\Factories;

use App\Models\Subclasificacion;
use Illuminate\Database\Eloquent\Factories\Factory;

class SublasificacionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subclasificacion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_subclasificacion' => $this->faker->numberBetween(1,3),
            'nombre_subclasificacion' => $this->faker->text(),
            'id_clasificacion' => $this->faker->numberBetween(1,3),
        ];
    }
}
