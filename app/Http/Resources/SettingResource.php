<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource

{
public function toArray($request)
{
    
    // Now return the final array
    return [
        'id' => $this->id ?? $this->id,
        'email' => $this->email ?? 'info@hauberkcapital.com',
        'phone' => $this->phone ?? '+971 4 5182591 / 2',
        'address' => $this->address ?? 'Al Sila Tower, ADGM Square, Al Maryah Island, Abu Dhabi, United Arab Emirates',
        'facebook' => $this->facebook ?? 'https://www.facebook.com/hauberkcapital',
        'instagram'=> $this->instagram ?? 'https://www.instagram.com/hauberkcapital/',
        'twitter' => $this->twitter ?? 'https://twitter.com/hauberkcapital',
        'linkedin' => $this->linkedin ?? 'https://www.linkedin.com/company/hauberkcapital',
        'youtube' => $this->youtube ?? 'https://www.youtube.com/channel/UCY3Zo3tK1yOyE0Y4oUo7P4w',
        'timing' => $this->timing ?? 'Monday - Friday, 9:00 AM - 6:00 PM',
        'map' =>$this->map ??'https://www.google.com/maps/place/Hauberk+Capital/@25.3004816,55.3023003,15z/data=!4m5!3m4!1s0x3e5f6a4c6b8e3e9d:0x6b0b9f4a7f8c9e63!8m2!3d25.3004816!4d55.3023003',
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
    ];
}

}