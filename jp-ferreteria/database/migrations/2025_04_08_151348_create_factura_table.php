<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaTable extends Migration
{
    public function up()
    {
        Schema::create('factura', function (Blueprint $table) {
            $table->id('ID_FACTURA');
            $table->unsignedBigInteger('ID_CLIENTE')->nullable();
            $table->unsignedBigInteger('ID_USER')->nullable();
            $table->timestamp('FECHA_FACTURA')->useCurrent();
            $table->decimal('TOTAL', 10, 2);
            $table->timestamps();

            $table->foreign('ID_CLIENTE')->references('ID_CLIENTE')->on('clientes')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('ID_USER')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('factura');
    }
}