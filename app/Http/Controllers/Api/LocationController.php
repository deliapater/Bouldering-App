<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationRequest;
use App\Http\Resources\LocationResource;
use App\Models\Location;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return LocationResource::collection($locations);
    }

    public function store(LocationRequest $request)
    {
        $location = Location::create($request->validated());
        return new LocationResource($location);
    }

    public function show(Location $location)
    {
        return new LocationResource($location);
    }

    public function update(LocationRequest $request, Location $location)
    {
        $location->update($request->validated());
        return new LocationResource($location);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $location = Location::findOrFail($id);
        $location->delete();
        return response()->noContent();
    }
}