<?php

namespace App\Models\Direccion;

use Illuminate\Database\Eloquent\Model;

class Direcciones extends Model
{
    protected $table = 'direcciones';
    protected $primaryKey = 'id_direccion';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'calle_principal',
        'calle_secundaria',
        'sector',
        'numero',
        'activo',
        'tipo_direccion',
        'id_profesional',
        'id_ciudad',
    ];

//
}
