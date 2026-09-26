<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Article extends Model implements HasMedia
{
    use InteractsWithMedia;

  protected $fillable = [
    'title_en',
    'title_ar',
    'description_en',
    'description_ar',
    'category_id',
    'questions',
  
       
    ];



    protected $casts = [
    'questions' => 'array',

];
 


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image_article')->singleFile(); // 👈 only one image allowed
    }
       public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
