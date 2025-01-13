<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('techniques', function (Blueprint $table) {
            $table->string('difficulty_level')->default('beginner')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('techniques', function (Blueprint $table) {
            $table->enum('difficulty_level', ['beginner', 'intermediate', 'advanced'])->default('beginner')->change();
        });
    }
};
