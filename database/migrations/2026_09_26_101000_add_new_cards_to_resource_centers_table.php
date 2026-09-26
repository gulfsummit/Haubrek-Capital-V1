<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resource_centers', function (Blueprint $table) {
            // White Papers card
            $table->string('white_papers_card_title_en')->nullable()->after('tools_card_enabled');
            $table->string('white_papers_card_title_ar')->nullable();
            $table->string('white_papers_card_image')->nullable();
            $table->string('white_papers_card_image_alt_en')->nullable();
            $table->string('white_papers_card_image_alt_ar')->nullable();
            $table->string('white_papers_card_link')->nullable();
            $table->boolean('white_papers_card_enabled')->default(true);

            // CIO Flash card
            $table->string('cio_flash_card_title_en')->nullable();
            $table->string('cio_flash_card_title_ar')->nullable();
            $table->string('cio_flash_card_image')->nullable();
            $table->string('cio_flash_card_image_alt_en')->nullable();
            $table->string('cio_flash_card_image_alt_ar')->nullable();
            $table->string('cio_flash_card_link')->nullable();
            $table->boolean('cio_flash_card_enabled')->default(true);

            // Monday Window card
            $table->string('monday_window_card_title_en')->nullable();
            $table->string('monday_window_card_title_ar')->nullable();
            $table->string('monday_window_card_image')->nullable();
            $table->string('monday_window_card_image_alt_en')->nullable();
            $table->string('monday_window_card_image_alt_ar')->nullable();
            $table->string('monday_window_card_link')->nullable();
            $table->boolean('monday_window_card_enabled')->default(true);

            // Research card
            $table->string('research_card_title_en')->nullable();
            $table->string('research_card_title_ar')->nullable();
            $table->string('research_card_image')->nullable();
            $table->string('research_card_image_alt_en')->nullable();
            $table->string('research_card_image_alt_ar')->nullable();
            $table->string('research_card_link')->nullable();
            $table->boolean('research_card_enabled')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('resource_centers', function (Blueprint $table) {
            $table->dropColumn([
                'white_papers_card_title_en', 'white_papers_card_title_ar',
                'white_papers_card_image', 'white_papers_card_image_alt_en', 'white_papers_card_image_alt_ar',
                'white_papers_card_link', 'white_papers_card_enabled',
                'cio_flash_card_title_en', 'cio_flash_card_title_ar',
                'cio_flash_card_image', 'cio_flash_card_image_alt_en', 'cio_flash_card_image_alt_ar',
                'cio_flash_card_link', 'cio_flash_card_enabled',
                'monday_window_card_title_en', 'monday_window_card_title_ar',
                'monday_window_card_image', 'monday_window_card_image_alt_en', 'monday_window_card_image_alt_ar',
                'monday_window_card_link', 'monday_window_card_enabled',
                'research_card_title_en', 'research_card_title_ar',
                'research_card_image', 'research_card_image_alt_en', 'research_card_image_alt_ar',
                'research_card_link', 'research_card_enabled',
            ]);
        });
    }
};
