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
        Schema::create('period_vacation_types', function (Blueprint $table) {
            $table->comment('Типы периодов.');
            $table->unsignedBigInteger('id')->primary();
            $table->tinyInteger('count');
            $table->string('value');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('period_vacation_types');
    }
};
