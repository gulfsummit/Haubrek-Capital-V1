<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('apps', function (Blueprint $table) {
            if (! Schema::hasColumn('apps', 'bottom_mobile_image')) {
                $table->string('bottom_mobile_image')->nullable()->after('bottom_mobile_background_image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('apps', function (Blueprint $table) {
            if (Schema::hasColumn('apps', 'bottom_mobile_image')) {
                $table->dropColumn('bottom_mobile_image');
            }
        });
    }
};

