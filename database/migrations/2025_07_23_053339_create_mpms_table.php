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
        Schema::create('mpms', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['komisi-a', 'komisi-b', 'komisi-c', 'burt']);
            $table->string('title');
            $table->text('description');
            $table->json('content')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('attachment_file')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mpms');
    }
};
