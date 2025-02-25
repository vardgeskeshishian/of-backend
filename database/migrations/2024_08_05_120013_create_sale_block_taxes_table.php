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
        Schema::create('sale_block_taxes', function (Blueprint $table) {
            $table->comment('Связующая. Налоги по продаже.');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('tax_type_id')
                ->nullable()
                ->constrained('tax_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_block_taxes');
    }
};
