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
        Schema::create('metro_metro_line', function (Blueprint $table) {
            $table->comment('Связующая станции метро и линий метро. ');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('metro_id')
                ->constrained('metros')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('metro_line_id')
                ->constrained('metro_lines')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metro_metro_line');
    }
};
