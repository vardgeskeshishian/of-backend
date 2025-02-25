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
        Schema::create('page_block_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\PageBlock::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->unsignedInteger('attachment_id')
                ->nullable();
            $table->foreign('attachment_id')
                ->references('id')
                ->on('attachments')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->string('name');
            $table->string('slug');
            $table->string('title')->nullable();
            $table->string('type')->nullable();
            $table->string('link')->nullable();
            $table->longText('text')->nullable();
            $table->json('list')->nullable();
            $table->timestamps();

            $table->unique(['page_block_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_block_items');
    }
};
