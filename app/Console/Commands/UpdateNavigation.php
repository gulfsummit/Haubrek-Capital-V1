<?php

namespace App\Console\Commands;

use App\Models\WebsiteSettings;
use Illuminate\Console\Command;

class UpdateNavigation extends Command
{
    protected $signature = 'nav:update-resources';
    protected $description = 'Update Resources Center dropdown with new content types';

    public function handle(): void
    {
        $ws = WebsiteSettings::first();

        if (! $ws) {
            $this->error('No WebsiteSettings record found.');
            return;
        }

        $links = $ws->navigation_links ?? [];

        foreach ($links as $i => $item) {
            if (($item['route'] ?? '') === 'resources-center') {
                $links[$i]['dropdown_items'] = [
                    ['route' => 'blog',          'title_en' => 'Blog / News',   'title_ar' => 'المدونة / الأخبار'],
                    ['route' => 'white-papers',  'title_en' => 'White Papers',  'title_ar' => 'الأوراق البيضاء'],
                    ['route' => 'cio-flash',     'title_en' => 'CIO Flash',     'title_ar' => 'CIO Flash'],
                    ['route' => 'monday-window', 'title_en' => 'Monday Window', 'title_ar' => 'نافذة الاثنين'],
                    ['route' => 'research',      'title_en' => 'Research',      'title_ar' => 'الأبحاث'],
                ];
                $this->info('Found resources-center entry, updating ' . count($links[$i]['dropdown_items']) . ' items...');
                break;
            }
        }

        $ws->navigation_links = $links;
        $ws->save();

        $this->info('Navigation updated successfully.');

        // Also update resource_centers cards
        $rc = \App\Models\ResourceCenter::first();
        if ($rc) {
            $rc->white_papers_card_title_en  = 'White Papers';
            $rc->white_papers_card_title_ar  = 'الأوراق البيضاء';
            $rc->white_papers_card_link      = '/resources-center/white-papers';
            $rc->white_papers_card_enabled   = true;

            $rc->cio_flash_card_title_en     = 'CIO Flash';
            $rc->cio_flash_card_title_ar     = 'CIO Flash';
            $rc->cio_flash_card_link         = '/resources-center/cio-flash';
            $rc->cio_flash_card_enabled      = true;

            $rc->monday_window_card_title_en = 'Monday Window';
            $rc->monday_window_card_title_ar = 'نافذة الاثنين';
            $rc->monday_window_card_link     = '/resources-center/monday-window';
            $rc->monday_window_card_enabled  = true;

            $rc->research_card_title_en      = 'Research';
            $rc->research_card_title_ar      = 'الأبحاث';
            $rc->research_card_link          = '/resources-center/research';
            $rc->research_card_enabled       = true;

            $rc->save();
            $this->info('Resource Center cards updated.');
        } else {
            $this->warn('No ResourceCenter record found — create one in the dashboard first.');
        }
    }
}
