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
        Schema::create('utility_costs_types', function (Blueprint $table) {
            $table->comment('Эксплуатационные расходы (Дополнительные расходы). Для блоков, скорее всего для аренды. ');
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utility_costs_types');
    }
};
