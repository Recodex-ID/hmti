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
        Schema::create('partnerships', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['benchmark', 'media_partner', 'mc_moderator']);
            $table->string('title');
            $table->text('description');
            $table->json('content')->nullable(); // Dynamic content for each type
            $table->json('contact_info')->nullable(); // Contact information
            $table->string('banner')->nullable(); // Banner image
            $table->string('document')->nullable(); // Document/PDF file
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnerships');
    }
};
