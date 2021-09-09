<?php

namespace App\Http\Controllers\App\Cliente;

use App\Http\Controllers\Controller;
use App\Models\App\AppUser;
use App\Notifications\Notificacion;
use App\Traits\ApiResponseTrait;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class ClienteController extends Controller
{
    use ApiResponseTrait;

    /**
     * Guarda los datos de un nuevo cliente (APP)
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                    'nombre' => 'required',
                    'apellido' => 'required',
                    'pais_id' => 'required',
                    'ciudad_id' => 'required',
                    'correo' => 'required|max:255|email',
                    'clave' => 'required',
                ]
            );

            $datosCliente = $request->all();
            $datosCliente['clave'] = Hash::make($request->clave);
            $datosCliente['verificar_id'] = uniqid();
            $appUser = AppUser::create($datosCliente);

            $datosResponse = [
                'id' => $appUser->id,
            ];
            $externalURL = config('vibra.external_url');
            $verifyPath = config('vibra.verify_path');
            $notificationArray = [
                'via' => ['mail'],
                'mail' => [
                    'subject' => 'Confirmación Registro Vibra!!',
                    'template' => 'mail.notificacion.registro-template',
                    'variables' => [
                        'nombre' => $request->nombre . ' ' . $request->apellido,
                        'url_verify' => $externalURL . $verifyPath . $datosCliente['verificar_id'],
                        'url' => $externalURL,
                    ],
                ],
            ];
            $appUser->notify(new Notificacion($notificationArray));
            return $this->successResponse($datosResponse, 'Cliente registrado');
        } catch (Exception $exception) {
            Log::debug($exception->getMessage());
            return $this->errorResponse($exception->getCode());
        }
    }


    public function update(Request $request,$id)
    {
        try {
            $this->validate($request, [
                'nombre' => 'required',
                'apellido' => 'required',
                'pais_id' => 'required',
                'ciudad_id' => 'required',
                'correo' => 'required|max:255|email',
                'clave' => 'required',
                ]
            );

            DB::beginTransaction();


            Log::debug('Actualizar datos: '.$request->all);
            $datosCliente = AppUser::findorfail($id);
            $datosCliente->nombre = $request->nombre;
            $datosCliente->apellido = $request->apellido;
            $datosCliente->pais_id = $request->pais_id;
            $datosCliente->ciudad_id = $request->ciudad_id;
            $datosCliente->telefono = $request->telefono;
            $datosCliente->correo = $request->correo;
            $datosCliente->clave = Hash::make($request->clave);
            $datosCliente->save();
            $datosResponse = [
                'id' => $datosCliente->id,
            ];
            DB::commit();
            return $this->successResponse($datosResponse, 'Servicio actualizado');
            //return response()->json($datosResponse, 200);
        } catch (Exception $exception) {
            DB::rollBack();
            return $this->errorResponse($exception->getCode(), $exception->getMessage());
        }
    }
    /**
     * Login para usuario de la App
     *
     * @param Request $request
     * @return JsonResponse
     * @throws GuzzleException
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $this->validate($request, [
                'correo' => 'required|email',
                'clave' => 'required',
            ]);

            $localURL = config('app.local_url');
            $clientId = config('app.client_id');
            $clientSecret = config('app.client_secret');
            $appUser = AppUser::where('correo', $request->correo)->first();
            if (is_object($appUser)) {
                if (Hash::check($request->clave, $appUser->clave)) {
                    $this->revokeTokensUsuario($appUser);
                    $httpClient = new Client();
                    $response = $httpClient->post('http://127.0.0.1:8000/oauth/token', [
                        'form_params' => [
                            'grant_type' => 'password',
                            'client_id' => $clientId,
                            'client_secret' => $clientSecret,
                            'username' => $request->correo,
                            'password' => $request->clave,
                        ],
                    ]);
                    $datosResponse['token'] = json_decode($response->getBody());
                    return $this->successResponse($datosResponse, 'Cliente válido');
                } else {
                    return response()->json(['error' => ['Credenciales incorrectas!']], 200);
                }
            } else {
                return response()->json(['error' => ['Credenciales incorrectas!']], 200);
            }

            //return response()->json(['error' => ['Credenciales incorrectas!']], 200);
        } catch (Exception $exception) {
            Log::debug($exception->getMessage());
            return $this->errorResponse($exception->getCode());
        }
    }

    private function revokeTokensUsuario($user)
    {
        $tokens = $user->tokens;
        foreach ($tokens as $token) {
            $token->revoke();
        }
    }

     //Cambio contraseña
     public function change(Request $request, $id): JsonResponse
     {
 
         $this->validate($request, [
             'oldPass' => 'required',
             'password' => 'required',
             'confirmacionPass' => 'required|same:password',
             ]
         );
 
         try {
             $user = AppUser::find($id);
             if (Hash::check($request->oldPass, $user->clave)) {
                 $user->clave = Hash::make($request->password);
                 //$user->confirmation = 1;
                 $user->save();
 
                 $datosResponse = [
                     'id' => $user->id,
                 ];
 
                 return $this->successResponse($datosResponse, 'Contraseña Actualizada');
 
             } else {
 
                 return $this->successResponse(1, 'La contrasenia anterior no es correcta');
             }
         } catch (Exception $exception) {
             Log::debug($exception->getMessage());
             return $this->errorResponse($exception->getCode());
         }
     }


     public function forgotPassword(Request $request): JsonResponse
     {
         try {
             $this->validate($request, [
                    
                     'correo' => 'required|max:255|email'
                    
                 ]
             );
 
            /* $datosCliente = $request->all();
             $datosCliente['clave'] = Hash::make($request->clave);
             $datosCliente['verificar_id'] = uniqid();*/

             

             $appUser = AppUser::where('correo', $request->correo)->first();

             if(is_object($appUser)){
                $datosResponse = [
                    'id' => $appUser->id,
                ];
                $externalURL = config('vibra.external_url');
                $verifyPath = config('vibra.verify_path');
                $notificationArray = [
                    'via' => ['mail'],
                    'mail' => [
                        'subject' => 'Recuperar clave Vibra!!',
                        'template' => 'mail.notificacion.recuperarClave-template',
                        'variables' => [
                            'nombre' => $appUser->nombre . ' ' . $appUser->apellido,
                            'url_verify' => $externalURL . $verifyPath . $appUser['verificar_id'],
                            'url' => $externalURL,
                        ],
                    ],
                ];
                $appUser->notify(new Notificacion($notificationArray));
                return $this->successResponse($datosResponse, 'Reset password');

             }else{
                return $this->successResponse('Error', 'Cliente no encontrado'); 
             }
 
            
         } catch (Exception $exception) {
             Log::debug($exception->getMessage());
             return $this->errorResponse($exception->getCode());
         }
     }

     



}
