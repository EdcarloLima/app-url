<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WebAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'      => $this->id,
            'url'     => $this->url,
            'status'  => $this->status_code,
            'visible' => $this->visible,
            'content' => $this->content,
            'created' => $this->created_at->format('d/m/Y H:i:s'),
            'updated' => $this->updated_at->format('d/m/Y H:i:s'),
        ];
    }
}
