<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class JewelResource extends JsonResource
{
    /**
     * Transform the jewel into the array exposed by the JSON service.
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'material' => $this->getMaterial(),
            'stock' => $this->getStock(),
            'image' => url(Storage::url($this->getImage())),
            'link' => route('jewels.show', $this->getId()),
        ];
    }
}
