<?php

namespace App\Http\Controllers\Api;

use App\Models\Technique;
use App\Http\Requests\TechniqueRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\TechniqueResource;
use Illuminate\Database\Eloquent\SoftDeletes;


class TechniqueController extends Controller
{
    use SoftDeletes;

    public function index()
    {
        $techniques = Technique::paginate(20);
        return TechniqueResource::collection($techniques);
    }

 
    public function store(Request $request)
    {
       $technique = Technique::create($request->validated());
       return new TechniqyeResource($technique);
    }


    public function show(TechniqueRequest $request)
    {
        return new TechniqueResource($technique);
    }

    public function update(TechniqueRequest $request, Technique $technique)
    {
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
