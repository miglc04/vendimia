<?php

namespace App\Http\Controllers;

use App\Venta;
use App\Articulo;
use App\VentaDetalle;
use App\Configuracion;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventas = Venta::with('cliente')->orderBy('id', 'desc')->get();

        return view('ventas_index', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ultimaVenta = Venta::orderBy('id', 'desc')->first();
        $configuracion = Configuracion::orderBy('id', 'desc')->first();
        $venta = new Venta;
        $venta->id = isset($ultimaVenta) ? $ultimaVenta->id + 1 : 1;

        return view('ventas_create', compact('venta', 'configuracion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->params;
        $cliente = $params['cliente'];
        $articulos = $params['articulosVenta'];
        $total = $params['total'];

        \DB::beginTransaction();
        try {
            $venta = new Venta;
            $venta->cliente_id = $cliente['id'];
            $venta->total = $total;
            $venta->save();
            foreach ($articulos as $articulo) {
                $detalle = new VentaDetalle;
                $detalle->articulo_id = $articulo['id'];
                $detalle->cantidad = $articulo['cantidad'];

                $venta->detalles()->save($detalle);
                Articulo::find($articulo['id'])->decrement('existencia', $articulo['cantidad']);
            }
        } catch (Exception $e) {
            \Log::error($e);
            \DB::rollback();
            return response()->json(['estatus' => false]);
        }
        \DB::commit();
        return response()->json(['estatus' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
