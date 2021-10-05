<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FootballerFullResource extends JsonResource
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
            'full_name' => $this->first_name . " " . $this->last_name . " " . $this->surname,
            'birthdate' => $this->birthdate,
            'age' => Carbon::parse($this->birthdate)->age,
            'transfer_cost' => $this->transfer_cost,
            'kicking_foot' => $this->kicking_foot,
            'clubs' => ClubResource::collection($this->clubs)
        ];
    }
}
