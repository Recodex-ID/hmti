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
        Schema::create('competition_information', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('content');
            $table->string('image_path')->nullable();
            $table->string('category');
            $table->string('level'); // local, national, international
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->string('organizer');
            $table->decimal('registration_fee', 10, 2)->nullable();
            $table->datetime('registration_deadline');
            $table->text('rules_regulations');
            $table->text('prizes')->nullable();
            $table->text('requirements');
            $table->string('contact_person');
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->string('website_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_information');
    }
};
