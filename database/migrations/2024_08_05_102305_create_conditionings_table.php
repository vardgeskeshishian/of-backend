<?php

use Database\Migrations\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends BaseMigration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('conditionings', function (Blueprint $table) {
            $table->comment('Тип кондиционирования.');
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conditionings');
    }
};
