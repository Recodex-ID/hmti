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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('definition');
            $table->text('position_role');
            $table->text('vision');
            $table->json('mission');
            $table->string('structural'); // organizational structure image
            $table->string('banner')->nullable(); // banner image
            $table->string('link_youtube')->nullable(); // YouTube link
            $table->string('ad_art')->nullable(); // PDF file
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
