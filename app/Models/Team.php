<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model implements HasMedia
{
    use InteractsWithMedia;

  protected $fillable = [
    'title_en',
    'title_ar',
    'description_en',
    'description_ar',
    'category_id',
    'departments',
    'directors'
  
       
    ];



    protected $casts = [
    'departments' => 'array',
   'directors' => 'array',
];
 


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('team_image'); // 👈 
    }
       public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }



}
