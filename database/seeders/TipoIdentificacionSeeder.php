<?php

namespace Database\Seeders;

use App\Models\TipoIdentificacions;
use Illuminate\Database\Seeder;

class TipoIdentificacionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        TipoIdentificacions::create(['tipo_identificacion' => 'CEDULA']);
        TipoIdentificacions::create(['tipo_identificacion' => 'PASAPORTE']);
        TipoIdentificacions::create(['tipo_identificacion' => 'RUC']);
        TipoIdentificacions::create(['tipo_identificacion' => 'NIT']);
        TipoIdentificacions::create(['tipo_identificacion' => 'DNI']);
        TipoIdentificacions::create(['tipo_identificacion' => 'RUT']);
    }
}
