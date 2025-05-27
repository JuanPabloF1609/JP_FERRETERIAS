<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;

    protected $table = 'factura';
    protected $primaryKey = 'ID_FACTURA';

    protected $fillable = [
        'ID_CLIENTE',
        'ID_USER',
        'FECHA_FACTURA',
        'TOTAL',
        'ESTADO', // <-- Agrega esto
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'ID_CLIENTE', 'ID_CLIENTE');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'ID_USER', 'id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'factura_prod', 'ID_FACTURA', 'ID_PRODUCTO')
                    ->withPivot('CANTIDAD', 'DESCUENTO');
    }
}