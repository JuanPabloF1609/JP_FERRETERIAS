<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id('ID_CLIENTE');
            $table->string('NOMBRE_CLIENTE', 100);
            $table->text('DIRECCION_CLIENTE')->nullable();
            $table->string('TELEFONO_CLIENTE', 20)->nullable();
            $table->string('CORREO_CLIENTE', 100)->unique()->nullable();
            $table->string('CC_NIT_CLIENTE', 20)->unique()->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('clientes');
    }
}