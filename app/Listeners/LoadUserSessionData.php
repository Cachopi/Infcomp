<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoadUserSessionData
{
    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $usuario = $event->user;

        // Obtener la cesta del usuario desde la base de datos
        $cesta = $usuario->cesta;

        if ($cesta) {
            $productos = $cesta->productos;
            $cursos = $cesta->cursos;
            $total = 0;
            $productosConCantidad = [];
            $cursosConCantidad = [];

            // Procesar productos
            foreach ($productos as $producto) {
                $cantidad = $producto->pivot->cantidad;
                $subtotal = $producto->precio * $cantidad;

                $productosConCantidad[] = [
                    'id' => $producto->id,
                    'nombre' => $producto->nombre,
                    'precio' => $producto->precio,
                    'ruta' => $producto->ruta,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,
                    'stock' => $producto->stock,
                ];
                $total += $subtotal;
            }

            // Procesar cursos
            foreach ($cursos as $curso) {
                $cantidad = $curso->pivot->cantidad;
                $subtotal = $curso->precio * $cantidad;

                $cursosConCantidad[] = [
                    'id' => $curso->id,
                    'nombre' => $curso->nombre,
                    'precio' => $curso->precio,
                    'ruta' => $curso->ruta,
                    'cantidad' => $cantidad,
                    'subtotal' => $subtotal,

                ];
                $total += $subtotal;
            }

            // Almacenar los productos y cursos en la sesión del usuario
            Session::put("productoSesion_{$usuario->id}", $productosConCantidad);
            Session::put("cursoSesion_{$usuario->id}", $cursosConCantidad);
            Session::put("total_{$usuario->id}", $total);
            Session::put("cantidad_{$usuario->id}", count($productosConCantidad) + count($cursosConCantidad));
        }
    }
}





