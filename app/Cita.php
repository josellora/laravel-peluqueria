<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; //línea necesaria
use Carbon\Carbon;

class Cita extends Model
{    
	use SoftDeletes; //Implementamos 
    protected $dates = ['deleted_at']; //Registramos la nueva columna


     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fecha', 'hora', 'cliente_id', 
    ];

    //protected $appends = ['hora'];
 
    /**
     * El cliente al que pertenece la cita.
     */
    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    /**
     * Get lineas de la cita
     */
    public function cita_lineas()
    {
        return $this->hasMany('App\CitaLinea');
    }



    public function getHoraAttribute ($hora) {
        return Carbon::parse($hora)->format('H:i'); 
    }

    public function getFechaAttribute($fecha) {
        return Carbon::parse($fecha)->format('d/m/Y'); 
    }

}
