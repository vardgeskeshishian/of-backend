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
        Schema::create('sale_blocks', function (Blueprint $table) {
            $table->comment('Таблица блоков продажи. Включает в себя информацию о блоке необходимою только для продажи.');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('common_block_id')
                ->nullable()
                ->constrained('common_blocks')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('sale_block_tax_id')
                ->nullable()
                ->constrained('sale_block_taxes')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('price_per_meter_id')
                ->nullable()
                ->constrained('money')
                ->nullOnDelete()
                ->restrictOnUpdate();
            $table->tinyInteger('is_juridical_saller')
                ->nullable()
                ->default(0);
            $table->foreignId('sale_contract_type_id')
                ->constrained('sale_contract_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('target_sales_type_id')
                ->nullable()
                ->constrained('target_sales_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_blocks');
    }
};
