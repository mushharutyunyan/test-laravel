<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClubFullResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'foundation_date' => $this->foundation_date,
            'coaches' => $this->coaches ? CoachResource::collection($this->coaches) : [],
            'footballers' => $this->footballers ? FootballerResource::collection($this->footballers) : []
        ];
    }
}
