<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class FotoProducto extends Model
{
    use HasFactory;

    protected $table = 'fotos_productos';
    protected $primaryKey = 'ID_FOTO';

    protected $fillable = [
        'ID_PRODUCTO',
        'URL_FOTO',
    ];

    protected $appends = ['url_foto'];

    /**
     * Relación inversa con el producto.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'ID_PRODUCTO', 'ID_PRODUCTO');
    }

    /**
     * Accesor para obtener la URL pública de la foto.
     */
    public function getUrlFotoAttribute($value)
    {
        return Storage::url($this->attributes['URL_FOTO']);
    }
}