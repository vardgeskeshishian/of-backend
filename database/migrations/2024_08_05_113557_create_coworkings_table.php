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
        Schema::create('coworkings', function (Blueprint $table) {
            $table->comment('Данные по коворкингу, в том числе, какие блоки являются коворкингом');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('rent_block_id')
                ->nullable()
                ->constrained('rent_blocks')
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('coworking_operator_type_id')
                ->nullable()
                ->constrained('coworking_operator_types')
                ->restrictOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('working_place_price_id')
                ->nullable()
                ->constrained('money')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->smallInteger('working_place_count')->default(0);
            $table->smallInteger('free_place_count')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coworkings');
    }
};
