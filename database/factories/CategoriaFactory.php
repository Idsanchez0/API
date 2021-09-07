<?php

namespace Database\Factories;

use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Categoria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_categoria' => $this->faker->numberBetween(1, 3),
            'nombre_categoria' => $this->faker->text(),
            'id_subclasificacion' => $this->faker->numberBetween(1, 3),
        ];
    }
}
