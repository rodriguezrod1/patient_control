<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'document_type'   => $this->document_type,
            'document_number' => $this->document_number,
            'rol'             => $this->rol,
            'name'            => $this->name,
            'email'           => $this->email,
            'city'            => $this->city,
            "phone"           => $this->phone,
            'birthdate'       => $this->birthdate,
        ];
    }
}
