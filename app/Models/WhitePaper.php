<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Concerns\HasSeoMeta;

class WhitePaper extends Model
{
    use HasFactory;
    use HasSeoMeta;

    protected $fillable = [
        'title_en',
        'title_ar',
        'slug',
        'featured_image',
        'featured_image_alt_en',
        'featured_image_alt_ar',
        'cover_image',
        'cover_image_alt_en',
        'cover_image_alt_ar',
        'short_description_en',
        'short_description_ar',
        'executive_summary_en',
        'executive_summary_ar',
        'publication_date',
        'author_en',
        'author_ar',
        'pdf_file',
        'related_article_url',
        'topics',
        'tags',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_featured'      => 'boolean',
        'is_published'     => 'boolean',
        'topics'           => 'array',
        'tags'             => 'array',
        'publication_date' => 'date',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (WhitePaper $model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title_en);
            }
        });

        static::updating(function (WhitePaper $model) {
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

    public function getShortDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'ar'
            ? ($this->short_description_ar ?: $this->short_description_en)
            : $this->short_description_en;
    }

    public function getExecutiveSummaryAttribute(): ?string
    {
        return app()->getLocale() === 'ar'
            ? ($this->executive_summary_ar ?: $this->executive_summary_en)
            : $this->executive_summary_en;
    }

    public function getAuthorAttribute(): ?string
    {
        return app()->getLocale() === 'ar'
            ? ($this->author_ar ?: $this->author_en)
            : $this->author_en;
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
        return $query->orderBy('sort_order')->orderBy('publication_date', 'desc');
    }
}
