<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (! Schema::hasColumn('blogs', 'category_ar')) {
                $table->string('category_ar')->nullable()->after('category');
            }
        });

        Schema::table('case_studies', function (Blueprint $table) {
            if (! Schema::hasColumn('case_studies', 'category_ar')) {
                $table->string('category_ar')->nullable()->after('category');
            }
        });

        DB::table('blogs')
            ->whereNull('category_ar')
            ->update(['category_ar' => DB::raw('category')]);

        DB::table('case_studies')
            ->whereNull('category_ar')
            ->update(['category_ar' => DB::raw('category')]);
    }

    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            if (Schema::hasColumn('blogs', 'category_ar')) {
                $table->dropColumn('category_ar');
            }
        });

        Schema::table('case_studies', function (Blueprint $table) {
            if (Schema::hasColumn('case_studies', 'category_ar')) {
                $table->dropColumn('category_ar');
            }
        });
    }
};
