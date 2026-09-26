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
        // New fields
        'author_en',
        'author_ar',
        'publication_date',
        'reading_time',
        'external_sources',
        'related_white_paper_id',
        'related_cio_flash_id',
        'related_monday_window_id',
        'is_featured',
    ];

    protected $casts = [
        'is_published'     => 'boolean',
        'is_featured'      => 'boolean',
        'external_sources' => 'array',
        'publication_date' => 'date',
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

    // Locale-aware author accessor
    public function getAuthorAttribute(): ?string
    {
        return app()->getLocale() === 'ar'
            ? ($this->author_ar ?: $this->author_en)
            : $this->author_en;
    }

    // Relationships
    public function relatedWhitePaper()
    {
        return $this->belongsTo(WhitePaper::class, 'related_white_paper_id');
    }

    public function relatedCioFlash()
    {
        return $this->belongsTo(CioFlash::class, 'related_cio_flash_id');
    }

    public function relatedMondayWindow()
    {
        return $this->belongsTo(MondayWindow::class, 'related_monday_window_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
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
