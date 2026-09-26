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
        Schema::table('about', function (Blueprint $table) {
            $table->string('concept_diagram_mobile_image')->nullable()->after('concept_diagram_image');
            $table->string('concept_bg_mobile_image')->nullable()->after('concept_bg_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about', function (Blueprint $table) {
            $table->dropColumn(['concept_diagram_mobile_image', 'concept_bg_mobile_image']);
        });
    }
};
