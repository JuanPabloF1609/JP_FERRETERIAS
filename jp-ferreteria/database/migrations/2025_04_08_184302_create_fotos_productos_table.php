<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fotos_productos', function (Blueprint $table) {
            $table->id('ID_FOTO'); 
            $table->unsignedBigInteger('ID_PRODUCTO'); 
            $table->string('URL_FOTO', 255);
            $table->timestamps();

            $table->foreign('ID_PRODUCTO')->references('ID_PRODUCTO')->on('productos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fotos_productos');
    }
};