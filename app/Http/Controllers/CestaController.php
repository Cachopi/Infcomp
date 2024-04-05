<?php

namespace App\Http\Controllers;

use App\Models\Cesta;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCestaRequest;
use App\Http\Requests\UpdateCestaRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CestaController extends Controller
{

    public function anadirProducto(Request $request, $productoId)
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado

        // Verificar si el usuario tiene un carrito
        if (!$usuario->cesta) {
            $cesta = new Cesta(); // Crear un nuevo carrito
            $usuario->cesta()->save($cesta); // Asociar el nuevo carrito al usuario
        }

        $cesta = $usuario->cesta; // Obtener el carrito del usuario

        // Verificar si el carrito es null
        if (!$cesta) {
            return redirect()->back()->with('error', 'No se pudo acceder al carrito');
        }

        // Verificar si el producto ya está en el carrito
        if ($cesta->productos()->where('producto_id', $productoId)->exists()) {
            // Incrementar la cantidad del producto en el carrito
            $cesta->productos()->updateExistingPivot($productoId, [
                'cantidad' => \DB::raw('cantidad + 1')
            ]);
        } else {
            // Añadir el producto al carrito con una cantidad de 1
            $cesta->productos()->attach($productoId, ['cantidad' => 1]);
        }

        // Obtener los productos actuales del carrito
        $productosEnCesta = $cesta->productos()->get();

        // Preparar los datos para guardar en la sesión
        $productosParaSesion = [];
        $total=0;
        foreach ($productosEnCesta as $producto) {
            $productosParaSesion[] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'ruta'=>$producto->ruta,
                'cantidad' => $producto->pivot->cantidad,
                'subtotal' => $producto->precio * $producto->pivot->cantidad
            ];
            $total+=$producto->precio * $producto->pivot->cantidad;
        }
        \Illuminate\Support\Facades\Session::put('productoSesion', $productosParaSesion);
        Session::put('total',$total);
        return redirect()->back()->with('success', 'Producto añadido al carrito');
    }

    /**
     * Display a listing of the resource.
     */
    public function sumarCantidad($productoId)
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario

        // Obtener el producto de la cesta por su ID
        $producto = $cesta->productos()->where('producto_id', $productoId)->first();

        // Verificar si el producto existe en la cesta
        if ($producto) {
            // Incrementar la cantidad del producto
            $producto->pivot->cantidad++;
            $producto->pivot->save();
        }

        return redirect()->back();
    }

    public function restarCantidad($productoId)
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario

        // Obtener el producto de la cesta por su ID
        $producto = $cesta->productos()->where('producto_id', $productoId)->first();

        // Verificar si el producto existe en la cesta y la cantidad es mayor que 1
        if ($producto && $producto->pivot->cantidad > 1) {
            // Decrementar la cantidad del producto
            $producto->pivot->cantidad--;
            $producto->pivot->save();
        }

        return redirect()->back();
    }
    public function mostrarCesta()
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario
        $productos = $cesta->productos; // Obtener los productos de la
        $total = 0;


        foreach ($productos as $producto) {
            // Obtener la cantidad de cada producto en la cesta
            $cantidad = $producto->pivot->cantidad; // Asume que la relación utiliza una tabla pivot y el campo es 'cantidad'
            $subtotal= $producto->precio * $cantidad;
            // Añadir el producto y su cantidad al array
            $productosConCantidad[] = [
                'producto' => $producto,
                'cantidad' => $cantidad,
                'subtotal' => $subtotal,
            ];
            $total+=$subtotal;

        }
if(isset($productosConCantidad)) {
//    Session::put('productoSesion', $productosConCantidad);
    Session::put('total', $total);
    return view('cesta.cesta', ['productosConCantidad' => $productosConCantidad, 'total' => $total]);
}else{

    $productosConCantidad=[];
    $total=0;
//    Session::put('productoSesion', $productosConCantidad);
    Session::put('total', $total);
    return view('cesta.cesta',['productosConCantidad' => $productosConCantidad,'total'=>$total]);
}
    }


    public function eliminarProducto($productoId)
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario

        // Eliminar el producto de la cesta en la base de datos
        $cesta->productos()->detach($productoId);

        // Obtener los productos actuales del carrito
        $productosEnCesta = $cesta->productos()->get();

        // Preparar los datos para guardar en la sesión
        $productosParaSesion = [];
    $total=0;
        foreach ($productosEnCesta as $producto) {
            $productosParaSesion[] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'ruta'=>$producto->ruta,
                'cantidad' => $producto->pivot->cantidad,
                'subtotal' => $producto->precio * $producto->pivot->cantidad
            ];
            $total+=$producto->precio * $producto->pivot->cantidad;
        }
        \Illuminate\Support\Facades\Session::put('productoSesion', $productosParaSesion);
        Session::put('total',$total??0);

        // Guardar los productos en la sesión
        \Illuminate\Support\Facades\Session::put('productoSesion', $productosParaSesion);

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

    public function vaciarCesta()
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario

        // Eliminar el producto de la cesta en la base de datos
        $cesta->productos()->detach();

        // Obtener los productos actuales del carrito
        $productosEnCesta = $cesta->productos()->get();

        // Preparar los datos para guardar en la sesión
        $productosParaSesion = [];
    $total=0;
        foreach ($productosEnCesta as $producto) {
            $productosParaSesion[] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio' => $producto->precio,
                'ruta'=>$producto->ruta,
                'cantidad' => $producto->pivot->cantidad,
                'subtotal' => $producto->precio * $producto->pivot->cantidad
            ];
            $total+=$producto->precio * $producto->pivot->cantidad;
        }
        \Illuminate\Support\Facades\Session::put('productoSesion', $productosParaSesion);
        Session::put('total',$total);

        // Guardar los productos en la sesión
        \Illuminate\Support\Facades\Session::put('productoSesion', $productosParaSesion);

        return redirect()->back()->with('success', 'Producto eliminado del carrito');
    }

}
