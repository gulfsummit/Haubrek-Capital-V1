<?php

namespace App\Console\Commands;

use App\Models\SubCategory;
use App\Helpers\TextHelper;
use Illuminate\Console\Command;

class DebugTextContent extends Command
{
    protected $signature = 'content:debug';
    protected $description = 'Debug and show problematic characters in content';

    public function handle()
    {
        $this->info('Debugging text content...');
        
        $services = SubCategory::all();
        
        foreach ($services as $service) {
            $this->line("=== Service: " . $service->title_en . " ===");
            
            // Check slider cards
            if ($service->sliders_card && is_array($service->sliders_card)) {
                foreach ($service->sliders_card as $index => $card) {
                    if (isset($card['title_ar'])) {
                        $original = $card['title_ar'];
                        $cleaned = TextHelper::cleanText($original);
                        
                        if ($original !== $cleaned) {
                            $this->warn("Slider Card $index Title AR:");
                            $this->line("Original: " . $original);
                            $this->line("Hex: " . bin2hex($original));
                            $this->line("Cleaned: " . $cleaned);
                            $this->line("---");
                        }
                    }
                }
            }
            
            $this->line("");
        }
        
        return 0;
    }
}
