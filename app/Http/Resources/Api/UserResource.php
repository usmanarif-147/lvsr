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
            'name' =>  $this->name,
            'email' => $this->email,
            'username' => $this->username,
            'bio' => $this->bio,
            'phone' => $this->phone,
            'job_title' => $this->job_title,
            'company' => $this->company,
            'photo' => $this->photo,
            'cover_photo' => $this->cover_photo,
            'gender' => $this->gender,
            'address' => $this->address,
            'work_position' => $this->work_position,
            'user_direct' => $this->user_direct,
            'clicks' => $this->clicks,
            'dob' => $this->dob,
            'private' => $this->private,
            'is_verified' => $this->is_verified,
            'is_subscribed' => $this->is_subscribed,
            'created_at' => $this->created_at,
        ];
    }
}
