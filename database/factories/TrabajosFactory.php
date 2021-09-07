<?php

namespace Database\Factories;

use App\Models\Trabajos;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrabajosFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Trabajos::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre_trabajo' => $this->faker->text(),
            'descripcion_trabajo' => $this->faker->text(),
            'fecha_inicio_trabajo' =>$this->faker->date() ,
            'hora_inicio_trabajo'=>$this->faker->time(),
            'fecha_fin_trabajo'=>$this->faker->date() ,
            'hora_fin_trabajo'=>$this->faker->time(),
            'calle_principal'=> $this->faker->text(),
            'numero'=> $this->faker->text(10),
            'calle_secundaria'=> $this->faker->text(),
            'ciudad'=> $this->faker->text(),
            'provincia'=> $this->faker->text(),
            'pais'=> $this->faker->text(),
            'valor_trabajo' => $this->faker->randomFloat(2) ,
            'saldo_trabajo'=> $this->faker->randomFloat(2),
            'id_producto'=> $this->faker->numberBetween(1,100),
            'id_cliente' => $this->faker->numberBetween(1,100)
        ];
    }
}
