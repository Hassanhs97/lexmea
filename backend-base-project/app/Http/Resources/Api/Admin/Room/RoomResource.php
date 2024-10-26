<?php

namespace App\Http\Resources\Api\Admin\Room;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RoomResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'floor_number' => $this->floor_number,
            'room_number'  => $this->room_number,
            'capacity'     => $this->capacity,
            'status'       => $this->status,
        ];
    }
}
