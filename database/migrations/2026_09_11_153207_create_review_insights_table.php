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
        Schema::create('review_insights', function (Blueprint $table) {
            $table->id();
            $table->string('review_id');
            $table->string('sentiment');
            $table->string('headline_quote');
            $table->text('linkedin_post');
            $table->text('x_post');
            $table->text('suggested_reply');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('review_insights');
    }
};
