<?php

namespace App\Models\Profesional;

use Illuminate\Database\Eloquent\Model;

class Profesionales extends Model
{
    protected $table = 'profesionales';
    protected $primaryKey = 'id_profesional';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'identificacion',
        'nombre',
        'apellido',
        'correo',
        'telefono_casa',
        'telefono_celular',
        'foto',
        'socio_desde',
        'fecha_nacimiento',
        'estado_civil',
        'genero',
        'activo',
        'tipo_identificacion_id',
        'user_id',
    ];

}
