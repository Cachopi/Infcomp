<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $productos = Producto::all();

        return view("productos.productos", ["productos" => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductoRequest $request)
    {
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required|image|max:2048', // máximo 2MB
            'stock' => 'required|integer|min:0',
        ]);



        $imagen = $request->file('imagen');
        $ruta = $imagen->store('public/images');
        $ruta=str_replace('public/', '', $ruta);





        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'ruta' => $ruta,
            'stock' => $request->stock,
        ]);
        $producto->save();
        $productos = Producto::all();
        return view("productos.productos", ["productos" => $productos]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['message' => 'Producto no encontrada'], 404);
        } else {
            $nombre = $producto->nombre;
            $descripcion = $producto->descripcion;
            $precio = $producto->precio;
            $url = Storage::url($producto->ruta);

            return response()->json(['nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio, 'producto_url' => $url]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $producto = Producto::find($id);
        return view("productos.update", compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, $id)
    {
        //

        // Validar los datos de entrada
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stock' => 'required|integer|min:0'// Validación para la imagen
        ]);

        // Buscar el producto por ID
        $producto = Producto::find($id);

        // Verificar si el producto existe
        if (!$producto) {
            return redirect()->route('productos.index')->with('error', 'Producto no encontrado');
        }

        // Actualizar los campos del producto con los datos del formulario
        $producto->nombre = $request->input('nombre');
        $producto->descripcion = $request->input('descripcion');
        $producto->precio = $request->input('precio');
        $producto->stock = $request->stock;

        // Procesar la carga de la imagen
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si existe
            if ($producto->imagen) {
                Storage::delete($producto->imagen);
            }

            // Almacenar la nueva imagen
            $imagen = $request->file('imagen');
            $ruta = $imagen->store('productos', 'public');
            $producto->ruta = $ruta;
        }

        // Guardar los cambios en la base de datos
        $producto->save();

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('Productos.index')->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $producto=Producto::find($id);
       $producto->delete();
        return redirect()->route('Productos.index');
    }
}
