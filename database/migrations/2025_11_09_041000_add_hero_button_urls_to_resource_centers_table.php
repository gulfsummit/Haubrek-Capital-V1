<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resource_centers', function (Blueprint $table) {
            $table->string('hero_button_url_en')->nullable()->after('hero_button_text_en');
            $table->string('hero_button_url_ar')->nullable()->after('hero_button_url_en');
        });
    }

    public function down(): void
    {
        Schema::table('resource_centers', function (Blueprint $table) {
            $table->dropColumn(['hero_button_url_en', 'hero_button_url_ar']);
        });
    }
};

