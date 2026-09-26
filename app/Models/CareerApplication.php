<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mobile',
        'cv_path',
    ];

    /**
     * Get the CV file URL
     */
    public function getCvUrlAttribute(): string
    {
        return asset('storage/' . $this->cv_path);
    }
}
