<?php

namespace App\Http\Controllers;

use App\Models\Cesta;
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

        // Verificar si el tipo es un producto
        if ($tipo === 'producto') {
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
        } elseif ($tipo === 'curso') {
            // Verificar si el curso ya está en el carrito
            if ($cesta->cursos()->where('curso_id', $productoId)->exists()) {
                // Incrementar la cantidad del curso en el carrito
                $cesta->cursos()->updateExistingPivot($productoId, [
                    'cantidad' => \DB::raw('cantidad + 1')
                ]);
            } else {
                // Añadir el curso al carrito con una cantidad de 1
                $cesta->cursos()->attach($productoId, ['cantidad' => 1]);
            }
        }

        // Obtener los productos actuales del carrito
        $productosEnCesta = $cesta->productos()->get();
        $cursosEnCesta = $cesta->cursos()->get();

        // Preparar los datos para guardar en la sesión
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
                'subtotal' => $producto->precio * $producto->pivot->cantidad
            ];
            $total += $producto->precio * $producto->pivot->cantidad;
        }


        foreach ($cursosEnCesta as $curso) {
            $cursosParaSesion[] = [
                'id' => $curso->id,
                'nombre' => $curso->nombre,
                'precio' => $curso->precio,
                'ruta' => $curso->ruta,
                'cantidad' => $curso->pivot->cantidad, // Asume que también tienes una columna cantidad en la tabla pivot de cestas y cursos
                'subtotal' => $curso->precio * $curso->pivot->cantidad
            ];
            $total += $curso->precio * $curso->pivot->cantidad;
        }


        \Illuminate\Support\Facades\Session::put('productoSesion', $productosParaSesion);
        \Illuminate\Support\Facades\Session::put('cursoSesion', $cursosParaSesion); // Guarda los cursos en la sesión
        Session::put('total', $total);
        return redirect()->back()->with('success', 'Productos y cursos eliminados del carrito');


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
        $this->actualizarSesion($cesta);
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
         $this->actualizarSesion($cesta);

        return redirect()->back();
    }


    public function mostrarCesta()
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario
        $productos = $cesta->productos; // Obtener los productos de la cesta
        $cursos = $cesta->cursos; // Obtener los cursos de la cesta
        $total = 0;

        $productosConCantidad = [];
        $cursosConCantidad = [];

        // Procesar productos
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

        // Procesar cursos
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

        // Almacenar los productos y cursos en la sesión
        Session::put('productosConCantidad', $productosConCantidad);
        Session::put('cursosConCantidad', $cursosConCantidad);
        Session::put('total', $total);

        return view('cesta.cesta', [
            'productosConCantidad' => $productosConCantidad,
            'cursosConCantidad' => $cursosConCantidad,
            'total' => $total
        ]);
    }

// Restar cantidad de un curso en la cesta
    public function restarCurso($cursoId)
    {
        $usuario = Auth::user();
        $cesta = $usuario->cesta;

        // Buscar el curso en la cesta
        $curso = $cesta->cursos()->where('curso_id', $cursoId)->first();

        if ($curso && $curso->pivot->cantidad > 1) {
            $cesta->cursos()->updateExistingPivot($cursoId, [
                'cantidad' => \DB::raw('cantidad - 1')
            ]);
        }
        $this->actualizarSesion($cesta);

        return redirect()->back();
    }

// Sumar cantidad de un curso en la cesta
    public function sumarCurso($cursoId)
    {
        $usuario = Auth::user();
        $cesta = $usuario->cesta;

        // Buscar el curso en la cesta
        $curso = $cesta->cursos()->where('curso_id', $cursoId)->first();

        if ($curso) {
            $cesta->cursos()->updateExistingPivot($cursoId, [
                'cantidad' => \DB::raw('cantidad + 1')
            ]);
        } else {
            $cesta->cursos()->attach($cursoId, ['cantidad' => 1]);
        }
        $this->actualizarSesion($cesta);

        return redirect()->back();
    }

    public function eliminarProducto($productoId)
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario


        // Verificar si el producto o curso está en la cesta antes de eliminar
        if ($cesta->productos->contains('id', $productoId)) {
            $cesta->productos()->wherePivot('producto_id', $productoId)->detach();
        }



$this->actualizarSesion($cesta);
        return redirect()->back()->with('success', 'Producto o curso eliminado del carrito');

    }

    public function eliminarCurso($cursoId)
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario

        // Verificar si el curso existe en la cesta

            $cesta->cursos()->wherePivot('curso_id', $cursoId)->detach();

            // Actualizar los datos en la sesión
            $this->actualizarSesion($cesta);

            return redirect()->back()->with('success', 'Curso eliminado del carrito');



    }

    public function vaciarCesta()
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario

        // Eliminar los productos y cursos de la cesta en la base de datos
        $cesta->productos()->detach();
        $cesta->cursos()->detach();


        $this->actualizarSesion($cesta);

        return redirect()->back()->with('success', 'Productos y cursos eliminados del carrito');
    }


    public function actualizarSesion($cesta)
    {

        // Obtener los productos y cursos actuales del carrito
        $productosEnCesta = $cesta->productos()->get();
        $cursosEnCesta = $cesta->cursos()->get();

        // Preparar los datos para guardar en la sesión
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
                'subtotal' => $producto->precio * $producto->pivot->cantidad
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
                'subtotal' => $curso->precio * $curso->pivot->cantidad
            ];
            $total += $curso->precio * $curso->pivot->cantidad;
        }

        \Illuminate\Support\Facades\Session::put('productoSesion', $productosParaSesion);
        \Illuminate\Support\Facades\Session::put('cursoSesion', $cursosParaSesion); // Guarda los cursos en la sesión
        Session::put('total', $total);
    }
}
