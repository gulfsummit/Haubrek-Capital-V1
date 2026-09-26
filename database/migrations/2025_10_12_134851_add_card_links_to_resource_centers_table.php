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
        Schema::table('resource_centers', function (Blueprint $table) {
            $table->string('blog_card_link')->nullable()->after('blog_card_image');
            $table->string('case_studies_card_link')->nullable()->after('case_studies_card_image');
            $table->string('tools_card_link')->nullable()->after('tools_card_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resource_centers', function (Blueprint $table) {
            $table->dropColumn(['blog_card_link', 'case_studies_card_link', 'tools_card_link']);
        });
    }
};
