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
        Schema::create('interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notion_page_id')->constrained()->cascadeOnDelete();
            $table->string('user_phone');
            $table->enum('type', ['quiz', 'feedback', 'study_session', 'motivation']);
            $table->json('question')->nullable();
            $table->json('answer')->nullable();
            $table->boolean('correct')->nullable();
            $table->text('ai_feedback')->nullable();
            $table->timestamps();
            
            $table->index(['user_phone', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interactions');
    }
};
