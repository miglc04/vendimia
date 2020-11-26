<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaDetalle extends Model
{
    // Relaciones
    public function venta()
    {
        return $this->belongsTo('\App\Venta');
    }
}
