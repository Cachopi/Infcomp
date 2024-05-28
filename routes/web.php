<?php

use App\Http\Controllers\CestaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayPalController;

/*
|-------------------------------------------------------------------
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

Route::middleware('Admin')->group(function () {
    Route::resource("Usuarios", \App\Http\Controllers\AdminUserController::class);
    Route::resource("Productos", \App\Http\Controllers\ProductoController::class);
    Route::resource("Cursos", \App\Http\Controllers\CursosController::class);
    Route::resource("Facturas",\App\Http\Controllers\FacturaController::class);
});

Route::view("/inicio", "index")->name('inicio');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



//    Route::post('cesta/anadir/{productoId}', [CestaController::class, 'anadirProducto'])->name('cesta.anadir');

    Route::get('cesta', [CestaController::class, 'mostrarCesta'])->name('cesta.mostrar');
    Route::post('cesta/sumar/{productoId}', [CestaController::class, 'sumarCantidad'])->name('cesta.sumar');
    Route::post('cesta/restar/{productoId}', [CestaController::class, 'restarCantidad'])->name('cesta.restar');
    Route::delete('cesta/eliminar/{productoId}', [CestaController::class, 'eliminarProducto'])->name('cesta.eliminar');
    Route::delete('/eliminar-curso/{cursoId}', [CestaController::class, 'eliminarCurso'])->name('cesta.eliminarCurso');

    Route::get('cesta/vaciar', [CestaController::class, 'vaciarCesta'])->name('cesta.vaciar');



    Route::post('/cesta/restarCurso/{cursoId}', [CestaController::class, 'restarCurso'])->name('cesta.restarCurso');
    Route::post('/cesta/sumarCurso/{cursoId}', [CestaController::class, 'sumarCurso'])->name('cesta.sumarCurso');


    Route::post('/cesta/anadir/{productoId}/{tipo}', [CestaController::class, 'anadirProducto'])->name('cesta.anadir');

    Route::post('/generar-factura', [CestaController::class, 'generarFactura'])->name('generar.factura');

    Route::get('/facturas', [FacturaController::class, 'mostrar'])->name('facturas.mostrar');
    Route::get('/facturas/{id}', [FacturaController::class, 'show'])->name('facturas.show');



    Route::get('Productos', [\App\Http\Controllers\ProductoController::class, 'index'])->name('Productos.index');
    Route::get('Cursos', [\App\Http\Controllers\CursosController::class, 'index'])->name('Cursos.index');

    Route::get('/mis-cursos', [\App\Http\Controllers\CursosController::class, 'misCursos'])->name('mis-cursos');
    Route::delete('/eliminar-curso-usuario/{id}', [\App\Http\Controllers\CursosController::class,'eliminar_curso'])->name('eliminar_curso_usuario');

});
Route::get('Productos', [\App\Http\Controllers\ProductoController::class, 'index'])->name('Productos.index');
Route::get('Cursos', [\App\Http\Controllers\CursosController::class, 'index'])->name('Cursos.index');

// routes/web.php

// En routes/web.php





// Ruta para procesar el pago
Route::get('/paypal/process-payment', [PayPalController::class, 'processPayment'])->name('paypal.process');

// Ruta para el retorno exitoso del pago
Route::get('/paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.success');

// Ruta para el retorno de cancelación del pago
Route::get('/paypal/payment/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.cancel');



require __DIR__ . '/auth.php';
