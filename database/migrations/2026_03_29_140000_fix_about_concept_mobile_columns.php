<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            if (! Schema::hasColumn('abouts', 'concept_diagram_mobile_image')) {
                $table->string('concept_diagram_mobile_image')->nullable()->after('concept_diagram_image');
            }

            if (! Schema::hasColumn('abouts', 'concept_diagram_mobile_image_alt_en')) {
                $table->string('concept_diagram_mobile_image_alt_en')->nullable()->after('concept_diagram_mobile_image');
            }

            if (! Schema::hasColumn('abouts', 'concept_diagram_mobile_image_alt_ar')) {
                $table->string('concept_diagram_mobile_image_alt_ar')->nullable()->after('concept_diagram_mobile_image_alt_en');
            }

            if (! Schema::hasColumn('abouts', 'concept_bg_mobile_image')) {
                $table->string('concept_bg_mobile_image')->nullable()->after('concept_bg_image');
            }

            if (! Schema::hasColumn('abouts', 'concept_bg_mobile_image_alt_en')) {
                $table->string('concept_bg_mobile_image_alt_en')->nullable()->after('concept_bg_mobile_image');
            }

            if (! Schema::hasColumn('abouts', 'concept_bg_mobile_image_alt_ar')) {
                $table->string('concept_bg_mobile_image_alt_ar')->nullable()->after('concept_bg_mobile_image_alt_en');
            }
        });

        if (Schema::hasColumn('abouts', 'concept_mobile_diagram_image_alt_en')) {
            DB::table('abouts')
                ->whereNull('concept_diagram_mobile_image_alt_en')
                ->update([
                    'concept_diagram_mobile_image_alt_en' => DB::raw('concept_mobile_diagram_image_alt_en'),
                ]);
        }

        if (Schema::hasColumn('abouts', 'concept_mobile_diagram_image_alt_ar')) {
            DB::table('abouts')
                ->whereNull('concept_diagram_mobile_image_alt_ar')
                ->update([
                    'concept_diagram_mobile_image_alt_ar' => DB::raw('concept_mobile_diagram_image_alt_ar'),
                ]);
        }

        if (Schema::hasColumn('abouts', 'concept_mobile_background_image_alt_en')) {
            DB::table('abouts')
                ->whereNull('concept_bg_mobile_image_alt_en')
                ->update([
                    'concept_bg_mobile_image_alt_en' => DB::raw('concept_mobile_background_image_alt_en'),
                ]);
        }

        if (Schema::hasColumn('abouts', 'concept_mobile_background_image_alt_ar')) {
            DB::table('abouts')
                ->whereNull('concept_bg_mobile_image_alt_ar')
                ->update([
                    'concept_bg_mobile_image_alt_ar' => DB::raw('concept_mobile_background_image_alt_ar'),
                ]);
        }
    }

    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            $columns = array_filter([
                Schema::hasColumn('abouts', 'concept_diagram_mobile_image') ? 'concept_diagram_mobile_image' : null,
                Schema::hasColumn('abouts', 'concept_diagram_mobile_image_alt_en') ? 'concept_diagram_mobile_image_alt_en' : null,
                Schema::hasColumn('abouts', 'concept_diagram_mobile_image_alt_ar') ? 'concept_diagram_mobile_image_alt_ar' : null,
                Schema::hasColumn('abouts', 'concept_bg_mobile_image') ? 'concept_bg_mobile_image' : null,
                Schema::hasColumn('abouts', 'concept_bg_mobile_image_alt_en') ? 'concept_bg_mobile_image_alt_en' : null,
                Schema::hasColumn('abouts', 'concept_bg_mobile_image_alt_ar') ? 'concept_bg_mobile_image_alt_ar' : null,
            ]);

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
