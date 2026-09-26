<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TeamsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            
            // Hero Section
            'hero_title_en' => $this->hero_title_en,
            'hero_title_ar' => $this->hero_title_ar,
            'hero_subtitle_en' => $this->hero_subtitle_en,
            'hero_subtitle_ar' => $this->hero_subtitle_ar,
            'hero_desktop_image' => $this->hero_desktop_image,
            'hero_mobile_image' => $this->hero_mobile_image,
            'hero_button_text_en' => $this->hero_button_text_en,
            'hero_button_text_ar' => $this->hero_button_text_ar,
            'hero_button_link' => $this->hero_button_link,
            
            // Leadership Section

            'leadership_background_image' => $this->leadership_background_image,
            'leadership_mobile_background_image' => $this->leadership_mobile_background_image,
            
            // Directors Section
            'directors_section_title_en' => $this->directors_section_title_en,
            'directors_section_title_ar' => $this->directors_section_title_ar,
            'directors_section_description_en' => $this->directors_section_description_en,
            'directors_section_description_ar' => $this->directors_section_description_ar,
            
            // Directors Popup Content
            'directors_popup_experience_title_en' => $this->directors_popup_experience_title_en,
            'directors_popup_experience_title_ar' => $this->directors_popup_experience_title_ar,
            'directors_popup_current_title_en' => $this->directors_popup_current_title_en,
            'directors_popup_current_title_ar' => $this->directors_popup_current_title_ar,
            'directors_popup_previous_title_en' => $this->directors_popup_previous_title_en,
            'directors_popup_previous_title_ar' => $this->directors_popup_previous_title_ar,
            'directors_popup_education_title_en' => $this->directors_popup_education_title_en,
            'directors_popup_education_title_ar' => $this->directors_popup_education_title_ar,
            
            // Directors
            'directors' => $this->directors,
            
            // Departments Section
            'departments_title_en' => $this->departments_title_en,
            'departments_title_ar' => $this->departments_title_ar,
            'departments_description_en' => $this->departments_description_en,
            'departments_description_ar' => $this->departments_description_ar,
            'departments_background_image' => $this->departments_background_image,
            'departments_mobile_background_image' => $this->departments_mobile_background_image,
            
            // Department Tabs
            'investment_advisory_title_en' => $this->investment_advisory_title_en,
            'investment_advisory_title_ar' => $this->investment_advisory_title_ar,
            'investment_advisory_description_en' => $this->investment_advisory_description_en,
            'investment_advisory_description_ar' => $this->investment_advisory_description_ar,
            'investment_advisory_image' => $this->investment_advisory_image,
            'investment_advisory_link_en' => $this->investment_advisory_link_en,
            'investment_advisory_link_ar' => $this->investment_advisory_link_ar,
            'investment_advisory_url' => $this->investment_advisory_url,
            
            'financial_planning_title_en' => $this->financial_planning_title_en,
            'financial_planning_title_ar' => $this->financial_planning_title_ar,
            'financial_planning_description_en' => $this->financial_planning_description_en,
            'financial_planning_description_ar' => $this->financial_planning_description_ar,
            'financial_planning_image' => $this->financial_planning_image,
            'financial_planning_link_en' => $this->financial_planning_link_en,
            'financial_planning_link_ar' => $this->financial_planning_link_ar,
            'financial_planning_url' => $this->financial_planning_url,
            
            'research_analysis_title_en' => $this->research_analysis_title_en,
            'research_analysis_title_ar' => $this->research_analysis_title_ar,
            'research_analysis_description_en' => $this->research_analysis_description_en,
            'research_analysis_description_ar' => $this->research_analysis_description_ar,
            'research_analysis_image' => $this->research_analysis_image,
            'research_analysis_link_en' => $this->research_analysis_link_en,
            'research_analysis_link_ar' => $this->research_analysis_link_ar,
            'research_analysis_url' => $this->research_analysis_url,
            
            'client_relations_title_en' => $this->client_relations_title_en,
            'client_relations_title_ar' => $this->client_relations_title_ar,
            'client_relations_description_en' => $this->client_relations_description_en,
            'client_relations_description_ar' => $this->client_relations_description_ar,
            'client_relations_image' => $this->client_relations_image,
            'client_relations_link_en' => $this->client_relations_link_en,
            'client_relations_link_ar' => $this->client_relations_link_ar,
            'client_relations_url' => $this->client_relations_url,
            
            'compliance_legal_title_en' => $this->compliance_legal_title_en,
            'compliance_legal_title_ar' => $this->compliance_legal_title_ar,
            'compliance_legal_description_en' => $this->compliance_legal_description_en,
            'compliance_legal_description_ar' => $this->compliance_legal_description_ar,
            'compliance_legal_image' => $this->compliance_legal_image,
            'compliance_legal_link_en' => $this->compliance_legal_link_en,
            'compliance_legal_link_ar' => $this->compliance_legal_link_ar,
            'compliance_legal_url' => $this->compliance_legal_url,
            
            'operations_admin_title_en' => $this->operations_admin_title_en,
            'operations_admin_title_ar' => $this->operations_admin_title_ar,
            'operations_admin_description_en' => $this->operations_admin_description_en,
            'operations_admin_description_ar' => $this->operations_admin_description_ar,
            'operations_admin_image' => $this->operations_admin_image,
            'operations_admin_link_en' => $this->operations_admin_link_en,
            'operations_admin_link_ar' => $this->operations_admin_link_ar,
            'operations_admin_url' => $this->operations_admin_url,
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
