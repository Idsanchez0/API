<?php

namespace App\Http\Controllers\Autenticacion;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponseTrait;
use Illuminate\Support\Facades\Auth;

class AutenticacionController extends Controller
{
    use ApiResponseTrait;

    public function autenticar()
    {
        if (Auth::guard('api')->check()) {
            $usuario = Auth::user();
            return $this->successResponse($usuario, 'Usuario validado');
        } else {
            return $this->errorResponse('100');
        }
    }
}
