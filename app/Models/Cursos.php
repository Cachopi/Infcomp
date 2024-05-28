<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use HasFactory;
    protected $fillable=["nombre","descripcion","precio","ruta","horas"];

    public function cesta()
    {
        return $this->belongsToMany(Cesta::class, 'cesta_cursos')
            ->withPivot('cantidad');


    }
    public function facturas()
    {
        return $this->belongsToMany(Factura::class)->withPivot('cantidad');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'curso_user', 'curso_id', 'user_id')->withPivot('progreso')->withTimestamps();
    }
}

