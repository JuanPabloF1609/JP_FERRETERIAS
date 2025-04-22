<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_sale_drafts_table.php

public function up()
{
    Schema::create('sale_drafts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->json('items'); // Almacena los items del carrito
        $table->decimal('total', 10, 2);
        $table->string('status')->default('draft'); // draft, completed, cancelled
        $table->timestamps();
    });
}
};
