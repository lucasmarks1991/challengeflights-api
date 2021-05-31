<?php

namespace App\Services;

use App\Models\Flight;
use App\Models\Group;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class FlightService
{
    /**
     * List Flights.
     *
     * @return Collection
     */
    public function list()
    {
        $flightCollection = $this->requestGetFlights();

        return $flightCollection;
    }

    /**
     * Get grouped Flights.
     *
     * @return array
     */
    public function getGrouped()
    {
        $flightCollection = $this->list();
        $groupCollection = collect();

        $groupedFlights = $flightCollection->groupBy(['fare', 'bound', 'price']);

        foreach ($groupedFlights as $fare => $fareGroup) {
            if (isset($fareGroup["out"])) {
                foreach ($fareGroup["out"] as $outboundGroupByPrice) {
                    $outboundFlights = $outboundGroupByPrice;

                    if (isset($fareGroup["in"])) {
                        foreach ($fareGroup["in"] as $inboundGroupByPrice) {
                            $inboundFlights = $inboundGroupByPrice;

                            $group = new Group();
                            $group->uniqueId = (string) Str::uuid();
                            $group->totalPrice = $outboundFlights->first()->price + $inboundFlights->first()->price;
                            $group->outbound = $outboundFlights;
                            $group->inbound = $inboundFlights;

                            $groupCollection->add($group);
                        }
                    }
                }
            }
        }

        $sortedGroupCollection = $groupCollection->sortBy('totalPrice')->values();

        return [
            'flights' => $flightCollection,
            'groups' => $sortedGroupCollection,
            'totalFlights' => $flightCollection->count(),
            'totalGroups' => $sortedGroupCollection->count(),
            'cheapestPrice' => $sortedGroupCollection->first()->totalPrice,
            'cheapestGroup' => $sortedGroupCollection->first()->uniqueId,
        ];
    }

    /**
     * Request - GET - Flights.
     *
     * @return Collection
     */
    private function requestGetFlights()
    {
        $req = Http::get('http://prova.123milhas.net/api/flights');

        $flightCollection = collect();

        if ($req->failed()) {
            return $flightCollection;
        }

        foreach ($req->json() as $flight) {
            $flightCollection->add(new Flight($flight));
        }

        return $flightCollection;
    }
}
