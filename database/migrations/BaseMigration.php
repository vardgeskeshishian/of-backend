<?php

namespace Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class BaseMigration extends Migration
{
    protected function addAuthorAndEditor(Blueprint $table): void
    {
        $table->foreignId('creator_id')
            ->nullable()
            ->constrained('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();

        $table->foreignId('updater_id')
            ->nullable()
            ->constrained('users')
            ->cascadeOnDelete()
            ->cascadeOnUpdate();
    }
}
