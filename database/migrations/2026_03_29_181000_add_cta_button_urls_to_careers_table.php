<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            if (! Schema::hasColumn('careers', 'cta_button_1_url')) {
                $table->string('cta_button_1_url')->nullable()->after('cta_button_1_text_ar');
            }

            if (! Schema::hasColumn('careers', 'cta_button_2_url')) {
                $table->string('cta_button_2_url')->nullable()->after('cta_button_2_text_ar');
            }
        });
    }

    public function down(): void
    {
        Schema::table('careers', function (Blueprint $table) {
            $columns = [];

            if (Schema::hasColumn('careers', 'cta_button_1_url')) {
                $columns[] = 'cta_button_1_url';
            }

            if (Schema::hasColumn('careers', 'cta_button_2_url')) {
                $columns[] = 'cta_button_2_url';
            }

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
