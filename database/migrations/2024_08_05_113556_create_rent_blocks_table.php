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
        Schema::create('rent_blocks', function (Blueprint $table) {
            $table->comment('Таблица блоков аренды. Включает в себя информацию о блоке необходимою только для аренды.');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('common_block_id')
                ->constrained('common_blocks')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->boolean('is_coworking')->default(0);
            $table->foreignId('price_meter_year_id')
                ->nullable()
                ->constrained('money')
                ->nullOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('operational_cost_id')
                ->nullable()
                ->constrained('money')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('rent_block_tax_id')
                ->default(1)
                ->constrained('rent_block_taxes')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('rent_contract_type_id')
                ->nullable()
                ->constrained('rent_contract_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('utility_costs_type_id')
                ->default(1)
                ->constrained('utility_costs_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('contract_term_type_id')
                ->default(1)
                ->constrained('contract_term_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->mediumInteger('deposit')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_blocks');
    }
};
