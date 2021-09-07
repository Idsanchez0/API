<?php

namespace Database\Factories;

use App\Models\TiposProductos;
use Illuminate\Database\Eloquent\Factories\Factory;

class TiposProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TiposProductos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_tipo_producto' => $this->faker->numberBetween(1, 3),
            'tipo_producto' => $this->faker->text(),
            'descripcion_tipo_producto' => $this->faker->text(),
        ];
    }
}
