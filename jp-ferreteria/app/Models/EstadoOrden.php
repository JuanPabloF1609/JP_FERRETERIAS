<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoOrden extends Model
{
    use HasFactory;

    protected $table = 'estado_orden';
    protected $primaryKey = 'ID_ESTADO_ORDEN';

    protected $fillable = [
        'NOMBRE_ESTADO_ORDEN',
        'DESCRIPCION',
    ];

    public function ordenes()
    {
        return $this->hasMany(OrdenEntrega::class, 'ID_ESTADO_ORDEN', 'ID_ESTADO_ORDEN');
    }
}