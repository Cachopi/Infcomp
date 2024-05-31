<?php

namespace App\Http\Controllers;

use App\Models\Cesta;
use App\Models\Factura;
use App\Models\Producto;
use App\Models\User;
use App\Models\Cursos;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCestaRequest;
use App\Http\Requests\UpdateCestaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class CestaController extends Controller
{

    public function anadirProducto(Request $request, $productoId, $tipo)
{
    $usuario = Auth::user();


    if (!$usuario->cesta) {

        $cesta = new Cesta();
        $cesta->user_id = $usuario->id;
        $cesta->save();


        $usuario->load('cesta');
    }


    $cesta = $usuario->cesta;


    if (!$cesta) {
        return redirect()->back()->with('error', 'No se pudo crear la cesta.');
    }


    if ($tipo === 'producto') {

        $producto = Producto::find($productoId);


        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }


        if ($producto->stock <= 0) {
            return redirect()->back()->with('error', 'El producto seleccionado no tiene stock disponible.');
        }


        $cantidadDeseada = 1;


        if ($cantidadDeseada > $producto->stock) {
            return redirect()->back()->with('error', 'La cantidad deseada excede el stock disponible.');
        }


        $productoEnCesta = $cesta->productos()->where('producto_id', $productoId)->first();
        if ($productoEnCesta) {

            $cesta->productos()->updateExistingPivot($productoId, [
                'cantidad' => \DB::raw('cantidad + ' . $cantidadDeseada)
            ]);
        } else {

            $cesta->productos()->attach($productoId, ['cantidad' => $cantidadDeseada]);
        }


        $producto->stock -= $cantidadDeseada;
        $producto->save();
    } elseif ($tipo === 'curso') {
        if ($usuario->cursos->contains($productoId)) {
            return redirect()->back()->withErrors(['error' => 'Ya has comprado este curso anteriormente.']);
        }

        if ($cesta->cursos()->where('curso_id', $productoId)->exists()) {
            return redirect()->back()->withErrors(['error' => 'Este curso ya está en tu cesta.']);
        } else {

            $cesta->cursos()->attach($productoId, ['cantidad' => 1]);
        }
    }

    $this->actualizarSesion($cesta);
    return redirect()->back();
}

    /**
     * Display a listing of the resource.
     */
    public function sumarCantidad($productoId)
    {
        $usuario = Auth::user();
        $cesta = $usuario->cesta;


        $producto = $cesta->productos()->where('producto_id', $productoId)->first();


        if ($producto) {
            if ($producto->stock > 0) {

                $producto->pivot->cantidad++;
                $producto->pivot->save();


                $producto->stock--;
                $producto->save();
            } else {

                return redirect()->back()->with('error', 'El producto seleccionado no tiene suficiente stock.');
            }
        }
        $this->actualizarSesion($cesta);
        return redirect()->back();
    }

    public function restarCantidad($productoId)
    {
        $usuario = Auth::user();
        $cesta = $usuario->cesta;


        $producto = $cesta->productos()->where('producto_id', $productoId)->first();


        if ($producto && $producto->pivot->cantidad > 1) {


                $producto->pivot->cantidad--;
                $producto->pivot->save();


                $producto->stock++;
                $producto->save();



        }
        $this->actualizarSesion($cesta);

        return redirect()->back();
    }


    public function mostrarCesta()
    {
        $usuario = Auth::user();
        $cesta = $usuario->cesta;
        $productos = $cesta->productos;
        $cursos = $cesta->cursos;
        $total = 0;

        $productosConCantidad = [];
        $cursosConCantidad = [];


        foreach ($productos as $producto) {
            $cantidad = $producto->pivot->cantidad;
            $subtotal = $producto->precio * $cantidad;

            $productosConCantidad[] = [
                'producto' => $producto,
                'cantidad' => $cantidad,
                'subtotal' => $subtotal,
            ];
            $total += $subtotal;
        }


        foreach ($cursos as $curso) {
            $cantidad = $curso->pivot->cantidad;
            $subtotal = $curso->precio * $cantidad;

            $cursosConCantidad[] = [
                'curso' => $curso,
                'cantidad' => $cantidad,
                'subtotal' => $subtotal,
            ];
            $total += $subtotal;
        }

//

        $this->actualizarSesion($cesta);

        return view('cesta.cesta', [
            'productosConCantidad' => $productosConCantidad,
            'cursosConCantidad' => $cursosConCantidad,
            'total' => $total
        ]);
    }



    public function eliminarProducto($productoId)
    {
        $usuario = Auth::user();
        $cesta = $usuario->cesta;


        $producto = $cesta->productos()->where('producto_id', $productoId)->first();
        if ($producto) {

            $cantidad = $producto->pivot->cantidad;


            $producto->stock += $cantidad;
            $producto->save();


            $cesta->productos()->detach($productoId);
        }

        $this->actualizarSesion($cesta);
        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }


    public function eliminarCurso($cursoId)
    {
        $usuario = Auth::user();
        $cesta = $usuario->cesta;



            $cesta->cursos()->wherePivot('curso_id', $cursoId)->detach();


            $this->actualizarSesion($cesta);

            return redirect()->back()->with('success', 'Curso eliminado del carrito');



    }

    public function vaciarCesta()
    {
        $usuario = Auth::user();
        $cesta = $usuario->cesta;

        $productosEnCesta = $cesta->productos()->get();
        foreach ($productosEnCesta as $producto) {
            $cantidad = $producto->pivot->cantidad;
            $producto->stock += $cantidad;
            $producto->save();
        }


        $cesta->productos()->detach();
        $cesta->cursos()->detach();


        $this->actualizarSesion($cesta);

        return redirect()->back()->with('success', 'Productos y cursos eliminados del carrito');
    }


    public function actualizarSesion($cesta)
    {

        $usuarioId = auth()->id();


        $productosEnCesta = $cesta->productos()->withPivot('cantidad')->get();
        $cursosEnCesta = $cesta->cursos()->withPivot('cantidad')->get();


        $productosParaSesion = [];
        $cursosParaSesion = [];
        $total = 0;

        foreach ($productosEnCesta as $producto) {
            $productosParaSesion[] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'ruta' => $producto->ruta,
                'cantidad' => $producto->pivot->cantidad,
                'subtotal' => $producto->precio * $producto->pivot->cantidad,
                'stock' => $producto->stock
            ];
            $total += $producto->precio * $producto->pivot->cantidad;
        }

        foreach ($cursosEnCesta as $curso) {
            $cursosParaSesion[] = [
                'id' => $curso->id,
                'nombre' => $curso->nombre,
                'precio' => $curso->precio,
                'ruta' => $curso->ruta,
                'cantidad' => $curso->pivot->cantidad,
                'subtotal' => $curso->precio * $curso->pivot->cantidad,
                'stock' => $curso->stock
            ];
            $total += $curso->precio * $curso->pivot->cantidad;
        }


        \Illuminate\Support\Facades\Session::put("productoSesion_{$usuarioId}", $productosParaSesion);
        \Illuminate\Support\Facades\Session::put("cursoSesion_{$usuarioId}", $cursosParaSesion);
        \Illuminate\Support\Facades\Session::put("total_{$usuarioId}", $total);
    }


    public function generarFactura()
    {
        $usuario = Auth::user();
        $cesta = $usuario->cesta;


        $productosEnCesta = $cesta->productos()->withPivot('cantidad')->get();
        $cursosEnCesta = $cesta->cursos()->withPivot('cantidad')->get();


        foreach ($productosEnCesta as $producto) {
            if ($producto->stock < $producto->pivot->cantidad) {
                return redirect()->back()->with('error', 'No hay suficiente stock disponible para el producto: ' . $producto->nombre);
            }
        }




        $total = 0;
        foreach ($productosEnCesta as $producto) {
            $total += $producto->precio * $producto->pivot->cantidad;
        }
        foreach ($cursosEnCesta as $curso) {
            $total += $curso->precio * $curso->pivot->cantidad;
        }


        $factura = new Factura();
        $factura->user_id = $usuario->id;
        $factura->total = $total;



        $factura->save();


        foreach ($productosEnCesta as $producto) {
            $cantidad = $producto->pivot->cantidad;
            $factura->productos()->attach($producto->id, ['cantidad' => $cantidad]);
        }


        foreach ($cursosEnCesta as $curso) {
            $cantidad = $curso->pivot->cantidad;
            $usuario->cursos()->attach($curso->id, ['progreso' => 0]);
            $factura->cursos()->attach($curso->id, ['cantidad' => $cantidad]);
        }


        $cesta->productos()->detach();
        $cesta->cursos()->detach();


        $this->actualizarSesion($cesta);


        return redirect()->back()->with('success', 'Factura generada y cesta vaciada');
    }





}
