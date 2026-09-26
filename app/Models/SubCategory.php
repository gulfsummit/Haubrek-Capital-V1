<?php

namespace App\Models;

use App\Models\Category;
use App\Helpers\TextHelper;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubCategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;



    protected $fillable = [
    'title_en',
    'title_ar',
    'description_en',
    'description_ar',
    'subtitle_en',
    'subtitle_ar',
    'category_id',
    'sliders_card',
    'approaches_tool',
    'steps_start_card',
    'why_choose_us',
       
    ];



protected $casts = [
    'sliders_card' => 'array',
    'approaches_tool' => 'array',
    'steps_start_card' => 'array',
    'why_choose_us' => 'array',
];
       public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }


    public function registerMediaCollections(): void
{
  $this->addMediaCollection('main_service_image')->singleFile();
  $this->addMediaCollection('why_choose_us_image');
}

/**
 * Clean text fields when saving
 */
protected static function boot()
{
    parent::boot();
    
    static::saving(function ($model) {
        // Clean text fields
        $textFields = ['title_en', 'title_ar', 'description_en', 'description_ar', 'subtitle_en', 'subtitle_ar'];
        
        foreach ($textFields as $field) {
            if ($model->$field) {
                $model->$field = TextHelper::cleanText($model->$field);
            }
        }
        
        // Clean array fields
        $arrayFields = ['sliders_card', 'approaches_tool', 'steps_start_card', 'why_choose_us'];
        
        foreach ($arrayFields as $field) {
            if ($model->$field && is_array($model->$field)) {
                $model->$field = self::cleanArrayText($model->$field);
            }
        }
    });
}

/**
 * Recursively clean text in arrays
 */
private static function cleanArrayText($array)
{
    foreach ($array as $key => $value) {
        if (is_string($value)) {
            $array[$key] = TextHelper::cleanText($value);
        } elseif (is_array($value)) {
            $array[$key] = self::cleanArrayText($value);
        }
    }
    return $array;
}
  

}
