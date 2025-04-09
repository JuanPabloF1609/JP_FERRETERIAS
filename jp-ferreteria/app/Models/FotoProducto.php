<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProducto extends Model
{
    use HasFactory;

    protected $table = 'fotos_productos';
    protected $primaryKey = 'ID_FOTO';

    protected $fillable = [
        'ID_PRODUCTO',
        'URL_FOTO',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_PRODUCTO', 'ID_PRODUCTO');
    }
}