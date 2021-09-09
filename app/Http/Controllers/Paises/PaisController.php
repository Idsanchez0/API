<?php

namespace App\Http\Controllers\Paises;

use App\Http\Controllers\Controller;
use App\Models\Pais\Paises;
use App\Models\Ubicacion\Pais;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class PaisController extends Controller
{
    //
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
        $datosResponse = Paises::get();
        return $this->successResponse($datosResponse, 'Paises creados');
    }

  

}
