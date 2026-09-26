<?php

namespace App\Models\Concerns;

use App\Models\SeoMeta;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasSeoMeta
{
    public static function bootHasSeoMeta(): void
    {
        static::deleting(function ($model) {
            if ($model->seoMeta) {
                $model->seoMeta->delete();
            }
        });
    }

    public function seoMeta(): MorphOne
    {
        return $this->morphOne(SeoMeta::class, 'seoble');
    }
}

