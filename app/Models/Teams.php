<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\HasSeoMeta;
use App\Models\Concerns\HasSectionVisibility;

class Teams extends Model
{
    use HasFactory;
    use HasSeoMeta;
    use HasSectionVisibility;

    protected $fillable = [
        // Hero Section
        'hero_title_en',
        'hero_title_ar',
        'hero_subtitle_en',
        'hero_subtitle_ar',
        'hero_desktop_image',
        'hero_desktop_image_alt_en','hero_desktop_image_alt_ar',
        'hero_mobile_image',
        'hero_mobile_image_alt_en','hero_mobile_image_alt_ar',
        'hero_button_text_en',
        'hero_button_text_ar',
        'hero_button_link',
        
        // Leadership Section

        'leadership_background_image',
        'leadership_background_image_alt_en','leadership_background_image_alt_ar',
        'leadership_mobile_background_image',
        'leadership_mobile_background_image_alt_en','leadership_mobile_background_image_alt_ar',
        
        // Directors Section
        'directors_section_title_en',
        'directors_section_title_ar',
        'directors_section_description_en',
        'directors_section_description_ar',
        'directors',
        
        
        // Departments Section
        'departments_title_en',
        'departments_title_ar',
        'departments_subtitle_en',
        'departments_subtitle_ar',
        'departments_description_en',
        'departments_description_ar',
        'departments_background_image',
        'departments_background_image_alt_en','departments_background_image_alt_ar',
        'departments_mobile_background_image',
        'departments_mobile_background_image_alt_en','departments_mobile_background_image_alt_ar',
        
        // Department Tabs
        'investment_advisory_title_en',
        'investment_advisory_title_ar',
        'investment_advisory_description_en',
        'investment_advisory_description_ar',
        'investment_advisory_image','investment_advisory_image_alt_en','investment_advisory_image_alt_ar',
                    'investment_advisory_link_en',
            'investment_advisory_link_ar',
            'investment_advisory_url',
        
        'financial_planning_title_en',
        'financial_planning_title_ar',
        'financial_planning_description_en',
        'financial_planning_description_ar',
        'financial_planning_image','financial_planning_image_alt_en','financial_planning_image_alt_ar',
                    'financial_planning_link_en',
            'financial_planning_link_ar',
            'financial_planning_url',
        
        'research_analysis_title_en',
        'research_analysis_title_ar',
        'research_analysis_description_en',
        'research_analysis_description_ar',
        'research_analysis_image','research_analysis_image_alt_en','research_analysis_image_alt_ar',
                    'research_analysis_link_en',
            'research_analysis_link_ar',
            'research_analysis_url',
        
        'client_relations_title_en',
        'client_relations_title_ar',
        'client_relations_description_en',
        'client_relations_description_ar',
        'client_relations_image','client_relations_image_alt_en','client_relations_image_alt_ar',
                    'client_relations_link_en',
            'client_relations_link_ar',
            'client_relations_url',
        
        'compliance_legal_title_en',
        'compliance_legal_title_ar',
        'compliance_legal_description_en',
        'compliance_legal_description_ar',
        'compliance_legal_image','compliance_legal_image_alt_en','compliance_legal_image_alt_ar',
                    'compliance_legal_link_en',
            'compliance_legal_link_ar',
            'compliance_legal_url',
        
        'operations_admin_title_en',
        'operations_admin_title_ar',
        'operations_admin_description_en',
        'operations_admin_description_ar',
        'operations_admin_image','operations_admin_image_alt_en','operations_admin_image_alt_ar',
                    'operations_admin_link_en',
            'operations_admin_link_ar',
            'operations_admin_url',
        'section_visibility',
    ];

    protected $casts = [
        'directors' => 'array',
        'section_visibility' => 'array',
    ];
}
