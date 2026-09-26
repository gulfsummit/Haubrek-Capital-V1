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
        Schema::table('homes', function (Blueprint $table) {
            $table->string('assist_button_text_en')->default('OUR SERVICES')->after('assist_image');
            $table->string('assist_button_text_ar')->default('خدماتنا')->after('assist_button_text_en');
            $table->string('assist_button_link')->default('services')->after('assist_button_text_ar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->dropColumn(['assist_button_text_en', 'assist_button_text_ar', 'assist_button_link']);
        });
    }
};
