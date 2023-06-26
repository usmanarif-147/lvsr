<?php

namespace App\Http\Resources\Api;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $is_selected = 0;
        $user = User::find(auth()->id());
        if ($user->subscription($this->name)) {
            if ($user->subscription($this->name)->active()) {
                $is_selected = 1;
            }
        }
        return [
            'plan_id' => $this->plan_id,
            'title' => $this->title,
            'name' => $this->name,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'interval' => $this->interval,
            'interval_count' => $this->interval_count,
            'is_subscribed' => $is_selected
        ];
    }
}
