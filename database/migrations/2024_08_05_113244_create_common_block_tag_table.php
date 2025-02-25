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
        Schema::create('common_block_tag', function (Blueprint $table) {
            $table->comment('Связующая. Тэги блоков.');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('common_block_id')
                ->constrained('common_blocks')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('tag_id')
                ->constrained('tags')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_block_tag');
    }
};
