<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'          => $this->name,
            'description'   => $this->description,
            'link'          => URL::temporarySignedRoute('file.download', now()->addMinutes(30), ['file' => $this->id]) ,
            'uploaded_date' => Carbon::parse($this->created_at)->format('d/m/Y')
        ];
    }
}
