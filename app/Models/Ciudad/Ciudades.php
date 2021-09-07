<?php

namespace App\Models\Ciudad;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
    //
    protected $table = 'ciudades';
    protected $primaryKey = 'id_ciudad';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_ciudad',
    ];

    public function scopeObtenerCiudades(Builder $builder,$id_provincia)
    {
        return $builder->where('id_provincia',$id_provincia)->get();
    }
}
