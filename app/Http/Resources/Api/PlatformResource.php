<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class PlatformResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id ?? null,
            'title' => $this->title ?? null,
            'icon' => $this->icon ?? null,
            'base_url' => $this->base_url ?? null,
            'created_at' => $this->created_at,
            'placeholder_en' => $this->placeholder_en ?? null,
            'placeholder_fr' => $this->placeholder_fr ?? null,
            'placeholder_sp' => $this->placeholder_sp ?? null,
            'description_en' => $this->description_en ?? null,
            'description_fr' => $this->description_fr ?? null,
            'description_sp' => $this->description_sp ?? null,
            'saved' => $this->saved ?? null,
            'path' => $this->path ?? null,
        ];
    }
}
