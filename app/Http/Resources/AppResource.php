<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AppResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            
            // Hero Section
            'hero_title_en' => $this->hero_title_en,
            'hero_title_ar' => $this->hero_title_ar,
            'hero_subtitle_en' => $this->hero_subtitle_en,
            'hero_subtitle_ar' => $this->hero_subtitle_ar,
            'hero_background_image' => $this->hero_background_image,
            'hero_mobile_background_image' => $this->hero_mobile_background_image,
            
            // Investment App Promo Section
            'promo_title_en' => $this->promo_title_en,
            'promo_title_ar' => $this->promo_title_ar,
            'promo_description_en' => $this->promo_description_en,
            'promo_description_ar' => $this->promo_description_ar,
            'promo_background_image' => $this->promo_background_image,
            'promo_mobile_1_image' => $this->promo_mobile_1_image,
            'promo_mobile_2_image' => $this->promo_mobile_2_image,
            'promo_mobile_3_image' => $this->promo_mobile_3_image,
            
            // Bottom Half Section
            'bottom_title_en' => $this->bottom_title_en,
            'bottom_title_ar' => $this->bottom_title_ar,
            'bottom_subtitle_en' => $this->bottom_subtitle_en,
            'bottom_subtitle_ar' => $this->bottom_subtitle_ar,
            'bottom_background_image' => $this->bottom_background_image,
            'bottom_bullet_points_en' => $this->bottom_bullet_points_en,
            'bottom_bullet_points_ar' => $this->bottom_bullet_points_ar,
            
            // Connect Section
            'connect_subtitle_en' => $this->connect_subtitle_en,
            'connect_subtitle_ar' => $this->connect_subtitle_ar,
            'connect_title_en' => $this->connect_title_en,
            'connect_title_ar' => $this->connect_title_ar,
            'connect_bullet_points_en' => $this->connect_bullet_points_en,
            'connect_bullet_points_ar' => $this->connect_bullet_points_ar,
            'connect_background_image' => $this->connect_background_image,
            'connect_mobile_image' => $this->connect_mobile_image,
            
            // Documentation Section
            'docs_subtitle_en' => $this->docs_subtitle_en,
            'docs_subtitle_ar' => $this->docs_subtitle_ar,
            'docs_title_en' => $this->docs_title_en,
            'docs_title_ar' => $this->docs_title_ar,
            'docs_bullet_points_en' => $this->docs_bullet_points_en,
            'docs_bullet_points_ar' => $this->docs_bullet_points_ar,
            'docs_background_image' => $this->docs_background_image,
            'docs_mobile_image' => $this->docs_mobile_image,
            
            // Knowledge Section
            'knowledge_subtitle_en' => $this->knowledge_subtitle_en,
            'knowledge_subtitle_ar' => $this->knowledge_subtitle_ar,
            'knowledge_title_en' => $this->knowledge_title_en,
            'knowledge_title_ar' => $this->knowledge_title_ar,
            'knowledge_bullet_points_en' => $this->knowledge_bullet_points_en,
            'knowledge_bullet_points_ar' => $this->knowledge_bullet_points_ar,
            'knowledge_background_image' => $this->knowledge_background_image,
            'knowledge_mobile_image' => $this->knowledge_mobile_image,
            
            // Security Section
            'security_subtitle_en' => $this->security_subtitle_en,
            'security_subtitle_ar' => $this->security_subtitle_ar,
            'security_title_en' => $this->security_title_en,
            'security_title_ar' => $this->security_title_ar,
            'security_bullet_points_en' => $this->security_bullet_points_en,
            'security_bullet_points_ar' => $this->security_bullet_points_ar,
            'security_background_image' => $this->security_background_image,
            'security_mobile_image' => $this->security_mobile_image,
            
            // CTA Section
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
