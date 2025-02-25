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
        Schema::create('class_codes', function (Blueprint $table) {
            $table->comment('Справочник. Класс зданий.');
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
            $table->integer('sort_order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_codes');
    }
};
