<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturaController extends Controller
{
    //

    public function index()
    {
        $facturas = Factura::with('usuario')->get();

        return view('facturas.facturas', ['facturas' => $facturas]);
    }


    public function show($id)
    {
        $factura = Factura::with('productos')->findOrFail($id);

        return view('facturas.show', ['factura' => $factura]);
    }


    public function destroy($id)
    {
        $factura = Factura::find($id);

        if (!$factura) {
            return redirect()->back()->with('error', 'La factura no se encontró');
        }


        $factura->delete();

        return redirect()->back()->with('success', 'Factura eliminada correctamente');
    }

    public function mostrar()
    {
        $user = Auth::user();
        $facturas = Factura::where('user_id', $user->id)->get();
        return view('profile.facturas', compact('facturas','user'));

    }
}
