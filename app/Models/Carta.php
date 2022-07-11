<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carta extends Model
{
    use HasFactory;

    protected $fillable = [
        'coleccion_id',
        'descripcion',
        'condicion',
        'cantidad',
        'numeracion'
    ];
}
