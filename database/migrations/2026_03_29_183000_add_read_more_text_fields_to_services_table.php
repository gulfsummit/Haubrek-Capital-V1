<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            if (! Schema::hasColumn('services', 'governance_read_more_text_en')) {
                $table->string('governance_read_more_text_en')->nullable()->after('governance_mobile_image_alt_ar');
                $table->string('governance_read_more_text_ar')->nullable()->after('governance_read_more_text_en');
            }

            if (! Schema::hasColumn('services', 'wealth_read_more_text_en')) {
                $table->string('wealth_read_more_text_en')->nullable()->after('wealth_mobile_image_alt_ar');
                $table->string('wealth_read_more_text_ar')->nullable()->after('wealth_read_more_text_en');
            }

            if (! Schema::hasColumn('services', 'investment_read_more_text_en')) {
                $table->string('investment_read_more_text_en')->nullable()->after('investment_mobile_image_alt_ar');
                $table->string('investment_read_more_text_ar')->nullable()->after('investment_read_more_text_en');
            }

            if (! Schema::hasColumn('services', 'cio_read_more_text_en')) {
                $table->string('cio_read_more_text_en')->nullable()->after('cio_mobile_image_alt_ar');
                $table->string('cio_read_more_text_ar')->nullable()->after('cio_read_more_text_en');
            }
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $columns = [];

            foreach ([
                'governance_read_more_text_en',
                'governance_read_more_text_ar',
                'wealth_read_more_text_en',
                'wealth_read_more_text_ar',
                'investment_read_more_text_en',
                'investment_read_more_text_ar',
                'cio_read_more_text_en',
                'cio_read_more_text_ar',
            ] as $column) {
                if (Schema::hasColumn('services', $column)) {
                    $columns[] = $column;
                }
            }

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
