<?php

namespace App\Filament\Admin\Resources\BlogPageResource\Pages;

use App\Filament\Admin\Resources\BlogPageResource;
use Filament\Resources\Pages\ListRecords;

class ListBlogPages extends ListRecords
{
    protected static string $resource = BlogPageResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
