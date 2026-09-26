<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resource_centers', function (Blueprint $table) {
            $table->string('cta_button_1_url_en')->nullable()->after('cta_button_1_text_en');
            $table->string('cta_button_1_url_ar')->nullable()->after('cta_button_1_url_en');
            $table->string('cta_button_2_url_en')->nullable()->after('cta_button_2_text_en');
            $table->string('cta_button_2_url_ar')->nullable()->after('cta_button_2_url_en');
        });
    }

    public function down(): void
    {
        Schema::table('resource_centers', function (Blueprint $table) {
            $table->dropColumn([
                'cta_button_1_url_en',
                'cta_button_1_url_ar',
                'cta_button_2_url_en',
                'cta_button_2_url_ar',
            ]);
        });
    }
};

