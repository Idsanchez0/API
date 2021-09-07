<?php

namespace Database\Seeders;

use Database\Factories\MediosPagosFactory;
use Database\Factories\TrabajosFactory;
use Database\Factories\ClasificacionFactory;
use Database\Factories\SublasificacionFactory;
use Database\Factories\CategoriaFactory;
use Database\Factories\TiposProductoFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        //MediosPagosFactory::times(3)->create();
        //TrabajosFactory::times(3)->create();
        //ClasificacionFactory::times(3)->create();
        //SublasificacionFactory::times(3)->create();
        //CategoriaFactory::times(3)->create();
        //TiposProductoFactory::times(3)->create();
        $this->call([
            TipoIdentificacionSeeder::class,
        ]);
    }
}
