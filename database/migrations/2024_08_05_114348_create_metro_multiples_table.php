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
        Schema::create('metro_multiples', function (Blueprint $table) {
            $table->comment('Связующая. Расположения станции метро относительно БКЛ и МЦК');
            $table->foreignId('metro_multiple_types_id')
                ->constrained('metro_multiple_types')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('metro_id')
                ->constrained('metros')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metro_multiples');
    }
};
