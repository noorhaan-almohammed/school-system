<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id'=>$this->id ,
            'title'=>$this->title ,
            'date'=>$this->date,
            'time'=>$this->time,
            'duration'=>$this->duration,
            'description'=>$this->description,
        ];
    }
}
