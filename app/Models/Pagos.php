<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $table = 'pagos';
    protected $primaryKey = 'id_pago';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'valor',
        'fecha_pago',
        'fecha_proceso',
        'fecha_aprobacion',
        'aprovacion_id',
        'referencia_id',
        'id_trabajo',
        'id_medio_pago',
    ];

}
