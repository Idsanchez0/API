<?php

namespace App\Models\Pais;

use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    protected $table = 'paises';
    protected $primaryKey = 'id_pais';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre_pais',
    ];

}
