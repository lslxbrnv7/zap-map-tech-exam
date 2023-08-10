<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocationRequest;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use App\Http\Resources\LocationResource;
use App\Models\Location;

class LocationController extends Controller
{
    public function index(LocationRequest $request) : AnonymousResourceCollection
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $radius = $request->input('radius');

        $locations = Location::fallsWithinRadius($latitude, $longitude, $radius)->get();

        return LocationResource::collection($locations);
    }
}
