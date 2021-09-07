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
            $notificationArray = [
                'via' => ['mail'],
                'mail' => [
                    'subject' => 'Confirmación Registro Vibra!!',
                    'template' => 'mail.notificacion.registro-template',
                    'variables' => [
                        'nombre' => $request->nombre . ' ' . $request->apellido,
                        'url' => url() . '/api/cliente/verify/' . $datosCliente['verificar_id'],
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

            $localURL = config('vibra.local_url');
            $clientId = config('vibra.client_id');
            $clientSecret = config('vibra.client_secret');
            $appUser = AppUser::where('correo', $request->correo)->first();
            if ($appUser) {
                if (Hash::check($request->clave, $appUser->clave)) {
                    $this->revokeTokensUsuario($appUser);
                    $httpClient = new Client();
                    $response = $httpClient->post($localURL . '/oauth/token', [
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
}
