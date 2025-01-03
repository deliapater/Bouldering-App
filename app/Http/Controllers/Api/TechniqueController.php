<?php

namespace App\Http\Controllers\Api;

use App\Models\Technique;
use App\Http\Requests\TechniqueRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TechniqueResource;

class TechniqueController extends Controller
{
    public function index()
    {
        $techniques = Technique::with('gear')->paginate(20);
        return TechniqueResource::collection($techniques);
    }

 
    public function store(TechniqueRequest $request)
    {
       $data = $request->validated();
       $this->authorize('create', Technique::class);
       $technique = Technique::create($data);
       return new TechniqueResource($technique);
    }


    public function show(Technique $technique)
    {
        return new TechniqueResource($technique->load('gear'));
    }

    public function update(TechniqueRequest $request, Technique $technique)
    {
        $this->authorize('update', $technique);
        $technique->update($request->validated());

        return new TechniqueResource($technique);
    }

    public function destroy(string $id)
    {
        $technique = Technique::findOrFail($id);
        $technique->delete();
        return response()->noContent();
    }
}
