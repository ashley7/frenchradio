<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
    public function up(): void
    {
        Schema::create('lesson_plans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('radio_program_id')->nullable()->constrained('radio_programs');
            $table->string('title');
            $table->text('learning_objectives');
            $table->longText('content');
            $table->longText('activities')->nullable();
            $table->longText('assessment')->nullable();
            $table->string('downloadable_material')->nullable();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('lesson_plans');
    }
};
