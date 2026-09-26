<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Concerns\HasSeoMeta;

class CioFlash extends Model
{
    use HasFactory;
    use HasSeoMeta;

    protected $table = 'cio_flash';

    protected $fillable = [
        'episode_title_en',
        'episode_title_ar',
        'slug',
        'episode_number',
        'publication_date',
        'audio_file',
        'duration',
        'speaker_en',
        'speaker_ar',
        'speaker_position_en',
        'speaker_position_ar',
        'featured_image',
        'featured_image_alt_en',
        'featured_image_alt_ar',
        'description_en',
        'description_ar',
        'key_topics',
        'transcript_en',
        'transcript_ar',
        'related_articles',
        'is_featured',
        'is_published',
        'sort_order',
    ];

    protected $casts = [
        'is_featured'      => 'boolean',
        'is_published'     => 'boolean',
        'key_topics'       => 'array',
        'related_articles' => 'array',
        'publication_date' => 'date',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (CioFlash $model) {
            if (empty($model->slug)) {
                $base = $model->episode_number
                    ? 'episode-' . $model->episode_number
                    : Str::slug($model->episode_title_en);
                $model->slug = $base;
            }
        });

        static::updating(function (CioFlash $model) {
            if ($model->isDirty('episode_title_en') && empty($model->slug)) {
                $model->slug = Str::slug($model->episode_title_en);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    // Locale-aware accessors
    public function getEpisodeTitleAttribute(): string
    {
        return app()->getLocale() === 'ar'
            ? ($this->episode_title_ar ?: $this->episode_title_en)
            : $this->episode_title_en;
    }

    public function getTitleAttribute(): string
    {
        return $this->getEpisodeTitleAttribute();
    }

    public function getDescriptionAttribute(): ?string
    {
        return app()->getLocale() === 'ar'
            ? ($this->description_ar ?: $this->description_en)
            : $this->description_en;
    }

    public function getSpeakerAttribute(): ?string
    {
        return app()->getLocale() === 'ar'
            ? ($this->speaker_ar ?: $this->speaker_en)
            : $this->speaker_en;
    }

    public function getSpeakerPositionAttribute(): ?string
    {
        return app()->getLocale() === 'ar'
            ? ($this->speaker_position_ar ?: $this->speaker_position_en)
            : $this->speaker_position_en;
    }

    public function getTranscriptAttribute(): ?string
    {
        return app()->getLocale() === 'ar'
            ? ($this->transcript_ar ?: $this->transcript_en)
            : $this->transcript_en;
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
