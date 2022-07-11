<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoColeccion extends Model
{
    use HasFactory;
    protected $table = 'tipo_colecciones';

    protected $fillable = [
        'descripcion'
    ];
}
