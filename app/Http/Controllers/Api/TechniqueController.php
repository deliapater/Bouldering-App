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
       $this->authorize('create', Technique::class);
       $data = $request->validated();
       $technique = Technique::create([
        'name' => $data['name'],
        'description' => $data['description'],
        'steps_to_practice' => $data['steps_to_practice'] ?? null,
        'difficulty_level' => $data['difficulty_level'],
       ]);

       if(!empty($data['gear'])) {
        $gearIds = collect($data['gear'])->pluck('id');
        $technique->gear()->sync($gearIds);
       }
       return new TechniqueResource($technique->load('gear'));
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
