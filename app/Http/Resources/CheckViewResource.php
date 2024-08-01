<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckViewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->account->user_name,
            'email' => $this->account->user->email,
            'account' => $this->account->account_number,
            'amount' => $this->amount,
            'picture' => $this->picture,
        ];
    }
}
