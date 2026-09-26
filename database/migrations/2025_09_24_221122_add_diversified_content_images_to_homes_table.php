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
            $table->string('diversified_content_desktop_image')->nullable()->after('diversified_mobile_image');
            $table->string('diversified_content_mobile_image')->nullable()->after('diversified_content_desktop_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->dropColumn(['diversified_content_desktop_image', 'diversified_content_mobile_image']);
        });
    }
};