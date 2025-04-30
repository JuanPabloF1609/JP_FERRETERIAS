<?php

namespace Tests\Unit;

use App\Models\Categoria;
use PHPUnit\Framework\TestCase;

class CategoriaTest extends TestCase
{
    public function test_categoria_tiene_relacion_productos()
    {
        $categoria = new Categoria();
        $this->assertTrue(
            method_exists($categoria, 'productos'),
            'El modelo Categoria debe tener la relación productos()'
        );
    }

    public function test_categoria_tiene_atributos_correctos()
    {
        $categoria = new Categoria();
        $this->assertEquals('categorias', $categoria->getTable(), 'El nombre de la tabla debe ser "categorias"');
        $this->assertEquals('ID_CATEGORIA', $categoria->getKeyName(), 'La clave primaria debe ser "ID_CATEGORIA"');
        $this->assertEquals(['NOMBRE_CATEGORIA', 'DESCRIPCION', 'ESTADO'], $categoria->getFillable(), 'Los atributos rellenables deben ser correctos');
    }
}