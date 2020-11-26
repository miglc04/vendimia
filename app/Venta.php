<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    public function __construct()
    {
        $this->fecha = date('Y-m-d');
    }

    // Relaciones
    public function detalles()
    {
        return $this->hasMany('App\VentaDetalle');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function getFechaVentaAttribute()
    {
        return date('d/m/Y', strtotime($this->fecha));
    }
}
