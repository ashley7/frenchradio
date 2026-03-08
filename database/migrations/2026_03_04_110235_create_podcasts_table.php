<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->text('description');

            $table->string('audio_file')->nullable();
            $table->string('you_tube_embed_url')->nullable();

            $table->foreignId('created_by')->constrained('users');

            $table->softDeletes();
        });
    }

 
    public function down(): void
    {
        Schema::dropIfExists('podcasts');
    }
};
