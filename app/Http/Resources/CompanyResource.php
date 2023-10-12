<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = $this->company;

        return [
            'id'                => $data?->id,
            'name'              => $data?->name,
            'country'           => $data?->country,
            'activities'        => $data?->activities,
            'number'            => $data?->number,
            'auth_code'         => $data?->auth_code,
            'registered_office' => $data?->registered_office,
            'status'            => $this->status,
            'incorporated'      => Carbon::parse($data?->created_at)->format('d/m/Y'),
        ];
    }
}
