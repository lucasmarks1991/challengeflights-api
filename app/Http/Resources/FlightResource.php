<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FlightResource extends JsonResource
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
            'id' => $this->id,
            'cia' => $this->cia,
            'fare' => $this->fare,
            'flightNumber' => $this->flightNumber,
            'origin' => $this->origin,
            'destination' => $this->destination,
            'departureDate' => $this->departureDate,
            'arrivalDate' => $this->arrivalDate,
            'departureTime' => $this->departureTime,
            'arrivalTime' => $this->arrivalTime,
            'classService' => $this->classService,
            'price' => $this->price,
            'tax' => $this->tax,
            'outbound' => $this->outbound,
            'inbound' => $this->inbound,
            'duration' => $this->duration,
        ];
    }
}
