<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GearRequest;
use App\Http\Resources\GearResource;
use App\Models\Gear;
use Illuminate\Database\Eloquent\SoftDeletes;

class GearController extends Controller
{
    use SoftDeletes;

    public function index()
    {
        $gears = Gear::all();
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
        $this->authorize('create', Gear::class);
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
