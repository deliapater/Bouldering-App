<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GearRequest;
use App\Http\Resources\GearResource;
use App\Models\Gear;
use Illuminate\Http\Request;

class GearController extends Controller
{
    public function index()
    {
        $gears = Gear::all();
        return GearResource::collection($gears);
    }
    public function store(GearRequest $request)
    {
        $gear = Gear::create($rquest->validate());
        return new GearResource($gear);
    }

    public function show(Gear $gear)
    {
        return new GearResource($gear);
    }

    public function update(GearRequest $request, Gear $gear)
    {
        $gear->update($request->validated());
        return new GearResource($gear);
    }

    public function destroy(string $id)
    {
        $gear = Gear::findOrFail($id);
        $gear->delete();
        return response()->noContent();
    }
}
