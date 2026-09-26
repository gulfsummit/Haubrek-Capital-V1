<?php

namespace App\Console\Commands;

use App\Models\SubCategory;
use App\Helpers\TextHelper;
use Illuminate\Console\Command;

class CleanTextContent extends Command
{
    protected $signature = 'content:clean';
    protected $description = 'Clean problematic characters from existing content';

    public function handle()
    {
        $this->info('Cleaning text content...');
        
        $services = SubCategory::all();
        $cleaned = 0;
        
        foreach ($services as $service) {
            $original = $service->toArray();
            
            // Clean text fields
            $textFields = ['title_en', 'title_ar', 'description_en', 'description_ar', 'subtitle_en', 'subtitle_ar'];
            
            foreach ($textFields as $field) {
                if ($service->$field) {
                    $cleaned_text = TextHelper::cleanText($service->$field);
                    if ($cleaned_text !== $service->$field) {
                        $this->line("Cleaning $field in service: " . $service->title_en);
                        $service->$field = $cleaned_text;
                        $cleaned++;
                    }
                }
            }
            
            // Clean array fields
            $arrayFields = ['sliders_card', 'approaches_tool', 'steps_start_card', 'why_choose_us'];
            
            foreach ($arrayFields as $field) {
                if ($service->$field && is_array($service->$field)) {
                    $cleaned_array = $this->cleanArrayText($service->$field);
                    if ($cleaned_array !== $service->$field) {
                        $this->line("Cleaning $field in service: " . $service->title_en);
                        $service->$field = $cleaned_array;
                        $cleaned++;
                    }
                }
            }
            
            if ($service->isDirty()) {
                $service->saveQuietly(); // Save without triggering events
            }
        }
        
        $this->info("Cleaned $cleaned text fields!");
        
        return 0;
    }
    
    private function cleanArrayText($array)
    {
        foreach ($array as $key => $value) {
            if (is_string($value)) {
                $array[$key] = TextHelper::cleanText($value);
            } elseif (is_array($value)) {
                $array[$key] = $this->cleanArrayText($value);
            }
        }
        return $array;
    }
}