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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title_en')->nullable();
            $table->string('hero_title_ar')->nullable();
            $table->text('hero_subtitle_en')->nullable();
            $table->text('hero_subtitle_ar')->nullable();
            $table->string('hero_desktop_image')->nullable();
            $table->string('hero_mobile_image')->nullable();
            $table->string('hero_button_text_en')->nullable();
            $table->string('hero_button_text_ar')->nullable();
            $table->string('hero_button_link')->nullable();
            
            // Leadership Section
            $table->string('leadership_title_en')->nullable();
            $table->string('leadership_title_ar')->nullable();
            $table->longText('leadership_description_en')->nullable();
            $table->longText('leadership_description_ar')->nullable();
            $table->string('leadership_background_image')->nullable();
            $table->string('leadership_mobile_background_image')->nullable();
            
            // Directors Section
            $table->string('directors_section_title_en')->nullable();
            $table->string('directors_section_title_ar')->nullable();
            $table->longText('directors_section_description_en')->nullable();
            $table->longText('directors_section_description_ar')->nullable();
            
            // Directors (JSON)
            $table->json('directors')->nullable();
            
            // Departments Section
            $table->string('departments_title_en')->nullable();
            $table->string('departments_title_ar')->nullable();
            $table->longText('departments_description_en')->nullable();
            $table->longText('departments_description_ar')->nullable();
            $table->string('departments_background_image')->nullable();
            $table->string('departments_mobile_background_image')->nullable();
            
            // Department Tabs
            $table->string('investment_advisory_title_en')->nullable();
            $table->string('investment_advisory_title_ar')->nullable();
            $table->longText('investment_advisory_description_en')->nullable();
            $table->longText('investment_advisory_description_ar')->nullable();
            $table->string('investment_advisory_image')->nullable();
            $table->string('investment_advisory_link_en')->nullable();
            $table->string('investment_advisory_link_ar')->nullable();
            
            $table->string('financial_planning_title_en')->nullable();
            $table->string('financial_planning_title_ar')->nullable();
            $table->longText('financial_planning_description_en')->nullable();
            $table->longText('financial_planning_description_ar')->nullable();
            $table->string('financial_planning_image')->nullable();
            $table->string('financial_planning_link_en')->nullable();
            $table->string('financial_planning_link_ar')->nullable();
            
            $table->string('research_analysis_title_en')->nullable();
            $table->string('research_analysis_title_ar')->nullable();
            $table->longText('research_analysis_description_en')->nullable();
            $table->longText('research_analysis_description_ar')->nullable();
            $table->string('research_analysis_image')->nullable();
            $table->string('research_analysis_link_en')->nullable();
            $table->string('research_analysis_link_ar')->nullable();
            
            $table->string('client_relations_title_en')->nullable();
            $table->string('client_relations_title_ar')->nullable();
            $table->longText('client_relations_description_en')->nullable();
            $table->longText('client_relations_description_ar')->nullable();
            $table->string('client_relations_image')->nullable();
            $table->string('client_relations_link_en')->nullable();
            $table->string('client_relations_link_ar')->nullable();
            
            $table->string('compliance_legal_title_en')->nullable();
            $table->string('compliance_legal_title_ar')->nullable();
            $table->longText('compliance_legal_description_en')->nullable();
            $table->longText('compliance_legal_description_ar')->nullable();
            $table->string('compliance_legal_image')->nullable();
            $table->string('compliance_legal_link_en')->nullable();
            $table->string('compliance_legal_link_ar')->nullable();
            
            $table->string('operations_admin_title_en')->nullable();
            $table->string('operations_admin_title_ar')->nullable();
            $table->longText('operations_admin_description_en')->nullable();
            $table->longText('operations_admin_description_ar')->nullable();
            $table->string('operations_admin_image')->nullable();
            $table->string('operations_admin_link_en')->nullable();
            $table->string('operations_admin_link_ar')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
