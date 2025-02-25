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
        Schema::create('money', function (Blueprint $table) {
            $table->comment('Цены с валютой.');
            $table->unsignedBigInteger('id')->primary();
            $table->decimal('value', 35, 10)->default(0.0000000000);
            $table->foreignId('currency_type_id')
                ->constrained('currency_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('money');
    }
};
