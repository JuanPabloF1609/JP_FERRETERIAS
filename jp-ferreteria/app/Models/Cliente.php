<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'ID_CLIENTE';

    protected $fillable = [
        'NOMBRE_CLIENTE',
        'DIRECCION_CLIENTE',
        'TELEFONO_CLIENTE',
        'CORREO_CLIENTE',
        'CC_NIT_CLIENTE',
    ];

    public function facturas()
    {
        return $this->hasMany(Factura::class, 'ID_CLIENTE', 'ID_CLIENTE');
    }
}