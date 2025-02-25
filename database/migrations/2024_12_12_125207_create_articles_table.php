<?php

use App\Models\ArticleCategory;
use Database\Migrations\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends BaseMigration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $this->addAuthorAndEditor($table);
            $table->foreignIdFor(ArticleCategory::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->json('sources')->nullable();
            $table->json('hyperlinks')->nullable();

            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->integer('views')->default(0);

            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
