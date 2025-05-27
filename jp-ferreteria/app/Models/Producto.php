<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'ID_PRODUCTO';

    protected $fillable = [
        'NOMBRE_PRODUCTO',
        'PRECIO',
        'CANTIDAD',
        'STOCK_MINIMO',
        'ID_CATEGORIA',
        'REFERENCIA',
        'DESCRIPCION',
        'MARCA',
        'COLOR',
        'UNIDAD_MEDIDA',
        'MATERIAL',
        'DIMENSIONES',
        'USO',
        'NORMA',
        'PROCEDENCIA',
        'OFERTA',
        'PRECIO_OFERTA',
        'CUOTAS',
        'CUOTA_VALOR',
        'MAS_VENDIDO',
        'CARACTERISTICAS',
        'ESTADO',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'ID_CATEGORIA', 'ID_CATEGORIA');
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class, 'ID_PRODUCTO', 'ID_PRODUCTO');
    }

    /**
     * Relación con las fotos del producto.
     */
    public function fotos()
    {
        return $this->hasMany(FotoProducto::class, 'ID_PRODUCTO', 'ID_PRODUCTO');
    }
}