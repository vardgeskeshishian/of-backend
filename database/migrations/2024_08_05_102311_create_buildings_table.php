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
        Schema::create('buildings', function (Blueprint $table) {
            $table->comment('Таблица зданий.');
            $table->unsignedBigInteger('id')->primary();
            $table->string('name')->nullable();
            $table->string('eng_name')->nullable();
            $table->integer('gross_boma_area')->default(0);
            $table->integer('gross_leasable_area')->default(0);
            $table->integer('land_area')->default(0);
            $table->tinyInteger('floors_count')->default(0);
            $table->smallInteger('build_year')->nullable();
            $table->string('address')->default('');
            $table->json('coordinates')->nullable();
            $table->smallInteger('freight_elevators')->default(0);
            $table->smallInteger('passenger_elevators')
                ->nullable()
                ->default(0);
            $table->string('taxes_department_number')->nullable();
            $table->foreignId('assignment_id')
                ->nullable()
                ->constrained('assignments')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('class_code_id')
                ->nullable()
                ->constrained('class_codes')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('provider_id')
                ->nullable()
                ->constrained('providers')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('conditioning_id')
                ->nullable()
                ->constrained('conditionings')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('fire_alarm_id')
                ->nullable()
                ->constrained('fire_alarms')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('security_id')
                ->nullable()
                ->constrained('securities')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreignId('ventilation_id')
                ->nullable()
                ->constrained('ventilations')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->boolean('parking_coefficient_is_unlimited')->default(0);
            $table->integer('coefficient_first_value')->nullable();
            $table->integer('coefficient_last_value')->nullable();
            $table->boolean('was_moderated')->default(false);
            $table->boolean('is_export_sites')->default(true);
            $table->boolean('is_new_construction')->default(false);
            $table->mediumInteger('commissioning_year')->nullable();
            $table->smallInteger('commissioning_quarter')->nullable();
            $table->string('cadastral_number', 40)->nullable();
            $table->string('cadastral_land_number', 40)->nullable();
            $table->date('land_contract_date')->nullable();
            $table->foreignId('district_type_id')
                ->nullable()
                ->constrained('district_types')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->integer('operating_costs_without_nds')->nullable();

            $table->bigInteger('year_reconstruction')->nullable();
            $table->tinyInteger('is_object_cultural_heritage')->default(0);
            $table->string('ensemble_name')->nullable();
            $table->integer('built_up_area')->nullable();
            $table->integer('underground_floors_count')->nullable();
            $table->text('permitted_use_of_land_plot')->nullable();
            $table->foreignId('administrative_district_type_id')
                ->nullable()
                ->constrained('administrative_district_types');
            $table->foreignId('exterior_wall_type_id')
                ->nullable()
                ->constrained('exterior_wall_types');
            $table->foreignId('overlap_type_id')
                ->nullable()
                ->constrained('overlap_types');
            $table->foreignId('law_type_id')
                ->nullable()
                ->constrained('law_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
