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
        Schema::create('podcast_lessons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('podcast_id')->constrained()->onDelete('cascade');
            $table->text('key_themes');
            $table->text('learning_outcomes');        
            $table->text('practical_applications');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcast_lessons');
    }
};
