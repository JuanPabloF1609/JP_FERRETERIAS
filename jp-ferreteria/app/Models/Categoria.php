<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'ID_CATEGORIA';

    protected $fillable = [
        'NOMBRE_CATEGORIA',
        'DESCRIPCION',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'ID_CATEGORIA', 'ID_CATEGORIA');
    }
}