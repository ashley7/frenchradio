<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('discussion_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('podcast_lesson_id')->constrained('podcast_lessons')->onDelete('cascade');
            $table->text('question');
        });
    }

     
    public function down(): void
    {
        Schema::dropIfExists('discussion_questions');
    }
};
