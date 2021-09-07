<?php

namespace App\Models\TipoServicio;

use Illuminate\Database\Eloquent\Model;

class TiposProductos extends Model
{
    protected $table = 'tipos_productos';
    protected $primaryKey = 'id_tipo_producto';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_producto',
        'descripcion_tipo_producto',
    ];

}
