<?php

namespace App\Http\Controllers;

use App\Http\Resources\FlightCollection;
use App\Http\Resources\GroupedFlightsResource;
use App\Services\FlightService;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    private $flightService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FlightService $flightService)
    {
        $this->flightService = $flightService;
    }

    /**
     * List Flights.
     *
     * @param Request $request
     * @return FlightCollection
     */
    public function index(Request $request)
    {
        $flightCollection = $this->flightService->list();

        return new FlightCollection($flightCollection);
    }

    /**
     * Get grouped Flights.
     *
     * @param Request $request
     * @return GroupedFlightsResource
     */
    public function grouped(Request $request)
    {
        $groupedFlightsArray = $this->flightService->getGrouped();

        return new GroupedFlightsResource($groupedFlightsArray);
    }
}
