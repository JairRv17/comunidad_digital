<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RarezaCartaSticker extends Model
{
    use HasFactory;
    protected $table = 'rareza_cartas_stickers';
    public $timestamps = false;
    protected $fillable = [
        'carta_id',
        'sticker_id',
        'rareza_id'
    ];
    public function rarezas()
    {
        return $this->belongsTo(Rareza::class, 'rareza_id', 'id');
    }
}
