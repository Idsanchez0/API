<?php

namespace App\Http\Controllers\Profesional;

use App\Http\Controllers\Controller;
use App\Models\Profesional\Profesionales;
use App\Models\User;
use App\Traits\ApiResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProfesionalController extends Controller
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

    /**
     * @param Request $request
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                    'identificacion' => 'required|max:15',
                    'nombre' => 'required|max:500',
                    'apellido' => 'required|max:500',
                    'correo' => 'required|max:255|email',
                    'socio_desde' => 'required|date',
                    'fecha_nacimiento' => 'required|date',
                    'tipo_identificacion_id' => 'required',
                ]
            );

            DB::beginTransaction();

            // Creación de usuario correspondiente al profesional
            $user = new User();
            $user->name = $request->nombre . ' ' . $request->apellido;
            $user->email = $request->correo;
            $user->password = Hash::make('password');
            $user->save();

            // Creación de profesional
            $datosProfesional = $request->all();
            $datosProfesional['user_id'] = $user->id;
            Profesionales::create($datosProfesional);

            $token = $user->createToken('API Token')->accessToken;

            DB::commit();
            $datosResponse = [
                'id' => $user->id,
                'token' => $token,
            ];
            return $this->successResponse($datosResponse, 'Profesional registrado');
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->errorResponse($exception->getCode(),$exception->getMessage());
        }
    }

    public function update(Request $request)
    {
        Log::debug($request);
        $file = $request->file('attachment');
        $storage_name = Str::uuid()->toString() . '.' . $file->getClientOriginalExtension();
        $filename = $file->getClientOriginalName();
        //$file->move(env('FILES_PATH') . $request_data->id . '/', $storage_name);
        //$data['path'] = env('FILES_PATH') . $request_data->id . '/' . $storage_name;
        //$data['type'] = 'respaldo';
        $file->move(env('FILES_PATH') , $storage_name);
        Log::debug($filename);
    }

    public function index()
    {
        $usuario = Auth::user();
        $profesional_id = $usuario->profesional->id;
        $profesional = Profesionales::where('id',$profesional_id)->get();
        return $this->successResponse($profesional, 'Datos del profesional');
    }
}
