<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => $this->id,
            'name' =>  $this->name ?? null,
            'email' => $this->email ?? null,
            'username' => $this->username ?? null,
            'bio' => $this->bio ?? null,
            'phone' => $this->phone ?? null,
            'job_title' => $this->job_title ?? null,
            'company' => $this->company ?? null,
            'photo' => $this->photo ?? null,
            'cover_photo' => $this->cover_photo ?? null,
            'gender' => $this->gender ?? null,
            'address' => $this->address ?? null,
            'work_position' => $this->work_position ?? null,
            'user_direct' => $this->user_direct ?? null,
            'clicks' => $this->clicks ?? null,
            'dob' => $this->dob ?? null,
            'private' => $this->private ?? null,
            'is_verified' => $this->is_verified ?? null,
            'is_subscribed' => $this->is_subscribed ?? null,
            'created_at' => $this->created_at ?? null,
        ];
    }
}
