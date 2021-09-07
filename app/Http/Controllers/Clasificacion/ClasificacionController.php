<?php

namespace App\Http\Controllers\Clasificacion;

use App\Http\Controllers\Controller;

use App\Models\Clasificacion\Clasificacion;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;


class ClasificacionController extends Controller
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

    public function index()
    {
        /*$datosResponse tiene que recuperar los datos de la conexion a la base de datos*/
        $datosResponse = Clasificacion::get();
        return $this->successResponse($datosResponse, 'Clasificaciones creadas');
    }

}
