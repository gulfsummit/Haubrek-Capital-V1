<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhitePaperDownload extends Model
{
    use HasFactory;

    protected $fillable = [
        'white_paper_id',
        'first_name',
        'last_name',
        'business_email',
        'phone_number',
        'job_title',
        'company',
        'country',
        'downloaded_at',
    ];

    protected $casts = [
        'downloaded_at' => 'datetime',
    ];

    public function whitePaper()
    {
        return $this->belongsTo(WhitePaper::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
