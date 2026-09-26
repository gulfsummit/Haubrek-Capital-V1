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
        Schema::table('apps', function (Blueprint $table) {
            $table->string('bottom_mobile_background_image')->nullable();
            $table->string('connect_mobile_background_image')->nullable();
            $table->string('docs_mobile_background_image')->nullable();
            $table->string('knowledge_mobile_background_image')->nullable();
            $table->string('security_mobile_background_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->dropColumn([
                'bottom_mobile_background_image',
                'connect_mobile_background_image',
                'docs_mobile_background_image',
                'knowledge_mobile_background_image',
                'security_mobile_background_image'
            ]);
        });
    }
};