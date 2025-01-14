<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GearRequest;
use App\Http\Resources\GearResource;
use App\Models\Gear;

class GearController extends Controller
{
    public function index()
    {
        $gears = Gear::with('techniques')->get();
        return GearResource::collection($gears);
    }
    public function store(GearRequest $request)
    {
        $data = $request->validated();
        $this->authorize('create', Gear::class);
        $gear = Gear::create($data);
        return new GearResource($gear);
    }

    public function show(Gear $gear)
    {
        return new GearResource($gear);
    }

    public function update(GearRequest $request, Gear $gear)
    {
        $this->authorize('update', $gear);
        $gear->update($request->validated());
        return new GearResource($gear);
    }

    public function destroy(string $id)
    {
        $gear = Gear::findOrFail($id);

        if($gear->techniques()->exists()) {
            return response()->json([
                'message' => 'Cannot delete gear associated with techniques'
            ], 400);
        }
        $gear->delete();
        return response()->noContent();
    }
}
