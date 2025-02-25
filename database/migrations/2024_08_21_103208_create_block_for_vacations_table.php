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
        Schema::create('block_for_vacations', function (Blueprint $table) {
            $table->comment('Дата освобождения блоков');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('common_block_id')
                ->constrained('common_blocks')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->date('date')->nullable();
            $table->foreignId('period_vacation_type_id')
                ->nullable()
                ->constrained('period_vacation_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_for_vacations');
    }
};
