<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupedFlightsResource extends JsonResource
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
            'flights' => FlightResource::collection($this['flights']),
            'groups' => GroupResource::collection($this['groups']),
            'totalFlights' => $this['totalFlights'],
            'totalGroups' => $this['totalGroups'],
            'cheapestPrice' => $this['cheapestPrice'],
            'cheapestGroup' => $this['cheapestGroup'],
        ];
    }
}
