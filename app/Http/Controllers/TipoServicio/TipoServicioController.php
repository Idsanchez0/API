<?php

namespace App\Http\Controllers\TipoServicio;

use App\Http\Controllers\Controller;
use App\Models\TipoServicio\TiposProductos;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class TipoServicioController extends Controller
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
        $datosResponse = TiposProductos::get();
        return $this->successResponse($datosResponse, 'Tipos de servicio');
    }

}
