<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //línea necesaria

class Cliente extends Model
{
    use SoftDeletes; //Implementamos 
    protected $dates = ['deleted_at']; //Registramos la nueva columna

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'telefono',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


    /**
    * Get the user's full name.
    *
    * @return string
    */
    public function getFullNameAttribute()
    {
        return "{$this->name} {$this->surname}";
    }

    /**
     * Get citas del cliente.
     */
    public function citas()
    {
        return $this->hasMany('App\Cita')->orderBy('fecha', 'desc');;
    }
}
