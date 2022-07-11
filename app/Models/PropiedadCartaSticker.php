<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropiedadCartaSticker extends Model
{
    use HasFactory;
    protected $table = 'propiedades_carta_sticker';
    public $timestamps = false;

    protected $fillable = [
        'propiedades_adicionales_id',
        'carta_id',
        'sticker_id',
        'value'
    ];
}
