<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Concerns\HasSeoMeta;

class Blog extends Model
{
    use HasFactory;
    use HasSeoMeta;

    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'content_en',
        'content_ar',
        'category',
        'category_ar',
        'button_text_en',
        'button_text_ar',
        'featured_image',
        'featured_image_alt_en',
        'featured_image_alt_ar',
        'thumbnail_image',
        'thumbnail_image_alt_en',
        'thumbnail_image_alt_ar',
        'slug',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title_en);
            }
        });
        
        static::updating(function ($blog) {
            if ($blog->isDirty('title_en') && empty($blog->slug)) {
                $blog->slug = Str::slug($blog->title_en);
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getTitleAttribute()
    {
        return app()->getLocale() == 'ar' ? ($this->title_ar ?: $this->title_en) : $this->title_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() == 'ar' ? ($this->description_ar ?: $this->description_en) : $this->description_en;
    }

    public function getContentAttribute()
    {
        return app()->getLocale() == 'ar' ? ($this->content_ar ?: $this->content_en) : $this->content_en;
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeByCategory($query, $category)
    {
        if ($category === 'all') {
            return $query;
        }
        return $query->where('category', $category);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }
}
