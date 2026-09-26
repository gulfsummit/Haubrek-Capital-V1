<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->boolean('cta_section_enabled')
                ->default(true)
                ->after('insights_sections');
        });
    }

    public function down(): void
    {
        Schema::table('homes', function (Blueprint $table) {
            $table->dropColumn('cta_section_enabled');
        });
    }
};
