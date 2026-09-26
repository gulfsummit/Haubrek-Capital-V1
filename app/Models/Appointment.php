<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'company_name',
        'user_type',
        'message',
        'selected_date',
        'selected_time',
    ];

    protected $casts = [
        'selected_date' => 'date',
    ];
}
