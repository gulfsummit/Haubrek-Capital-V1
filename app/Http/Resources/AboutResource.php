<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource

{
public function toArray($request)
{
    
    // Now return the final array
    return [
        'id' => $this->id,
        
        // Hero Section
        'hero_title_en' => $this->hero_title_en,
        'hero_title_ar' => $this->hero_title_ar,
        'hero_subtitle_en' => $this->hero_subtitle_en,
        'hero_subtitle_ar' => $this->hero_subtitle_ar,
        'hero_button_text_en' => $this->hero_button_text_en,
        'hero_button_text_ar' => $this->hero_button_text_ar,
        'hero_button_link' => $this->hero_button_link,
        'hero_desktop_image' => $this->hero_desktop_image,
        'hero_mobile_image' => $this->hero_mobile_image,
        
        // Who We Are Section
        'who_we_are_title_en' => $this->who_we_are_title_en,
        'who_we_are_title_ar' => $this->who_we_are_title_ar,
        'who_we_are_description_1_en' => $this->who_we_are_description_1_en,
        'who_we_are_description_1_ar' => $this->who_we_are_description_1_ar,
        'who_we_are_description_2_en' => $this->who_we_are_description_2_en,
        'who_we_are_description_2_ar' => $this->who_we_are_description_2_ar,
        'who_we_are_description_3_en' => $this->who_we_are_description_3_en,
        'who_we_are_description_3_ar' => $this->who_we_are_description_3_ar,
        'who_we_are_desktop_bg' => $this->who_we_are_desktop_bg,
        'who_we_are_mobile_bg' => $this->who_we_are_mobile_bg,
        
        // Concept Section
        'concept_title_en' => $this->concept_title_en,
        'concept_title_ar' => $this->concept_title_ar,
        'concept_intro_en' => $this->concept_intro_en,
        'concept_intro_ar' => $this->concept_intro_ar,
        'yield_title_en' => $this->yield_title_en,
        'yield_title_ar' => $this->yield_title_ar,
        'yield_description_en' => $this->yield_description_en,
        'yield_description_ar' => $this->yield_description_ar,
        'defence_title_en' => $this->defence_title_en,
        'defence_title_ar' => $this->defence_title_ar,
        'defence_description_en' => $this->defence_description_en,
        'defence_description_ar' => $this->defence_description_ar,
        'appreciation_title_en' => $this->appreciation_title_en,
        'appreciation_title_ar' => $this->appreciation_title_ar,
        'appreciation_description_en' => $this->appreciation_description_en,
        'appreciation_description_ar' => $this->appreciation_description_ar,
        'liquidity_title_en' => $this->liquidity_title_en,
        'liquidity_title_ar' => $this->liquidity_title_ar,
        'liquidity_description_en' => $this->liquidity_description_en,
        'liquidity_description_ar' => $this->liquidity_description_ar,
        'concept_diagram_image' => $this->concept_diagram_image,
        'concept_diagram_image_alt_en' => $this->concept_diagram_image_alt_en,
        'concept_diagram_image_alt_ar' => $this->concept_diagram_image_alt_ar,
        'concept_diagram_image_ar' => $this->concept_diagram_image_ar,
        'concept_diagram_image_ar_alt_en' => $this->concept_diagram_image_ar_alt_en,
        'concept_diagram_image_ar_alt_ar' => $this->concept_diagram_image_ar_alt_ar,
        'concept_diagram_mobile_image' => $this->concept_diagram_mobile_image,
        'concept_diagram_mobile_image_alt_en' => $this->concept_diagram_mobile_image_alt_en,
        'concept_diagram_mobile_image_alt_ar' => $this->concept_diagram_mobile_image_alt_ar,
        'concept_diagram_mobile_image_ar' => $this->concept_diagram_mobile_image_ar,
        'concept_diagram_mobile_image_ar_alt_en' => $this->concept_diagram_mobile_image_ar_alt_en,
        'concept_diagram_mobile_image_ar_alt_ar' => $this->concept_diagram_mobile_image_ar_alt_ar,
        'concept_bg_image' => $this->concept_bg_image,
        'concept_bg_image_alt_en' => $this->concept_bg_image_alt_en,
        'concept_bg_image_alt_ar' => $this->concept_bg_image_alt_ar,
        'concept_bg_mobile_image' => $this->concept_bg_mobile_image,
        'concept_bg_mobile_image_alt_en' => $this->concept_bg_mobile_image_alt_en,
        'concept_bg_mobile_image_alt_ar' => $this->concept_bg_mobile_image_alt_ar,
        
        // Mission & Vision
        'mission_title_en' => $this->mission_title_en,
        'mission_title_ar' => $this->mission_title_ar,
        'mission_text_en' => $this->mission_text_en,
        'mission_text_ar' => $this->mission_text_ar,
        'vision_title_en' => $this->vision_title_en,
        'vision_title_ar' => $this->vision_title_ar,
        'vision_text_en' => $this->vision_text_en,
        'vision_text_ar' => $this->vision_text_ar,
        'mission_icon' => $this->mission_icon,
        'vision_icon' => $this->vision_icon,
        
        // Values Section
        'values_title_en' => $this->values_title_en,
        'values_title_ar' => $this->values_title_ar,
        'values' => is_string($this->values) ? json_decode($this->values, true) : $this->values,
        
        // Approach Section
        'approach_title_en' => $this->approach_title_en,
        'approach_title_ar' => $this->approach_title_ar,
        'approach_description_1_en' => $this->approach_description_1_en,
        'approach_description_1_ar' => $this->approach_description_1_ar,
        'approach_description_2_en' => $this->approach_description_2_en,
        'approach_description_2_ar' => $this->approach_description_2_ar,
        'approach_items' => is_string($this->approach_items) ? json_decode($this->approach_items, true) : $this->approach_items,
        'approach_bg_image' => $this->approach_bg_image,
        
        // Legacy Q&A Section
        'questions' => is_string($this->questions) ? json_decode($this->questions, true) : $this->questions,
  
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
    ];
}

}