<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CotizadorController extends Controller
{
    public function index()
    {
        return view('cotizador');
    }

    public function calcular(Request $request)
    {
        $request->validate([
            'producto'        => 'required|string|max:255',
            'cantidad'        => 'required|numeric|min:1',
            'precio_unitario' => 'required|numeric|min:0',
        ]);

        $producto        = $request->input('producto');
        $cantidad        = (float) $request->input('cantidad');
        $precio_unitario = (float) $request->input('precio_unitario');
        $iva_pct         = (float) $request->input('iva', 19); // IVA Colombia 19% por defecto

        $subtotal = $cantidad * $precio_unitario;
        $iva      = $subtotal * ($iva_pct / 100);
        $total    = $subtotal + $iva;

        return view('cotizador', compact('producto', 'cantidad', 'precio_unitario', 'iva_pct', 'subtotal', 'iva', 'total'));
    }
}