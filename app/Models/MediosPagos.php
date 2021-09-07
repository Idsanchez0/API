<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediosPagos extends Model
{
    protected $table = 'medios_pagos';
    protected $primaryKey = 'id_medio_pago';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_pago',
        'banco',
        'marca',
        'token',
        'fecha_caducidad',
        'activo',
        'id_cliente',
    ];

}
