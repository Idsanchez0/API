<?php

namespace App\Models\Ubicacion;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
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
    public function paises()
    {
        return $this->belongsTo(Pais::class);
    }
}
