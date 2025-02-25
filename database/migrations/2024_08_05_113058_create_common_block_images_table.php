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
        Schema::create('common_block_images', function (Blueprint $table) {
            $table->comment('Связующая. Картинки блоков.');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('common_block_id')
                ->constrained('common_blocks')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('image_id')
                ->constrained('images')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('image_type')->nullable();
            $table->integer('sort_order')->default(999999999);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_block_images');
    }
};
