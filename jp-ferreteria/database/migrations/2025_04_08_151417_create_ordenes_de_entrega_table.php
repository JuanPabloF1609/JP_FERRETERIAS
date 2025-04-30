<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenesDeEntregaTable extends Migration
{
    public function up()
    {
        Schema::create('ordenes_de_entrega', function (Blueprint $table) {
            $table->id('ID_ORDEN');
            $table->unsignedBigInteger('ID_USER')->nullable();
            $table->unsignedBigInteger('ID_FACTURA')->nullable();
            $table->unsignedBigInteger('ID_ESTADO_ORDEN')->nullable();
            $table->timestamp('FECHA_ORDEN')->useCurrent();
            $table->timestamp('FECHA_ENTREGA')->nullable();
            $table->text('DIRECCION_ENTREGA')->nullable();
            $table->timestamps();

            $table->foreign('ID_USER')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('ID_FACTURA')->references('ID_FACTURA')->on('factura')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ID_ESTADO_ORDEN')->references('ID_ESTADO_ORDEN')->on('estado_orden')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ordenes_de_entrega');
    }
}