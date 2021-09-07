<?php

namespace App\Models\Ubicacion;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pais extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codigo',
        'nombre',
        'estado',
    ];

    /**
     * Scope de países activos
     *
     * @param $query
     * @return mixed
     */
    public function scopeActivo($query)
    {
        return $query->where('estado', 'ACTIVO');
    }

    /**
     * Ciudades de un país.
     *
     * @return HasMany
     */
    public function ciudades()
    {
        return $this->hasMany(Ciudad::class);
    }
}
