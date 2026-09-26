<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Concerns\HasSeoMeta;

class MondayWindow extends Model
{
    use HasFactory;
    use HasSeoMeta;

    protected $fillable = [
        'title_en',
        'title_ar',
        'slug',
        'week_date',
        'short_summary_en',
        'short_summary_ar',
        'content_en',
        'content_ar',
        'market_topics',
        'featured_image',
        'featured_image_alt_en',
        'featured_image_alt_ar',
        'external_sources',
        'related_articles',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_featured'      => 'boolean',
        'is_published'     => 'boolean',
        'market_topics'    => 'array',
        'external_sources' => 'array',
        'related_articles' => 'array',
        'week_date'        => 'date',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (MondayWindow $model) {
            if (empty($model->slug)) {
                // Prefer date-based slug e.g. "2026-09-21", fallback to title
                $model->slug = $model->week_date
                    ? $model->week_date->format('Y-m-d')
                    : Str::slug($model->title_en);
            }
        });

        static::updating(function (MondayWindow $model) {
            if ($model->isDirty('title_en') && empty($model->slug)) {
                $model->slug = Str::slug($model->title_en);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Locale-aware accessors
    public function getTitleAttribute(): string
    {
        return app()->getLocale() === 'ar'
            ? ($this->title_ar ?: $this->title_en)
            : $this->title_en;
    }

    public function getShortSummaryAttribute(): ?string
    {
        return app()->getLocale() === 'ar'
            ? ($this->short_summary_ar ?: $this->short_summary_en)
            : $this->short_summary_en;
    }

    public function getContentAttribute(): ?string
    {
        return app()->getLocale() === 'ar'
            ? ($this->content_ar ?: $this->content_en)
            : $this->content_en;
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

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('week_date', 'desc');
    }
}
