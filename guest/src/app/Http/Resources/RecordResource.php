<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecordResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "fullName" => $this->full_name,
            "comment" => $this->comment
        ];
    }
}
