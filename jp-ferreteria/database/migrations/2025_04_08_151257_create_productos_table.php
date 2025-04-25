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
            $table->integer('STOCK_MINIMO');
            $table->unsignedBigInteger('ID_CATEGORIA')->nullable();
            $table->string('REFERENCIA', 50)->nullable();
            $table->text('DESCRIPCION')->nullable();
            $table->timestamps();

            $table->foreign('ID_CATEGORIA')->references('ID_CATEGORIA')->on('categorias')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('productos');
    }
}