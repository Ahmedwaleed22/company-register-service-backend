<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $service = $this->service;
        $user = $this->user;

        return [
            'id' => $service?->id,
            'description' => $service?->description,
            'auto_renewal' => boolval($service?->auto_renewal),
            'end_date' => $service?->end_date,
            'status' => $this->status,
            'company' => $this->company?->name,
            'officer' => "$user->first_name $user->last_name",
            'price' => $this->price,
            'renewal_price' => $this->renewal_price,
        ];
    }
}
