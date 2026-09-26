<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            
            // Hero Section
            'hero_slide_1_title_en' => $this->hero_slide_1_title_en,
            'hero_slide_1_title_ar' => $this->hero_slide_1_title_ar,
            'hero_slide_1_subtitle_en' => $this->hero_slide_1_subtitle_en,
            'hero_slide_1_subtitle_ar' => $this->hero_slide_1_subtitle_ar,
            'hero_slide_1_image' => $this->hero_slide_1_image,
            'hero_slide_1_button_text_en' => $this->hero_slide_1_button_text_en,
            'hero_slide_1_button_text_ar' => $this->hero_slide_1_button_text_ar,
            'hero_slide_1_button_link' => $this->hero_slide_1_button_link,
            
            'hero_slide_2_title_en' => $this->hero_slide_2_title_en,
            'hero_slide_2_title_ar' => $this->hero_slide_2_title_ar,
            'hero_slide_2_subtitle_en' => $this->hero_slide_2_subtitle_en,
            'hero_slide_2_subtitle_ar' => $this->hero_slide_2_subtitle_ar,
            'hero_slide_2_image' => $this->hero_slide_2_image,
            'hero_slide_2_button_text_en' => $this->hero_slide_2_button_text_en,
            'hero_slide_2_button_text_ar' => $this->hero_slide_2_button_text_ar,
            'hero_slide_2_button_link' => $this->hero_slide_2_button_link,
            
            'hero_slide_3_title_en' => $this->hero_slide_3_title_en,
            'hero_slide_3_title_ar' => $this->hero_slide_3_title_ar,
            'hero_slide_3_subtitle_en' => $this->hero_slide_3_subtitle_en,
            'hero_slide_3_subtitle_ar' => $this->hero_slide_3_subtitle_ar,
            'hero_slide_3_image' => $this->hero_slide_3_image,
            'hero_slide_3_button_text_en' => $this->hero_slide_3_button_text_en,
            'hero_slide_3_button_text_ar' => $this->hero_slide_3_button_text_ar,
            'hero_slide_3_button_link' => $this->hero_slide_3_button_link,
            
            // How We Can Assist Section
            'assist_title_en' => $this->assist_title_en,
            'assist_title_ar' => $this->assist_title_ar,
            'assist_description_en' => $this->assist_description_en,
            'assist_description_ar' => $this->assist_description_ar,
            'assist_image' => $this->assist_image,
            'services' => is_string($this->services) ? json_decode($this->services, true) : $this->services,
            
            // Diversified Programs Section
            'diversified_title_en' => $this->diversified_title_en,
            'diversified_title_ar' => $this->diversified_title_ar,
            'diversified_description_en' => $this->diversified_description_en,
            'diversified_description_ar' => $this->diversified_description_ar,
            'diversified_desktop_image' => $this->diversified_desktop_image,
            'diversified_mobile_image' => $this->diversified_mobile_image,
            'diversified_button_text_en' => $this->diversified_button_text_en,
            'diversified_button_text_ar' => $this->diversified_button_text_ar,
            'diversified_button_link' => $this->diversified_button_link,
            
            // Board of Directors Section
            'directors_title_en' => $this->directors_title_en,
            'directors_title_ar' => $this->directors_title_ar,
            'directors_description_en' => $this->directors_description_en,
            'directors_description_ar' => $this->directors_description_ar,
            'directors_background_image' => $this->directors_background_image,
            'directors' => is_string($this->directors) ? json_decode($this->directors, true) : $this->directors,
            
            // Proven Track Record Section
            'track_record_title_en' => $this->track_record_title_en,
            'track_record_title_ar' => $this->track_record_title_ar,
            'track_record_description_en' => $this->track_record_description_en,
            'track_record_description_ar' => $this->track_record_description_ar,
            'track_record_background_image' => $this->track_record_background_image,
            'track_record_metrics' => is_string($this->track_record_metrics) ? json_decode($this->track_record_metrics, true) : $this->track_record_metrics,
            
            // Road Map Section
            'roadmap_title_en' => $this->roadmap_title_en,
            'roadmap_title_ar' => $this->roadmap_title_ar,
            'roadmap_steps' => is_string($this->roadmap_steps) ? json_decode($this->roadmap_steps, true) : $this->roadmap_steps,
            'roadmap_mobile_image' => $this->roadmap_mobile_image,
            'roadmap_button_text_en' => $this->roadmap_button_text_en,
            'roadmap_button_text_ar' => $this->roadmap_button_text_ar,
            'roadmap_button_link' => $this->roadmap_button_link,
            
            // Insights Section
            'insights_title_en' => $this->insights_title_en,
            'insights_title_ar' => $this->insights_title_ar,
            'insights_sections' => is_string($this->insights_sections) ? json_decode($this->insights_sections, true) : $this->insights_sections,
            
            // Ready To Start Growing Section
            'cta_title_en' => $this->cta_title_en,
            'cta_title_ar' => $this->cta_title_ar,
            'cta_description_en' => $this->cta_description_en,
            'cta_description_ar' => $this->cta_description_ar,
            'cta_background_image' => $this->cta_background_image,
            'cta_button_1_text_en' => $this->cta_button_1_text_en,
            'cta_button_1_text_ar' => $this->cta_button_1_text_ar,
            'cta_button_1_link' => $this->cta_button_1_link,
            'cta_button_2_text_en' => $this->cta_button_2_text_en,
            'cta_button_2_text_ar' => $this->cta_button_2_text_ar,
            'cta_button_2_link' => $this->cta_button_2_link,
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
