<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource

{
public function toArray($request)
{
    
    // Now return the final array
    return [
        'id' => $this->id,
        'title_en' => $this->title_en,
        'title_ar' => $this->title_ar,
        'description_en' => $this->description_en,
        'description_ar' => $this->description_ar,
        'main_image_book' =>$this->getMedia('main_image_book')->map(function ($media) {return $media->getFullUrl();}), 
        'questions' => is_string($this->questions) ? json_decode($this->questions, true) : $this->questions,
        'category_id' => $this->category_id,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
    ];
}

}