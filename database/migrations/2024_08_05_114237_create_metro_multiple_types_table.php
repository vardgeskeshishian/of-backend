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
        Schema::create('metro_multiple_types', function (Blueprint $table) {
            $table->comment('Справочник. Тип расположения станции метро относительно БКЛ и МЦК');
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metro_multiple_types');
    }
};
