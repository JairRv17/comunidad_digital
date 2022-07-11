<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropiedadAdicional extends Model
{
    use HasFactory;
    protected $table = 'propiedades_adicionales';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
        'coleccion_id'
    ];

    public function coleccion()
    {
        return $this->belongsTo(Coleccion::class);
    }
}
