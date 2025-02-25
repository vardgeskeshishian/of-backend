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
        Schema::create('rent_contract_types', function (Blueprint $table) {
            $table->comment('Справочник. Тип договоров по аренде (Прямая аренда, Субаренда и тп).');
            $table->unsignedBigInteger('id')->primary();
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_contract_types');
    }
};
