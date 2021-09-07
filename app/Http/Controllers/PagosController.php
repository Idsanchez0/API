<?php

namespace App\Http\Controllers;

use App\Models\Pagos;
use Illuminate\Http\Request;

class PagosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //

    public function store(Request $request)
    {
        $this->validate($request, [
                'valor' => 'required',
                'fecha_pago' => 'required',
                'fecha_proceso' => 'required',
                'fecha_aprobacion' => 'required',
                'aprovacion_id' => 'required|max:255',
                'referencia_id' => 'required|max:255',
                'id_trabajo' => 'required',
                'id_medio_pago' => 'required',
            ]
        );
        Pagos::create($request->all());
    }
}
