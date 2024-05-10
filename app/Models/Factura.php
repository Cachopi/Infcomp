<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    /**
     * Los productos asociados a esta factura.
     */
    public function productos()
    {
        return $this->belongsToMany(Producto::class)->withPivot('cantidad');
    }

    /**
     * Los cursos asociados a esta factura.
     */
    public function cursos()
    {
        return $this->belongsToMany(Cursos::class)->withPivot('cantidad');
    }

    /**
     * El usuario al que pertenece esta factura.
     */
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
