<?php

namespace App\Http\Controllers\Provincia;

use App\Http\Controllers\Controller;
use App\Models\Provincia\Provincias;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class ProvinciaController extends Controller
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

    public function index($id_pais)
    {
        $datosResponse = Provincias::ObtenerProvincias($id_pais);
        return $this->successResponse($datosResponse, 'Provincias creadas');
    }

}
