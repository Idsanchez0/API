<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Ubicacion\Pais;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{
    public function index($id = null)
    {
        if (!$id) {
            return Pais::select(['id', 'codigo', 'nombre'])
                ->activo()
                ->get();
        } else {
            return Pais::with('ciudades:id,nombre,pais_id')
                ->select(['id', 'codigo', 'nombre'])
                ->activo()
                ->where('id', $id)
                ->get();
        }
    }
}
