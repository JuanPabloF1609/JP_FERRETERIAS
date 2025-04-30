<?php

namespace Tests\Unit;

use App\Models\Producto;
use App\Models\Categoria;
use PHPUnit\Framework\TestCase;

class ProductoTest extends TestCase
{
    public function test_producto_tiene_relacion_categoria()
    {
        $producto = new Producto();
        $this->assertTrue(
            method_exists($producto, 'categoria'),
            'El modelo Producto debe tener la relación categoria()'
        );
    }
    public function test_producto_tiene_atributos_correctos()
    {
        $producto = new Producto();
        $this->assertEquals('productos', $producto->getTable(), 'El nombre de la tabla debe ser "productos"');
        $this->assertEquals('ID_PRODUCTO', $producto->getKeyName(), 'La clave primaria debe ser "ID_PRODUCTO"');
        $this->assertEquals(
            [
                'NOMBRE_PRODUCTO',
                'PRECIO',
                'CANTIDAD',
                'STOCK_MINIMO',
                'ID_CATEGORIA',
                'REFERENCIA',
                'DESCRIPCION',
                'activo'
            ],
            $producto->getFillable(),
            'Los atributos rellenables deben ser correctos'
        );
    }
}