<?php

namespace App\Http\Controllers;

use App\Models\Cursos;
use App\Http\Requests\StoreCursosRequest;
use App\Http\Requests\UpdateCursosRequest;
use Illuminate\Support\Facades\Auth;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cursos = Cursos::all();
        return view('cursos.cursos',compact('cursos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('cursos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCursosRequest $request)
    {
        $request->validate([
            'nombre' => 'required',
            'imagen' => 'required|image|max:2048',
        ]);



        $imagen = $request->file('imagen');
        $ruta = $imagen->store('public/images');
        $ruta=str_replace('public/', '', $ruta);





        $curso = Cursos::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'horas'=>$request->horas,
            'ruta' => $ruta,

        ]);
        $curso->save();
        $cursos = Cursos::all();
        return view("Cursos.Cursos",compact('cursos'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $curso = Cursos::find($id);

        if (!$curso) {
            return response()->json(['message' => 'Curso no encontrada'], 404);
        } else {
            $nombre = $curso->nombre;
            $descripcion = $curso->descripcion;
            $precio = $curso->precio;
            $url = Storage::url($curso->ruta);

            return response()->json(['nombre' => $nombre, 'descripcion' => $descripcion, 'precio' => $precio, 'curso_url' => $url]);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $curso = Cursos::find($id);
        return view("Cursos.update", compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCursosRequest $request, $id)
    {


        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'horas' => 'nullable|numeric'
        ]);


        $curso = Cursos::find($id);


        if (!$curso) {
            return redirect()->route('Cursos.index')->with('error', 'Curso no encontrado');
        }


        $curso->nombre = $request->input('nombre');
        $curso->descripcion = $request->input('descripcion');
        $curso->precio = $request->input('precio');
        $curso->horas = $request->input('horas');


        if ($request->hasFile('imagen')) {

            if ($curso->imagen) {
                Storage::delete($curso->imagen);
            }


            $imagen = $request->file('imagen');
            $ruta = $imagen->store('Cursos', 'public');
            $curso->ruta = $ruta;
        }


        $curso->save();


        return redirect()->route('Cursos.index')->with('success', 'curso actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $curso=Cursos::find($id);
        $curso->delete();
        return redirect()->route('Cursos.index');
    }

    public function misCursos()
    {
        $user = Auth::user();
        $cursos = $user->cursos;

        return view('cursos.usuario_curso', compact('cursos'));
    }
    public function eliminar_curso($id)
    {
        $usuario = Auth::user();


        $curso = Cursos::findOrFail($id);


        $usuario->cursos()->detach($curso->id);


        return redirect()->back()->with('success', 'Curso eliminado exitosamente.');
    }

}
