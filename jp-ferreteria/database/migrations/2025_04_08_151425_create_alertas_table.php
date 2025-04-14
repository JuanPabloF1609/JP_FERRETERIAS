<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertasTable extends Migration
{
    public function up()
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->id('ID_ALERTA');
            $table->unsignedBigInteger('ID_PRODUCTO')->nullable();
            $table->text('COMENTARIO')->nullable(); 
            $table->enum('ESTADO_ALERTA', ['Pendiente', 'Resuelta'])->default('Pendiente'); 
            $table->timestamp('FECHA_ALERTA')->useCurrent();
            $table->timestamps();


            $table->foreign('ID_PRODUCTO')->references('ID_PRODUCTO')->on('productos')->onDelete('set null')->onUpdate('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('alertas');
    }
}