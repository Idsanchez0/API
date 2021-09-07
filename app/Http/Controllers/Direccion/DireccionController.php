<?php

namespace App\Http\Controllers\Direccion;

use App\Http\Controllers\Controller;
use App\Models\Direccion\Direcciones;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class DireccionController extends Controller
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
        $usuario = Auth::user();
        $profesional_id = $usuario->profesional->id;
        $direcciones = Direcciones::select('id_direccion','calle_principal','calle_secundaria','sector','numero','activo','tipo_direccion','direcciones.id_ciudad','ciudades.nombre_ciudad','provincias.id_provincia','provincias.nombre_provincia','paises.id_pais','paises.nombre_pais')
                                    ->join('ciudades','direcciones.id_ciudad','ciudades.id_ciudad')
                                    ->join('provincias','ciudades.id_provincia','provincias.id_provincia')
                                    ->join('paises','provincias.id_pais','paises.id_pais')
                                    ->where('id_profesional',$profesional_id)
                                    ->get();
        return $this->successResponse($direcciones, 'Direcciones del profesional');
    }

    public function direccion($id_direccion)
    {
        $datosResponse = Direcciones::select('id_direccion','calle_principal','calle_secundaria','sector','numero','activo','tipo_direccion','direcciones.id_ciudad','ciudades.nombre_ciudad','provincias.id_provincia','provincias.nombre_provincia','paises.id_pais','paises.nombre_pais')
            ->join('ciudades','direcciones.id_ciudad','ciudades.id_ciudad')
            ->join('provincias','ciudades.id_provincia','provincias.id_provincia')
            ->join('paises','provincias.id_pais','paises.id_pais')
            ->where('id_direccion',$id_direccion)
            ->first();
        return $this->successResponse($datosResponse, 'Direcciones del profesional');
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                    'calle_principal' => 'required|max:500',
                    'calle_secundaria' => 'required|max:500',
                    'numero' => 'required',
                    'tipo_direccion' => 'required|max:255',
                    'id_ciudad' => 'required',
                ]
            );
            $usuario = Auth::user();
            $profesional_id = $usuario->profesional->id;
            $datosDireccion = $request->all();
            $datosDireccion['id_profesional'] = $profesional_id;
            Log::debug('Datos direccion: '.json_encode($datosDireccion));
            $cantidadPrincipal = Direcciones::where('tipo_direccion','Principal')
                                            ->where('id_profesional',$profesional_id)
                                            ->count();
            $actualizarPrincipal = -1;
            if ($cantidadPrincipal==0 || !($cantidadPrincipal))
            {
                $datosDireccion['tipo_direccion'] = 'Principal';
            }
            else
            {
                if ($datosDireccion['tipo_direccion']=='Principal')
                {
                    $actualizarPrincipal = 1;
                }
            }
            DB::beginTransaction();
            if ($actualizarPrincipal==1)
            {
                Direcciones::where('id_profesional',$profesional_id)
                            ->update(['tipo_direccion' => 'Secundaria']);
            }
            $direccion = Direcciones::create($datosDireccion);
            $datosResponse = [
                'id' => $direccion->id_direccion,
            ];
            DB::commit();
            return $this->successResponse($datosResponse, 'Direccion registrado');
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->errorResponse($exception->getCode());
        }
    }
    public function update(Request $request)
    {
        try
        {
            $this->validate($request, [
                    'calle_principal' => 'required|max:500',
                    'calle_secundaria' => 'required|max:500',
                    'numero' => 'required',
                    'tipo_direccion' => 'required|max:255',
                    'id_ciudad' => 'required',
                ]
            );
            $usuario = Auth::user();
            $profesional_id = $usuario->profesional->id;
            Log::debug('Datos direccion: '.json_encode($request->all()));
            DB::beginTransaction();
            Direcciones::where('id_profesional',$profesional_id)
                    ->update(['tipo_direccion' => 'Secundaria']);
            $direccion = Direcciones::findorfail($request->id_direccion);
            $direccion->calle_principal = $request->calle_principal;
            $direccion->numero = $request->numero;
            $direccion->calle_secundaria = $request->calle_secundaria;
            $direccion->sector = $request->sector;
            $direccion->id_ciudad = $request->id_ciudad;
            $direccion->activo = $request->activo;
            if ($request->tipo_direccion == "Secundaria")
            {
                $direccion->tipo_direccion = "Principal";
            }
            else
            {
                $direccion->tipo_direccion = $request->tipo_direccion;
            }
            $direccion->save();
            $datosResponse = [
                'id' => $direccion->id_direccion,
            ];
            DB::commit();
            return $this->successResponse($datosResponse, 'Direccion actualizada');
        }
        catch (Exception $exception)
        {
            DB::rollBack();
            return $this->errorResponse($exception->getCode(), $exception->getMessage());
        }
    }

}
