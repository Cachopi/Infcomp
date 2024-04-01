<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Producto;
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
        return view("productos.productos",["productos"=>$productos]);
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
        ]);

        $imagen = $request->file('imagen');
        $ruta = $imagen->store('fotos', 'public'); // almacenar en storage/app/public/fotos

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'ruta' => $ruta
        ]);

        return response()->json(['message' => 'Producto creado ', 'producto' => $producto], 201);
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

            return response()->json(['nombre'=> $nombre, 'descripcion'=>$descripcion, 'precio'=>$precio, 'producto_url' => $url]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductoRequest $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //

        $this->destroy($producto);
        return response()->json(['mensaje'=>'producto eliminado']);
    }
}
