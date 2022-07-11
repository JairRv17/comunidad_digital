<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $table = 'perfiles';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'primer_nombre',
        'segundo_nombre',
        'primer_apellido',
        'segundo_apellido',
        'pais',
        'ciudad',
        'direccion',
        'fecha_nacimiento'
    ];
}
