<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->string('author_en')->nullable()->after('sort_order');
            $table->string('author_ar')->nullable()->after('author_en');
            $table->date('publication_date')->nullable()->after('author_ar');
            $table->integer('reading_time')->nullable()->after('publication_date'); // in minutes
            $table->json('external_sources')->nullable()->after('reading_time'); // [{label_en, label_ar, url}]
            $table->unsignedBigInteger('related_white_paper_id')->nullable()->after('external_sources');
            $table->unsignedBigInteger('related_cio_flash_id')->nullable()->after('related_white_paper_id');
            $table->unsignedBigInteger('related_monday_window_id')->nullable()->after('related_cio_flash_id');
            $table->boolean('is_featured')->default(false)->after('related_monday_window_id');

            $table->foreign('related_white_paper_id')->references('id')->on('white_papers')->nullOnDelete();
            $table->foreign('related_cio_flash_id')->references('id')->on('cio_flash')->nullOnDelete();
            $table->foreign('related_monday_window_id')->references('id')->on('monday_windows')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropForeign(['related_white_paper_id']);
            $table->dropForeign(['related_cio_flash_id']);
            $table->dropForeign(['related_monday_window_id']);
            $table->dropColumn([
                'author_en',
                'author_ar',
                'publication_date',
                'reading_time',
                'external_sources',
                'related_white_paper_id',
                'related_cio_flash_id',
                'related_monday_window_id',
                'is_featured',
            ]);
        });
    }
};
