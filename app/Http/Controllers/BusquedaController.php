<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Articulo;
use Illuminate\Http\Request;

class BusquedaController extends Controller
{
    /**
     * Realiza búsqueda de clientes por su nombre.
     */
    public function clientes(Request $request)
    {
        return Cliente::query()
            ->where('nombre', 'like', "%{$request->cliente}%")
            ->orWhere('apellido_paterno', 'like', "%{$request->cliente}%")
            ->orWhere('apellido_materno', 'like', "%{$request->cliente}%")
            ->get();
    }

    /**
     * Realiza búsqueda de artículos por su descripción.
     */
    public function articulos(Request $request)
    {
         return Articulo::query()
            ->where('descripcion', 'like', "%{$request->articulo}%")
            ->get();
    }
}
