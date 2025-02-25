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
        Schema::create('parkings', function (Blueprint $table) {
            $table->comment('Парковки. (!!!корявая таблица: без ссылок на ключи)');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('building_id')
                ->constrained('buildings')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('currency_id')
                ->nullable()
                ->constrained('currency_types')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('type_id')
                ->nullable()
                ->constrained('parking_types')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->integer('count');
            $table->double('price');
            $table->tinyInteger('nds');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkings');
    }
};
