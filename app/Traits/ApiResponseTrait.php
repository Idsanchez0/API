<?php

namespace App\Traits;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

trait ApiResponseTrait
{

    protected function successResponse($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'Success',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function errorResponse($exceptionCode)
    {
        $code = 500;
        $datosError = [
            'status' => 'Error',
            'code' => $exceptionCode,
        ];
        switch ($exceptionCode) {
            case '0':
                $datosError['message'] = 'Datos incorrectos, no pasó validación';
                $code = 400;
                break;
            case '100':
                $datosError['message'] = 'Usuario no válido';
                break;
            case '23000':
                $datosError['message'] = 'Registro duplicado';
                $code = 422;
                break;
            default:
                $datosError['message'] = 'Error general!!';
                break;
        }
        return response()->json($datosError, $code);
    }
}
