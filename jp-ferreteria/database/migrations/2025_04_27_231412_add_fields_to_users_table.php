<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name', 50)->after('id');
            $table->string('second_name', 50)->nullable()->after('first_name');
            $table->string('first_surname', 50)->after('second_name');
            $table->string('second_surname', 50)->nullable()->after('first_surname');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'second_name', 'first_surname', 'second_surname']);
        });
    }
};