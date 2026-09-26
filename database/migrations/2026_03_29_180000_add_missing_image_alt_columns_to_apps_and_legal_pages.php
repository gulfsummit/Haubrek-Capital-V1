<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->addAltColumns('apps', 'bottom_mobile_image');
        $this->addAltColumns('privacy_policies', 'hero_desktop_image');
        $this->addAltColumns('privacy_policies', 'hero_mobile_image');
        $this->addAltColumns('terms_conditions', 'hero_desktop_image');
        $this->addAltColumns('terms_conditions', 'hero_mobile_image');
        $this->addAltColumns('cookie_policies', 'hero_desktop_image');
        $this->addAltColumns('cookie_policies', 'hero_mobile_image');
    }

    public function down(): void
    {
        $this->dropAltColumns('apps', 'bottom_mobile_image');
        $this->dropAltColumns('privacy_policies', 'hero_desktop_image');
        $this->dropAltColumns('privacy_policies', 'hero_mobile_image');
        $this->dropAltColumns('terms_conditions', 'hero_desktop_image');
        $this->dropAltColumns('terms_conditions', 'hero_mobile_image');
        $this->dropAltColumns('cookie_policies', 'hero_desktop_image');
        $this->dropAltColumns('cookie_policies', 'hero_mobile_image');
    }

    protected function addAltColumns(string $tableName, string $column): void
    {
        if (! Schema::hasTable($tableName) || ! Schema::hasColumn($tableName, $column) || Schema::hasColumn($tableName, "{$column}_alt_en")) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($column) {
            $table->text("{$column}_alt_en")->nullable()->after($column);
            $table->text("{$column}_alt_ar")->nullable()->after("{$column}_alt_en");
        });
    }

    protected function dropAltColumns(string $tableName, string $column): void
    {
        if (! Schema::hasTable($tableName) || ! Schema::hasColumn($tableName, "{$column}_alt_en")) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($column) {
            $table->dropColumn(["{$column}_alt_en", "{$column}_alt_ar"]);
        });
    }
};
