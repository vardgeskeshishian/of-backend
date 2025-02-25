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
        Schema::create('user_filter_condition', function (Blueprint $table) {
            $table->comment('Сохраненные фильтры пользователей');
            $table->unsignedBigInteger('id')->primary();
            $table->foreignId('user')
                ->constrained('users')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_filter_condition');
    }
};
