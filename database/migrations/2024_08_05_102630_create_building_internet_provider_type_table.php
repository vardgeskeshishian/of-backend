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
        Schema::create('building_internet_provider_type', function (Blueprint $table) {
            $table->comment('Связующая. Интернет провайдер.');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('building_id')
                ->constrained('buildings')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('internet_provider_type_id')
                ->constrained('internet_provider_types')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
                ->name('building_internet_provider_type_internet_provider_type_id_fk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_internet_provider_type');
    }
};
