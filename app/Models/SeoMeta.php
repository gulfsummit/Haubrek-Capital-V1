<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoMeta extends Model
{
    use HasFactory;

    protected $table = 'seo_meta';

    protected $fillable = [
        'meta_title_en',
        'meta_title_ar',
        'meta_description_en',
        'meta_description_ar',
        'h1_en',
        'h1_ar',
        'meta_keywords_en',
        'meta_keywords_ar',
        'canonical_url',
        'og_title_en',
        'og_title_ar',
        'og_description_en',
        'og_description_ar',
        'og_image',
        'og_image_alt_en',
        'og_image_alt_ar',
    ];

    public function seoble()
    {
        return $this->morphTo();
    }
}

