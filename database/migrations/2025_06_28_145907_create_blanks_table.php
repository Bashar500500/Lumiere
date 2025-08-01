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
        Schema::create('blanks', function (Blueprint $table) {
            $table->id();
            $table->json('correct_answers');
            $table->integer('points');
            $table->boolean('case_sensitive');
            $table->boolean('exact_match');
            $table->string('hint')->nullable();
            $table->morphs('blankable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blanks');
    }
};
