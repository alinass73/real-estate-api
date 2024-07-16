<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RealEstateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'price'=>$this->price,
            'category'=>$this->category,
            'address'=>$this->address,
            'bedroom'=>$this->bedroom,
            'bathroom'=>$this->bathroom,
            'area'=>$this->area,
            'floor'=>$this->floor,
            'parking'=>$this->parking,
        ];
    }
}
