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
        Schema::create('building_image', function (Blueprint $table) {
            $table->comment('Картинки зданий.');
            $table->foreignId('building_id')
                ->constrained('buildings')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('image_id')
                ->constrained('images')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('type')->nullable();
            $table->integer('sort_order')->default(999999999);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_image');
    }
};
