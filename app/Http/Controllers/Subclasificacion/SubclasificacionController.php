<?php

namespace App\Http\Controllers\Subclasificacion;

use App\Http\Controllers\Controller;
use App\Models\Subclasificacion\Subclasificacion;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class SubclasificacionController extends Controller
{
    use ApiResponseTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function index($id_clasificacion)
    {
        /*$datosResponse tiene que recuperar los datos de la conexion a la base de datos*/
        $datosResponse = Subclasificacion::ObtenerSubclasificaciones($id_clasificacion);
        return $this->successResponse($datosResponse, 'Subclasificaciones creadas');
    }

}
