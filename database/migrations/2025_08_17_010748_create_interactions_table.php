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
            $table->enum('type', ['message', 'question','reminder']);
            $table->text('text')->nullable();
            $table->json('question')->nullable();
            $table->json('answer')->nullable();
            $table->boolean('correct')->nullable();
            $table->timestamps();

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
