<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class ServicesResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'hero_title_en' => $this->hero_title_en,
            'hero_title_ar' => $this->hero_title_ar,
            'hero_subtitle_en' => $this->hero_subtitle_en,
            'hero_subtitle_ar' => $this->hero_subtitle_ar,
            'hero_background_image' => $this->hero_background_image,
            'hero_mobile_background_image' => $this->hero_mobile_background_image,
            'hero_button_text_en' => $this->hero_button_text_en,
            'hero_button_text_ar' => $this->hero_button_text_ar,
            'hero_button_link' => $this->hero_button_link,
            'description_title_en' => $this->description_title_en,
            'description_title_ar' => $this->description_title_ar,
            'description_en' => $this->description_en,
            'description_ar' => $this->description_ar,
            'services_list' => $this->services_list,
            'sliders_card' => $this->sliders_card,
            'approaches_tool' => $this->approaches_tool,
            'steps_start_card' => $this->steps_start_card,
            
            // Governance Advisory Section
            'governance_title_en' => $this->governance_title_en,
            'governance_title_ar' => $this->governance_title_ar,
            'governance_description_en' => $this->governance_description_en,
            'governance_description_ar' => $this->governance_description_ar,
            'governance_background' => $this->governance_background,
            'governance_mobile_background' => $this->governance_mobile_background,
            'governance_image' => $this->governance_image,
            'governance_mobile_image' => $this->governance_mobile_image,
            'governance_read_more_text_en' => $this->governance_read_more_text_en,
            'governance_read_more_text_ar' => $this->governance_read_more_text_ar,
            'governance_link' => $this->governance_link,
            
            // Wealth Planning Section
            'wealth_title_en' => $this->wealth_title_en,
            'wealth_title_ar' => $this->wealth_title_ar,
            'wealth_description_en' => $this->wealth_description_en,
            'wealth_description_ar' => $this->wealth_description_ar,
            'wealth_background' => $this->wealth_background,
            'wealth_mobile_background_image' => $this->wealth_mobile_background_image,
            'wealth_image' => $this->wealth_image,
            'wealth_mobile_image' => $this->wealth_mobile_image,
            'wealth_read_more_text_en' => $this->wealth_read_more_text_en,
            'wealth_read_more_text_ar' => $this->wealth_read_more_text_ar,
            'wealth_link' => $this->wealth_link,
            
            // Strategic Investment Advisory Section
            'investment_title_en' => $this->investment_title_en,
            'investment_title_ar' => $this->investment_title_ar,
            'investment_description_en' => $this->investment_description_en,
            'investment_description_ar' => $this->investment_description_ar,
            'investment_background' => $this->investment_background,
            'investment_mobile_background' => $this->investment_mobile_background,
            'investment_image' => $this->investment_image,
            'investment_mobile_image' => $this->investment_mobile_image,
            'investment_read_more_text_en' => $this->investment_read_more_text_en,
            'investment_read_more_text_ar' => $this->investment_read_more_text_ar,
            'investment_link' => $this->investment_link,
            
            // CIO Office Services Section
            'cio_title_en' => $this->cio_title_en,
            'cio_title_ar' => $this->cio_title_ar,
            'cio_description_en' => $this->cio_description_en,
            'cio_description_ar' => $this->cio_description_ar,
            'cio_background' => $this->cio_background,
            'cio_mobile_background_image' => $this->cio_mobile_background_image,
            'cio_image' => $this->cio_image,
            'cio_mobile_image' => $this->cio_mobile_image,
            'cio_read_more_text_en' => $this->cio_read_more_text_en,
            'cio_read_more_text_ar' => $this->cio_read_more_text_ar,
            'cio_link' => $this->cio_link,
            
            'roadmap_title_en' => $this->roadmap_title_en,
            'roadmap_title_ar' => $this->roadmap_title_ar,
            'roadmap_mobile_image' => $this->roadmap_mobile_image,
            'roadmap_steps' => $this->roadmap_steps,
            'cta_title_en' => $this->cta_title_en,
            'cta_title_ar' => $this->cta_title_ar,
            'cta_subtitle_en' => $this->cta_subtitle_en,
            'cta_subtitle_ar' => $this->cta_subtitle_ar,
            'cta_background_image' => $this->cta_background_image,
            'cta_button_1_text_en' => $this->cta_button_1_text_en,
            'cta_button_1_text_ar' => $this->cta_button_1_text_ar,
            'cta_button_1_url' => $this->cta_button_1_url,
            'cta_button_2_text_en' => $this->cta_button_2_text_en,
            'cta_button_2_text_ar' => $this->cta_button_2_text_ar,
            'cta_button_2_url' => $this->cta_button_2_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
