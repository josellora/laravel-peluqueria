<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Servicios;

class CitaLinea extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cita_id', 'cita_linea_origen_id', 'cita_linea_origen_type', 'concepto', 'cantidad', 'precio',  
    ];

    protected $hidden = [
        'cita_linea_origen_id', 'cita_linea_origen_type', 
    ];

    public static  $linea_origen_tipos = [
        'servicios'     => 'Servicio',
        'articulos'     => 'Articulo',
        'productos'     => 'Productos',
        'otros'         => 'Otros',
    ];


    /* ??????????????????????????????????????????''' */
    /**
     * La cita a la que pretenece la linea.
     */
    /*
    public function cita()
    {
        return $this->belongsTo('App\Cita');
    }
    */


    /**
     * Get all of the owning  models.
     */
    public function cita_linea_origen()
    {
        return $this->morphTo();
    }

    public static function getLineaOrigenTipos() {
        return self::$linea_origen_tipos;
    }

}
