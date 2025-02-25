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
        Schema::create('building_tag', function (Blueprint $table) {
            $table->comment('Теги на билдинг.');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('building_id')
                ->constrained('buildings')
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
        Schema::dropIfExists('building_tag');
    }
};
