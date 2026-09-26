<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResearchDownload extends Model
{
    use HasFactory;

    protected $fillable = [
        'research_id',
        'first_name',
        'last_name',
        'business_email',
        'company',
        'job_title',
        'country',
        'phone_number',
        'downloaded_at',
    ];

    protected $casts = [
        'downloaded_at' => 'datetime',
    ];

    // Relationships
    public function research()
    {
        return $this->belongsTo(Research::class);
    }

    // Accessor: full name
    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
