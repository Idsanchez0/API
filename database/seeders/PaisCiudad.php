<?php

namespace Database\Seeders;

use App\Models\Ubicacion\Ciudad;
use App\Models\Ubicacion\Pais;
use Illuminate\Database\Seeder;

class PaisCiudad extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataPaises = [
            [
                'codigo' => 'EC',
                'nombre' => 'Ecuador',
                'estado' => 'ACTIVO',
                'ciudades' => [
                    ['codigo' => 'UIO', 'nombre' => 'Quito', 'estado' => 'ACTIVO'],
                    ['codigo' => 'GYE', 'nombre' => 'Guayaquil', 'estado' => 'ACTIVO']
                ]
            ],
            [
                'codigo' => 'PE',
                'nombre' => 'Perú',
                'estado' => 'ACTIVO',
                'ciudades' => [
                    ['codigo' => 'LIM', 'nombre' => 'Lima', 'estado' => 'ACTIVO'],
                    ['codigo' => 'AQP', 'nombre' => 'Arequipa', 'estado' => 'ACTIVO']
                ]
            ]
        ];
        foreach ($dataPaises as $item) {
            $pais = Pais::create(array_slice($item, 0, 3));
            $ciudades = $item['ciudades'];
            foreach ($ciudades as $ciudade) {
                $pais->ciudades()->save(new Ciudad($ciudade));
            }
        }

        /*$pais->ciudades()->saveMany([
            new Ciudad(['codigo' => 'UIO', 'nombre' => 'Quito', 'estado' => 'ACTIVO']),
            new Ciudad(['codigo' => 'GYE', 'nombre' => 'Guayaquil', 'estado' => 'ACTIVO']),
        ]);
        Pais::create($pais2);*/
    }
}
