<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * @var array<int, string>
     */
    private array $tables = [
        'homes',
        'abouts',
        'apps',
        'services',
        'contact_us',
        'careers',
        'resource_centers',
        'appointment_pages',
        'pages',
        'tools',
        'governance_services',
        'wealth_services',
        'investment_services',
        'cio_services',
        'teams',
        'privacy_policies',
        'terms_conditions',
        'cookie_policies',
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName) {
            if (! Schema::hasTable($tableName) || Schema::hasColumn($tableName, 'section_visibility')) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) {
                $table->json('section_visibility')->nullable();
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName) {
            if (! Schema::hasTable($tableName) || ! Schema::hasColumn($tableName, 'section_visibility')) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) {
                $table->dropColumn('section_visibility');
            });
        }
    }
};
