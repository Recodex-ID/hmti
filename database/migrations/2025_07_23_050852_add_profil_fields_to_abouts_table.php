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
        Schema::table('abouts', function (Blueprint $table) {
            $table->string('logo_guideline')->nullable()->after('ad_art'); // PDF untuk panduan logo
            $table->string('grand_design')->nullable()->after('logo_guideline'); // PDF grand design
            $table->json('anniversary_content')->nullable()->after('grand_design'); // Konten HUT HMTI
            $table->json('history_content')->nullable()->after('anniversary_content'); // Konten sejarah HMTI
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $table->dropColumn(['logo_guideline', 'grand_design', 'anniversary_content', 'history_content']);
        });
    }
};
