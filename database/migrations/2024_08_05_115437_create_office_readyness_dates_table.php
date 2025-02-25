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
        Schema::create('office_readyness_dates', function (Blueprint $table) {
            $table->comment('Готовность к въезду. С какой даты можно въехать в офис');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('common_block_id')
                ->nullable()
                ->constrained('common_blocks')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->date('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_readyness_dates');
    }
};
