<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model implements HasMedia
{
    use InteractsWithMedia;

  protected $fillable = [
    'title_ar',
    'title_en',
    'description_ar',
    'description_en',
    'category_id',
    'questions',
  
       
    ];



    protected $casts = [
    'questions' => 'array',

];
 


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('main_image')->singleFile(); // 👈 only one image allowed
        $this->addMediaCollection('main_image_book')->singleFile(); // 👈 only one image allowed
    }
       public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}