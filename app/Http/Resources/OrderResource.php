<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        try {
            $invoiced = Carbon::parse($this->invoiced)->format('d/m/Y');
        } catch (\Carbon\Exceptions\InvalidFormatException $e) {
            $invoiced = 'N/A';
        }

        return [
            'id'            => $this->id,
            'invoiced'      => $invoiced,
            'package'       => [
                'id' => $this->package->id,
                'name' => $this->package->name,
            ],
            'description'   => $this->description,
            'status'        => $this->status,
            'total_price'   => $this->total_price ? $this->total_price : $this->package->price,
        ];
    }
}
