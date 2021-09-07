<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trabajos extends Model
{
    protected $table = 'trabajos';
    protected $primaryKey = 'id_trabajo';
    public $timestamps = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_trabajo',
        'descripcion_trabajo',
        'fecha_inicio_trabajo',
        'hora_inicio_trabajo',
        'fecha_fin_trabajo',
        'hora_fin_trabajo',
        'calle_principal',
        'numero',
        'calle_secundaria',
        'ciudad',
        'provincia',
        'pais',
        'valor_trabajo',
        'saldo_trabajo',
        'id_producto',
    ];

}
