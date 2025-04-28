<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'ID_PRODUCTO';
    protected $fillable = [
        'NOMBRE_PRODUCTO',
        'PRECIO',
        'CANTIDAD',
        'STOCK_MINIMO',
        'ID_FOTO',
        'ID_CATEGORIA',
        'REFERENCIA',
        'DESCRIPCION'
    ];
    public $timestamps = false;

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'ID_CATEGORIA');
    }

    public function foto()
    {
        return $this->belongsTo(FotoProducto::class, 'ID_FOTO');
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'ID_PRODUCTO');
    }

    public function facturas()
    {
        return $this->belongsToMany(Factura::class, 'factura_prod', 'ID_PRODUCTO', 'ID_FACTURA')
                    ->withPivot('CANTIDAD', 'DESCUENTO');
    }
}