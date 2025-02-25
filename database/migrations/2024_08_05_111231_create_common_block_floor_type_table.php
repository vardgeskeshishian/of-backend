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
        Schema::create('common_block_floor_type', function (Blueprint $table) {
            $table->comment('Связующая. Этаж блока.');
            $table->foreignId('common_block_id')
                ->constrained('common_blocks')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('floor_type_id')
                ->constrained('floor_types')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->primary(['common_block_id', 'floor_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_block_floor_type');
    }
};
