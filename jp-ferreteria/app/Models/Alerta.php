<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;

    protected $table = 'alertas';
    protected $primaryKey = 'ID_ALERTA';

    protected $fillable = [
        'ID_PRODUCTO',
        'COMENTARIO',
        'ESTADO_ALERTA',
        'FECHA_ALERTA',
    ];


    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_PRODUCTO', 'ID_PRODUCTO');
    }
}