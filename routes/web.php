<?php

use App\Http\Controllers\CestaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::view("/inicio","index")->name('inicio');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('cesta/anadir/{productoId}', [CestaController::class, 'anadirProducto'])->name('cesta.anadir');

    Route::get('cesta', [CestaController::class, 'mostrarCesta'])->name('cesta.mostrar');
    Route::post('cesta/sumar/{productoId}', [CestaController::class, 'sumarCantidad'])->name('cesta.sumar');
    Route::post('cesta/restar/{productoId}', [CestaController::class, 'restarCantidad'])->name('cesta.restar');
    Route::delete('cesta/eliminar/{productoId}', [CestaController::class, 'eliminarProducto'])->name('cesta.eliminar');
    Route::get('cesta/vaciar', [CestaController::class, 'vaciarCesta'])->name('cesta.vaciar');



    Route::get("/cursos", function () {
        return view('cursos.cursos');
    })->name('cursos');



    Route::resource("Productos",\App\Http\Controllers\ProductoController::class);
    Route::resource("Cursos",\App\Http\Controllers\CursosController::class);



});


require __DIR__ . '/auth.php';
