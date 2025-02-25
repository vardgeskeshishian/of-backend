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
        Schema::create('seo_data', function (Blueprint $table) {
            $table->comment('Индивидуальные SEO данные');
            $table->unsignedBigInteger('id')->primary();
            $table->string('url', 500)->nullable()->unique();
            $table->string('h1')->nullable()->comment('H1');
            $table->string('title')->nullable()->comment('Title');
            $table->string('description')->nullable()->comment('Description');
            $table->string('keywords')->nullable()->comment('Keywords');
            $table->string('breadcrumbs')->nullable()->comment('Breadcrumbs');
            $table->string('text_top')->comment('Text top');
            $table->string('text_bottom')->comment('Text bottom');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_data');
    }
};
