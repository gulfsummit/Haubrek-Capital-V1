<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

  
    protected $table = 'questions';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'percentage',
        'age_group',
        'investment_experience',
        'wealth_size',
        'investment_goal',
        'investment_horizon',
        'investment_reaction',
        'income_source',
        'investment_style',
        'asset_allocation',
    ];


    protected $casts = [
    'investment_goal' => 'array',
    'investment_reaction' => 'array',
    'income_source' => 'array',
    'investment_style' => 'array',
    'asset_allocation' => 'array',
    ];
}
