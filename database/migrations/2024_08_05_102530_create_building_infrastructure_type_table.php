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
        Schema::create('building_infrastructure_type', function (Blueprint $table) {
            $table->comment('Связующая. Инфраструктура.');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('building_id')
                ->constrained('buildings')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('infrastructure_type_id')
                ->constrained('infrastructure_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->unique(['building_id', 'infrastructure_type_id'], 'building_infrastructure_building_id_infrastructure_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_infrastructure_type');
    }
};
