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
            $table->boolean('blog_card_enabled')->default(true)->after('blog_card_link');
            $table->boolean('case_studies_card_enabled')->default(true)->after('case_studies_card_link');
            $table->boolean('tools_card_enabled')->default(true)->after('tools_card_link');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resource_centers', function (Blueprint $table) {
            $table->dropColumn([
                'blog_card_enabled',
                'case_studies_card_enabled',
                'tools_card_enabled',
            ]);
        });
    }
};

