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
        Schema::create('common_blocks', function (Blueprint $table) {
            $table->comment('Таблица общей информации блока. Так как блок может быть выставляться как на аренду, так и на продажу, в этой таблице храниться общая часть информации о блоке');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('building_id')
                ->nullable()
                ->constrained('buildings')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->string('name')->nullable();
            $table->boolean('is_available')->default(0);
            $table->boolean('is_negotiable_price')->default(0);
            $table->decimal('commission_amount_percent', 5);
            $table->boolean('is_export_sites')->default(0);
            $table->boolean('is_export_markets')->default(0);
            $table->boolean('is_full_building')->default(0);
            $table->boolean('is_floor_range')->default(0);
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->mediumInteger('min_area')->default(0);
            $table->mediumInteger('max_area')->default(0);
            $table->mediumInteger('useful_area')->default(0);
            $table->mediumInteger('electric_power')->default(0);
            $table->smallInteger('max_parking_size')->default(0);
            $table->foreignId('block_type_id')
                ->default(1)
                ->constrained('block_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('office_layout_type_id')
                ->default(1)
                ->constrained('office_layout_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('office_readyness_type_id')
                ->default(1)
                ->constrained('office_readyness_types')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->boolean('is_street_entrance')->nullable();
            $table->boolean('is_separate_entrance')->default(0);
            $table->boolean('is_furnished')->default(0);
            $table->text('inner_text')->nullable();
            $table->text('site_text')->nullable();
            $table->text('presentation_description')->nullable();
            $table->tinyInteger('is_for_vacation')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_blocks');
    }
};
