<?php

namespace App\Models\Provincia;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Provincias extends Model
{
    protected $table = 'provincias';
    protected $primaryKey = 'id_provincia';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_provincia',
    ];

    public function scopeObtenerProvincias(Builder $builder, $id_pais)
    {
        return $builder->where('id_pais',$id_pais)->get();
    }
}
