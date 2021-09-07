<?php

namespace App\Http\Controllers\Servicio;

use App\Http\Controllers\Controller;
use App\Models\Servicio\Servicio;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ServicioController extends Controller
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
        $usuario = Auth::user();
        $profesional_id = $usuario->profesional->id;
        $datosResponse = Servicio::select('id_producto','nombre_producto','descripcion_producto','a_domicilio','productos.id_tipo_producto','productos.id_categoria','tipo_producto','nombre_categoria','activo','clasificacion.id_clasificacion','clasificacion.nombre_clasificacion','subclasificacion.id_subclasificacion','subclasificacion.nombre_subclasificacion')
                                    ->join('categoria','productos.id_categoria','categoria.id_categoria')
                                    ->join('subclasificacion','categoria.id_subclasificacion','subclasificacion.id_subclasificacion')
                                    ->join('clasificacion','subclasificacion.id_clasificacion','clasificacion.id_clasificacion')
                                    ->join('tipos_productos','productos.id_tipo_producto','tipos_productos.id_tipo_producto')
                                    ->where('id_profesional',$profesional_id)
                                    ->get();
        return $this->successResponse($datosResponse, 'Servicios del profesional');
    }


    public function servicio($id_servicio)
    {
        /*$datosResponse tiene que recuperar los datos de la conexion a la base de datos*/
        $datosResponse = Servicio::select('id_producto','nombre_producto','descripcion_producto','a_domicilio','productos.id_tipo_producto','productos.id_categoria','tipo_producto','nombre_categoria','activo','clasificacion.id_clasificacion','clasificacion.nombre_clasificacion','subclasificacion.id_subclasificacion','subclasificacion.nombre_subclasificacion','productos.activo')
            ->join('categoria','productos.id_categoria','categoria.id_categoria')
            ->join('subclasificacion','categoria.id_subclasificacion','subclasificacion.id_subclasificacion')
            ->join('clasificacion','subclasificacion.id_clasificacion','clasificacion.id_clasificacion')
            ->join('tipos_productos','productos.id_tipo_producto','tipos_productos.id_tipo_producto')
            ->where('id_producto',$id_servicio)
            ->first();
        return $this->successResponse($datosResponse, 'Servicio retornado');
    }


    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        try {
            Log::debug($request);
            $this->validate($request, [
                    'nombre_producto' => 'required|max:500',
                    'descripcion_producto' => 'required|max:500',
                    'a_domicilio' => 'required',
                    'id_tipo_producto' => 'required',
                    'id_categoria' => 'required',
                ]
            );
            $usuario = Auth::user();
            $profesional_id = $usuario->profesional->id;

            DB::beginTransaction();

            // Creación de profesional
            $datosServicio = $request->all();
            $datosServicio['id_profesional'] = $profesional_id;
            Log::debug('Datos servicio: '.$datosServicio);
            $servicio = Servicio::create($datosServicio);
            $datosResponse = [
                'id' => $servicio->id_producto,
            ];
            DB::commit();
            return $this->successResponse($datosResponse, 'Servicio registrado');
            //return response()->json($datosResponse, 200);
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->errorResponse($exception->getCode(), $exception->getMessage());
        }
    }

    public function update(Request $request)
    {
        try {
            Log::debug($request);
            $this->validate($request, [
                    'nombre_producto' => 'required|max:500',
                    'descripcion_producto' => 'required|max:500',
                    'a_domicilio' => 'required',
                    'id_tipo_producto' => 'required',
                    'id_categoria' => 'required',
                ]
            );

            DB::beginTransaction();

            // Creación de profesional
            Log::debug('Actualizar datos: '.$request->all);
            $servicio = Servicio::findorfail($request->id_producto);
            $servicio->nombre_producto = $request->nombre_producto;
            $servicio->descripcion_producto = $request->descripcion_producto;
            $servicio->a_domicilio = $request->a_domicilio;
            $servicio->id_categoria = $request->id_categoria;
            $servicio->id_tipo_producto = $request->id_tipo_producto;
            $servicio->activo = $request->activo;
            $servicio->save();
            $datosResponse = [
                'id' => $servicio->id_producto,
            ];
            DB::commit();
            return $this->successResponse($datosResponse, 'Servicio actualizado');
            //return response()->json($datosResponse, 200);
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->errorResponse($exception->getCode(), $exception->getMessage());
        }
    }


}
