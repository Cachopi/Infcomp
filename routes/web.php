<?php

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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');




    Route::view("/inicio","inicio.inicio")->name('inicio');

    Route::get("/cursos", function () {
        return view('cursos.cursos');
    })->name('cursos');

    Route::get("/productos", function () {
        return view('productos.productos');
    })->name('productos');

    Route::resource("Productos",\App\Http\Controllers\ProductoController::class);
});


require __DIR__ . '/auth.php';
