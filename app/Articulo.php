<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //línea necesaria

class Articulo extends Model
{
    use SoftDeletes; //Implementamos 
    protected $dates = ['deleted_at']; //Registramos la nueva columna

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'price',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        "deleted_at", "created_at", "updated_at"
    ];

    /**
     * Get citas del cliente.
     */
    public function citas()
    {
        return $this->hasMany('App\Cita')->orderBy('fecha', 'desc');;
    }

    /**
     * Get all of the post's comments.
     */
    public function citaLineas()
    {
        return $this->morphMany('App\CitaLinea', 'cita_linea_origen');
    }
}
