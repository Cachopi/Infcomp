<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cesta extends Model
{
    use HasFactory;


    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'cestas_productos', 'cesta_id', 'producto_id')
            ->withPivot('cantidad')
            ->withTimestamps();
    }

    public function cursos()
    {
        return $this->belongsToMany(Cursos::class, 'cesta_cursos', 'cesta_id', 'curso_id')
            ->withPivot('cantidad');
    }
}
