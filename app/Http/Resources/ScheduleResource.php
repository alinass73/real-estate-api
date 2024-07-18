<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'visit_date'=>$this->visit_date,
            'user' => [
                'name' => $this->user->name,
                'email' => $this->user->email,
            ],
            'real_estate'=>new RealEstateResource($this->realEstate)
        ];
    }
}
