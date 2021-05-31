<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uniqueId' => $this->uniqueId,
            'totalPrice' => $this->totalPrice,
            'outbound' => $this->outbound,
            'inbound' => $this->inbound,
        ];
    }
}
