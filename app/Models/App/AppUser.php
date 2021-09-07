<?php

namespace App\Models\App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;

class AppUser extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory, HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'apellido',
        'pais_id',
        'ciudad_id',
        'telefono',
        'correo',
        'clave',
        'estado',
        'verificar_id',
    ];

    public function findForPassport($username)
    {
        return $this->where('correo', $username)->first();
    }

    public function validateForPassportPasswordGrant($password)
    {
        return Hash::check($password, $this->clave);
    }

    /**
     * Route notifications for the mail channel.
     *
     * @return string
     */
    public function routeNotificationForMail()
    {
        return $this->correo;
    }
}
