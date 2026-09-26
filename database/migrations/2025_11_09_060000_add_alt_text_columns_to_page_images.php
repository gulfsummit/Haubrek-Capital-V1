<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    protected array $tableImageColumns = [
        'homes' => [
            'hero_slide_1_image',
            'hero_slide_2_image',
            'hero_slide_3_image',
            'assist_image',
            'diversified_desktop_image',
            'diversified_mobile_image',
            'diversified_content_desktop_image',
            'diversified_content_mobile_image',
            'directors_background_image',
            'track_record_background_image',
            'track_record_icon',
            'roadmap_mobile_image',
            'cta_background_image',
        ],
        'teams' => [
            'hero_desktop_image',
            'hero_mobile_image',
            'leadership_background_image',
            'leadership_mobile_background_image',
            'departments_background_image',
            'departments_mobile_background_image',
            'investment_advisory_image',
            'financial_planning_image',
            'research_analysis_image',
            'client_relations_image',
            'compliance_legal_image',
            'operations_admin_image',
        ],
        'apps' => [
            'hero_background_image',
            'hero_mobile_background_image',
            'promo_background_image',
            'promo_mobile_background_image',
            'promo_mobile_1_image',
            'promo_mobile_2_image',
            'promo_mobile_3_image',
            'bottom_background_image',
            'bottom_mobile_background_image',
            'connect_background_image',
            'connect_mobile_background_image',
            'connect_mobile_image',
            'docs_background_image',
            'docs_mobile_background_image',
            'docs_mobile_image',
            'knowledge_background_image',
            'knowledge_mobile_background_image',
            'knowledge_mobile_image',
            'security_background_image',
            'security_mobile_background_image',
            'security_mobile_image',
            'cta_background_image',
        ],
        'services' => [
            'hero_background_image',
            'hero_mobile_background_image',
            'governance_background',
            'governance_mobile_background',
            'governance_image',
            'governance_mobile_image',
            'wealth_background',
            'wealth_mobile_background_image',
            'wealth_image',
            'wealth_mobile_image',
            'investment_background',
            'investment_mobile_background',
            'investment_image',
            'investment_mobile_image',
            'cio_background',
            'cio_mobile_background_image',
            'cio_image',
            'cio_mobile_image',
            'roadmap_mobile_image',
            'cta_background_image',
        ],
        'governance_services' => [
            'hero_desktop_image',
            'hero_mobile_image',
            'approach_background_image',
            'approach_mobile_background_image',
            'cta_background_image',
        ],
        'wealth_services' => [
            'hero_desktop_image',
            'hero_mobile_image',
            'approach_background_image',
            'approach_mobile_background_image',
            'cta_background_image',
        ],
        'investment_services' => [
            'hero_desktop_image',
            'hero_mobile_image',
            'approach_background_image',
            'approach_mobile_background_image',
            'cta_background_image',
        ],
        'cio_services' => [
            'hero_desktop_image',
            'hero_mobile_image',
            'approach_background_image',
            'approach_mobile_background_image',
            'cta_background_image',
        ],
        'resource_centers' => [
            'hero_desktop_image',
            'hero_mobile_image',
            'blog_card_image',
            'case_studies_card_image',
            'tools_card_image',
            'cta_background_image',
        ],
        'contact_us' => [
            'hero_desktop_image',
            'hero_mobile_image',
        ],
        'appointment_pages' => [
            'hero_background_desktop',
            'hero_background_mobile',
            'ready_background_image',
        ],
        'tools' => [
            'hero_desktop_image',
            'hero_mobile_image',
            'profile_image',
            'features_background_image',
            'form_background_image',
        ],
        'abouts' => [
            'hero_desktop_image',
            'hero_mobile_image',
            'concept_diagram_image',
            'concept_diagram_image_ar',
            'concept_diagram_mobile_image',
            'concept_diagram_mobile_image_ar',
            'concept_bg_image',
            'concept_bg_mobile_image',
            'approach_bg_image',
            'approach_mobile_bg_image',
        ],
        'careers' => [
            'hero_desktop_image',
            'hero_mobile_image',
            'why_work_bg_image',
            'cta_background_image',
        ],
    ];

    public function up(): void
    {
        foreach ($this->tableImageColumns as $tableName => $columns) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName, $columns) {
                foreach ($columns as $column) {
                    if (Schema::hasColumn($tableName, $column) && ! Schema::hasColumn($tableName, "{$column}_alt_en")) {
                        $table->text("{$column}_alt_en")->nullable()->after($column);
                        $table->text("{$column}_alt_ar")->nullable()->after("{$column}_alt_en");
                    }
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tableImageColumns as $tableName => $columns) {
            Schema::table($tableName, function (Blueprint $table) use ($tableName, $columns) {
                foreach ($columns as $column) {
                    if (Schema::hasColumn($tableName, "{$column}_alt_en")) {
                        $table->dropColumn(["{$column}_alt_en", "{$column}_alt_ar"]);
                    }
                }
            });
        }
    }
};

