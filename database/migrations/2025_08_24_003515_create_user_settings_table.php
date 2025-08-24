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
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->unsignedTinyInteger('randomness_priority')->default(50);
            $table->unsignedSmallInteger('to_learn_weight')->default(1);
            $table->unsignedSmallInteger('learning_weight')->default(1);
            $table->unsignedSmallInteger('reviewing_weight')->default(1);
            $table->unsignedSmallInteger('solid_concept_weight')->default(1);
            $table->unsignedTinyInteger('max_notifications_per_day')->default(5);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_settings');
    }
};
