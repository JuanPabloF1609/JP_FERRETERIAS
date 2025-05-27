<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id('ID_PRODUCTO');
            $table->string('NOMBRE_PRODUCTO', 100);
            $table->decimal('PRECIO', 10, 2);
            $table->integer('CANTIDAD');
            $table->integer('STOCK_MINIMO')->nullable();
            $table->unsignedBigInteger('ID_CATEGORIA')->nullable();
            $table->string('REFERENCIA', 50)->nullable();
            $table->text('DESCRIPCION')->nullable();

            // Campos adicionales para ferretería
            $table->string('MARCA')->nullable();
            $table->string('COLOR')->nullable();
            $table->string('UNIDAD_MEDIDA')->nullable(); // Ej: kg, m, litro, caja, pieza
            $table->string('MATERIAL')->nullable(); // Ej: acero, PVC, madera
            $table->string('DIMENSIONES')->nullable(); // Ej: 2x4", 1m x 2m
            $table->string('USO')->nullable(); // Ej: plomería, electricidad
            $table->string('NORMA')->nullable(); // Norma técnica o certificación
            $table->string('PROCEDENCIA')->nullable(); // País de origen
            $table->boolean('OFERTA')->default(false);
            $table->decimal('PRECIO_OFERTA', 10, 2)->nullable();
            $table->integer('CUOTAS')->nullable();
            $table->decimal('CUOTA_VALOR', 10, 2)->nullable();
            $table->boolean('MAS_VENDIDO')->default(false);
            $table->text('CARACTERISTICAS')->nullable();
            $table->string('ESTADO')->default('activo'); // <--- AGREGAR ESTA LÍNEA

            $table->timestamps();

            $table->foreign('ID_CATEGORIA')->references('ID_CATEGORIA')->on('categorias')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}