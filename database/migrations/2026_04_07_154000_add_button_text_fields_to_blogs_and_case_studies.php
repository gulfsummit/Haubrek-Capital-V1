<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->text('button_text_en')->nullable()->after('category_ar');
            $table->text('button_text_ar')->nullable()->after('button_text_en');
        });

        Schema::table('case_studies', function (Blueprint $table) {
            $table->text('button_text_en')->nullable()->after('category_ar');
            $table->text('button_text_ar')->nullable()->after('button_text_en');
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn([
                'button_text_en',
                'button_text_ar',
            ]);
        });

        Schema::table('case_studies', function (Blueprint $table) {
            $table->dropColumn([
                'button_text_en',
                'button_text_ar',
            ]);
        });
    }
};
