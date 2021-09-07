<?php

namespace App\Models\Subclasificacion;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;


class Subclasificacion extends Model
{
    protected $table = 'subclasificacion';
    protected $primaryKey = 'id_subclasificacion';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_subclasificacion',
    ];
    public function scopeObtenerSubclasificaciones(Builder $builder, $id_clasificacion)
    {
        return $builder->where('id_clasificacion',$id_clasificacion)->get();
    }
}
