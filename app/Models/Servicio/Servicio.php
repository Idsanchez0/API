<?php

namespace App\Models\Servicio;

use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_producto',
        'descripcion_producto',
        'a_domicilio',
        'id_tipo_producto',
        'id_categoria',
        'id_profesional',
        'activo',
    ];

}
