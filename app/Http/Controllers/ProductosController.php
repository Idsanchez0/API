<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function store(Request $request)
    {
        $this->validate($request, [
                'nombre_producto' => 'required|max:500',
                'descripcion_producto' => 'required|max:1000',
                'a_domicilio' => 'required',
                'precio' => 'required',
                'id_tipo_producto' => 'required',
                'id_categoria' => 'required',
            ]
        );
        Productos::create($request->all());
    }
}
