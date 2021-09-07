<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identificacion',
        'nombre_cliente',
        'apellido_cliente',
        'telefono_casa',
        'telefono_celular',
        'correo',
        'fecha_nacimiento',
        'estado_civil',
        'genero',
        'activo',
        'id_tipo_identificacion',
    ];

}
