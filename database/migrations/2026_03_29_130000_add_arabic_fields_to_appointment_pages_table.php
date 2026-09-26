<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointment_pages', function (Blueprint $table) {
            $table->string('hero_title_ar')->nullable()->after('hero_title');
            $table->text('hero_subtitle_ar')->nullable()->after('hero_subtitle');
            $table->string('ready_title_ar')->nullable()->after('ready_title');
            $table->text('ready_description_ar')->nullable()->after('ready_description');
            $table->string('ready_primary_label_ar')->nullable()->after('ready_primary_label');
            $table->string('ready_secondary_label_ar')->nullable()->after('ready_secondary_label');
        });
    }

    public function down(): void
    {
        Schema::table('appointment_pages', function (Blueprint $table) {
            $table->dropColumn([
                'hero_title_ar',
                'hero_subtitle_ar',
                'ready_title_ar',
                'ready_description_ar',
                'ready_primary_label_ar',
                'ready_secondary_label_ar',
            ]);
        });
    }
};
