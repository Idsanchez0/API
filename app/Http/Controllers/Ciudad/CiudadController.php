<?php

namespace App\Http\Controllers\Ciudad;

use App\Http\Controllers\Controller;
use App\Models\Ciudad\Ciudades;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CiudadController extends Controller
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
    public function index($id_provincia)
    {
        $datosResponse = Ciudades::ObtenerCiudades($id_provincia);
        return $this->successResponse($datosResponse, 'Ciudades creadas');
    }

}
