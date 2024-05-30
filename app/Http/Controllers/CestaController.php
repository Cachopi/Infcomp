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

    // Verificar si el usuario tiene una cesta
    if (!$usuario->cesta) {
        // Crear una nueva cesta y asociarla al usuario
        $cesta = new Cesta();
        $cesta->user_id = $usuario->id;
        $cesta->save();

        // Recargar el usuario para incluir la cesta recién creada
        $usuario->load('cesta');
    }

    // Obtener la cesta del usuario
    $cesta = $usuario->cesta;

    // Verificar si la cesta se ha creado correctamente
    if (!$cesta) {
        return redirect()->back()->with('error', 'No se pudo crear la cesta.');
    }

    // Verificar si el tipo es un producto
    if ($tipo === 'producto') {
        // Buscar el producto por su ID
        $producto = Producto::find($productoId);

        // Verificar si el producto existe
        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado');
        }

        // Validar si hay suficiente stock disponible para agregar el producto a la cesta
        if ($producto->stock <= 0) {
            return redirect()->back()->with('error', 'El producto seleccionado no tiene stock disponible.');
        }

        // Obtener la cantidad que el usuario desea agregar a la cesta
        $cantidadDeseada = 1; // Puedes cambiar esto según tu lógica

        // Verificar si la cantidad deseada excede el stock disponible
        if ($cantidadDeseada > $producto->stock) {
            return redirect()->back()->with('error', 'La cantidad deseada excede el stock disponible.');
        }

        // Verificar si el producto ya está en la cesta
        $productoEnCesta = $cesta->productos()->where('producto_id', $productoId)->first();
        if ($productoEnCesta) {
            // Incrementar la cantidad del producto en la cesta
            $cesta->productos()->updateExistingPivot($productoId, [
                'cantidad' => \DB::raw('cantidad + ' . $cantidadDeseada)
            ]);
        } else {
            // Añadir el producto a la cesta con la cantidad deseada
            $cesta->productos()->attach($productoId, ['cantidad' => $cantidadDeseada]);
        }

        // Reducir el stock del producto
        $producto->stock -= $cantidadDeseada;
        $producto->save();
    } elseif ($tipo === 'curso') {
        if ($usuario->cursos->contains($productoId)) {
            return redirect()->back()->withErrors(['error' => 'Ya has comprado este curso anteriormente.']);
        }
        // Verificar si el curso ya está en el carrito
        if ($cesta->cursos()->where('curso_id', $productoId)->exists()) {
            return redirect()->back()->withErrors(['error' => 'Este curso ya está en tu cesta.']);
        } else {
            // Añadir el curso al carrito con una cantidad de 1
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
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario

        // Obtener el producto de la cesta por su ID
        $producto = $cesta->productos()->where('producto_id', $productoId)->first();

        // Verificar si el producto existe en la cesta
        if ($producto) {
            if ($producto->stock > 0) {
                // Incrementar la cantidad del producto
                $producto->pivot->cantidad++;
                $producto->pivot->save();

                // Reducir el stock del producto en 1
                $producto->stock--;
                $producto->save();
            } else {
                // Manejar caso donde no hay suficiente stock
                return redirect()->back()->with('error', 'El producto seleccionado no tiene suficiente stock.');
            }
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

                // Incrementar el stock del producto en 1
                $producto->stock++;
                $producto->save();



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

//        // Almacenar los productos y cursos en la sesión
//        Session::put('productosConCantidad', $productosConCantidad);
//        Session::put('cursosConCantidad', $cursosConCantidad);
//        Session::put('total', $total);

        $this->actualizarSesion($cesta);

        return view('cesta.cesta', [
            'productosConCantidad' => $productosConCantidad,
            'cursosConCantidad' => $cursosConCantidad,
            'total' => $total
        ]);
    }



    public function eliminarProducto($productoId)
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario

        // Verificar si el producto está en la cesta antes de eliminar
        $producto = $cesta->productos()->where('producto_id', $productoId)->first();
        if ($producto) {
            // Obtener la cantidad del producto en la cesta
            $cantidad = $producto->pivot->cantidad;

            // Incrementar el stock del producto eliminado según la cantidad en la cesta
            $producto->stock += $cantidad;
            $producto->save();

            // Eliminar el producto de la cesta
            $cesta->productos()->detach($productoId);
        }

        $this->actualizarSesion($cesta);
        return redirect()->back()->with('success', 'Producto eliminado del carrito');
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

        $productosEnCesta = $cesta->productos()->get();
        foreach ($productosEnCesta as $producto) {
            $cantidad = $producto->pivot->cantidad; // Obtener la cantidad de este producto en la cesta
            $producto->stock += $cantidad; // Incrementar el stock según la cantidad de este producto en la cesta
            $producto->save();
        }

    // Eliminar los productos y cursos de la cesta en la base de datos
        $cesta->productos()->detach();
        $cesta->cursos()->detach();


        $this->actualizarSesion($cesta);

        return redirect()->back()->with('success', 'Productos y cursos eliminados del carrito');
    }


    public function actualizarSesion($cesta)
    {
        // Obtener el ID del usuario autenticado
        $usuarioId = auth()->id(); // Asegúrate de que el usuario esté autenticado

        // Obtener los productos y cursos actuales del carrito
        $productosEnCesta = $cesta->productos()->withPivot('cantidad')->get();
        $cursosEnCesta = $cesta->cursos()->withPivot('cantidad')->get();

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
                'subtotal' => $producto->precio * $producto->pivot->cantidad,
                'stock' => $producto->stock // Agregar el stock del producto
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
                'stock' => $curso->stock // Agregar el stock del curso
            ];
            $total += $curso->precio * $curso->pivot->cantidad;
        }

        // Almacenar los datos específicos del usuario en la sesión
        \Illuminate\Support\Facades\Session::put("productoSesion_{$usuarioId}", $productosParaSesion);
        \Illuminate\Support\Facades\Session::put("cursoSesion_{$usuarioId}", $cursosParaSesion);
        \Illuminate\Support\Facades\Session::put("total_{$usuarioId}", $total);
    }


    public function generarFactura()
    {
        $usuario = Auth::user(); // Obtener el usuario autenticado
        $cesta = $usuario->cesta; // Obtener la cesta del usuario

        // Obtener los productos y cursos actuales del carrito
        $productosEnCesta = $cesta->productos()->withPivot('cantidad')->get();
        $cursosEnCesta = $cesta->cursos()->withPivot('cantidad')->get();

        // Verificar si hay suficiente stock para los productos en la cesta
        foreach ($productosEnCesta as $producto) {
            if ($producto->stock < $producto->pivot->cantidad) {
                return redirect()->back()->with('error', 'No hay suficiente stock disponible para el producto: ' . $producto->nombre);
            }
        }



        // Calcular el total de la factura
        $total = 0;
        foreach ($productosEnCesta as $producto) {
            $total += $producto->precio * $producto->pivot->cantidad;
        }
        foreach ($cursosEnCesta as $curso) {
            $total += $curso->precio * $curso->pivot->cantidad;
        }

        // Crear una nueva factura
        $factura = new Factura();
        $factura->user_id = $usuario->id;
        $factura->total = $total;
        // Puedes agregar más campos a la factura si es necesario

        // Guardar la factura en la base de datos
        $factura->save();

        // Asociar los productos a la factura con las cantidades seleccionadas en la cesta
        foreach ($productosEnCesta as $producto) {
            $cantidad = $producto->pivot->cantidad; // Obtener la cantidad seleccionada en la cesta
            $factura->productos()->attach($producto->id, ['cantidad' => $cantidad]); // Asociar el producto con la cantidad
        }

        // Asociar los cursos a la factura con las cantidades seleccionadas en la cesta
        foreach ($cursosEnCesta as $curso) {
            $cantidad = $curso->pivot->cantidad; // Obtener la cantidad seleccionada en la cesta
            $usuario->cursos()->attach($curso->id, ['progreso' => 0]);
            $factura->cursos()->attach($curso->id, ['cantidad' => $cantidad]); // Asociar el curso con la cantidad
        }

        // Vaciar la cesta del usuario
        $cesta->productos()->detach();
        $cesta->cursos()->detach();

        // Actualizar los datos en la sesión
        $this->actualizarSesion($cesta);

        // Redireccionar o devolver una respuesta según sea necesario
        return redirect()->back()->with('success', 'Factura generada y cesta vaciada');
    }





}
