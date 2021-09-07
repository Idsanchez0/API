<?php

namespace Database\Factories;

use App\Models\MediosPagos;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediosPagosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MediosPagos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_cliente' => $this->faker->numberBetween(1,100),
            'nombre_pago' => $this->faker->text(),
        ];
    }
}
