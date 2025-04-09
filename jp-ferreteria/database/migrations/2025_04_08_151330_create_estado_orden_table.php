<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoOrdenTable extends Migration
{
    public function up()
    {
        Schema::create('estado_orden', function (Blueprint $table) {
            $table->id('ID_ESTADO_ORDEN');
            $table->enum('NOMBRE_ESTADO_ORDEN', [ 'No_Entregado','Entregado']);
            $table->text('DESCRIPCION')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('estado_orden');
    }
}