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
        Schema::create('notion_pages', function (Blueprint $table) {
            $table->id();
            $table->string('notion_id')->unique();
            $table->string('title');
            $table->string('url');
            $table->text('content')->nullable();
            $table->enum('status', ['to_study', 'studying', 'reviewing', 'consolidated']);
            $table->integer('priority')->default(1);
            $table->timestamp('created_at_notion');
            $table->timestamp('last_review')->nullable();
            $table->timestamp('next_review')->nullable();
            $table->timestamp('status_change')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
