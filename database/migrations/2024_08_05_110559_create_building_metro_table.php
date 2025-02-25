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
        Schema::create('building_metro', function (Blueprint $table) {
            $table->comment('Связующая на метро и время до метро (на машине или пешком).');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('building_id')
                ->constrained('buildings')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('metro_id')
                ->constrained('metros')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->integer('time_foot')->nullable();
            $table->integer('time_car')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_metro');
    }
};
