<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Ciudad\Ciudades;
use App\Models\Ubicacion\Ciudad;
use App\Models\Ubicacion\Pais;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;

class UbicacionController extends Controller
{

    use ApiResponseTrait;

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

    public function listPais()
    {

        $data_pais=Pais::get();

        foreach($data_pais as $key=>$value){
            $datosResponse[] =[
                'id'=>$value->id,
                'codigo'=>$value->codigo,
                'nombre'=>$value->nombre,
                'estado'=>$value->estado,

            ];
        }

        
        return $this->successResponse($datosResponse, 'Paises');
    }

    public function listCiudades()
    {

        $data_ciudad=Ciudad::get();
        $datosResponse1=[];
        foreach($data_ciudad as $key=>$value){
            $datosResponse1[] =[
                'id'=>$value->id,
                'pais_id'=>$value->pais_id,
                'codigo'=>$value->codigo,
                'nombre'=>$value->nombre,
                'estado'=>$value->estado,

            ];
        }

        
        return $this->successResponse($datosResponse1, 'Ciudades');
    }
}
