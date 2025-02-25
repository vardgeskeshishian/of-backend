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
        Schema::create('menu_item_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Menu::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->string('name');
            $table->string('key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_item_categories');
    }
};
