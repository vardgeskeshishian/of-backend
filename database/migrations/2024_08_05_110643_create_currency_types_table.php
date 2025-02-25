<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currency_types', function (Blueprint $table) {
            $table->comment('Типы валют. Курс валют центробанка на сегодняшний день.');
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
            $table->string('code');
            $table->decimal('ruble_exchange_rate', 10, 5);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currency_types');
    }
};
