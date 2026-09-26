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
        Schema::table('wealth_services', function (Blueprint $table) {
            $table->string('approach_mobile_background_image')->nullable()->after('approach_background_image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wealth_services', function (Blueprint $table) {
            $table->dropColumn('approach_mobile_background_image');
        });
    }
};
