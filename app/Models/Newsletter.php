<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tag_en',
        'tag_ar',
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'button_text_en',
        'button_text_ar',
        'placeholder_en',
        'placeholder_ar',
        'popup_image',
        'is_active',
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
}
