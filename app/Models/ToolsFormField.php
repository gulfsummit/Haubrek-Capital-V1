<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToolsFormField extends Model
{
    use HasFactory;

    protected $fillable = [
        'label_en',
        'label_ar',
        'field_name',
        'field_type',
        'options_en',
        'options_ar',
        'placeholder_en',
        'placeholder_ar',
        'is_required',
        'order',
    ];

    protected $casts = [
        'options_en' => 'array',
        'options_ar' => 'array',
        'is_required' => 'boolean',
    ];
}
