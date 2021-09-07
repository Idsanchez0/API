<?php

namespace App\Models\Clasificacion;

use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    protected $table = 'clasificacion';
    protected $primaryKey = 'id_clasificacion';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_clasificacion',
    ];

}
