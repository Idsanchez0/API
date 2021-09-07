<?php

namespace App\Models\Categoria;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'id_categoria';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_categoria',
    ];
    public function scopeObtenerCategorias(Builder $builder, $id_subclasificacion)
    {
        return $builder->where('id_subclasificacion',$id_subclasificacion)->get();
    }
}
