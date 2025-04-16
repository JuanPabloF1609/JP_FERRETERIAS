<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaProdTable extends Migration
{
    public function up()
    {
        Schema::create('factura_prod', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_FACTURA');
            $table->unsignedBigInteger('ID_PRODUCTO');
            $table->integer('CANTIDAD');
            $table->decimal('DESCUENTO', 10, 2)->default(0.00);

            $table->foreign('ID_FACTURA')->references('ID_FACTURA')->on('factura')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ID_PRODUCTO')->references('ID_PRODUCTO')->on('productos')->onDelete('cascade')->onUpdate('cascade');

            $table->primary(['ID_FACTURA', 'ID_PRODUCTO']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('factura_prod');
    }
}