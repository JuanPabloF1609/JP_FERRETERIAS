<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenEntrega extends Model
{
    use HasFactory;

    protected $table = 'ordenes_de_entrega';
    protected $primaryKey = 'ID_ORDEN';

    protected $fillable = [
        'ID_USER',
        'ID_FACTURA',
        'ID_ESTADO_ORDEN',
        'FECHA_ORDEN',
        'FECHA_ENTREGA',
        'DIRECCION_ENTREGA',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_USER', 'id');
    }

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'ID_FACTURA', 'ID_FACTURA');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoOrden::class, 'ID_ESTADO_ORDEN', 'ID_ESTADO_ORDEN');
    }
}