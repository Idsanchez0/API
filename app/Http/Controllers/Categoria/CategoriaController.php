<?php

namespace App\Http\Controllers\Categoria;

use App\Http\Controllers\Controller;
use App\Models\Categoria\Categoria;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    use ApiResponseTrait;
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index($id_subclasificacion)
    {
        /*$datosResponse tiene que recuperar los datos de la conexion a la base de datos*/
        $datosResponse = Categoria::ObtenerCategorias($id_subclasificacion);
        return $this->successResponse($datosResponse, 'Categorias creadas');
    }

}
