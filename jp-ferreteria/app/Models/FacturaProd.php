<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacturaProd extends Model
{
    use HasFactory;

    protected $table = 'factura_prod';
    protected $primaryKey = ['ID_FACTURA', 'ID_PRODUCTO'];
    public $incrementing = false;
    protected $fillable = [
        'ID_FACTURA',
        'ID_PRODUCTO',
        'CANTIDAD',
        'DESCUENTO'
    ];
    public $timestamps = false;
}