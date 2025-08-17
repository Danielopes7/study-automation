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
        Schema::create('notion_page_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('notion_page_id')->constrained()->onDelete('cascade');
            $table->foreignId('notion_tag_id')->constrained()->onDelete('cascade');
            
            $table->unique(['notion_page_id', 'notion_tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notion_page_tags');
    }
};
