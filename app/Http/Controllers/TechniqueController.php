<?php
// namespace App\Http\Controllers;

// use App\Models\Technique;
// use Inertia\Inertia;

// class TechniqueController extends Controller
// {
//     public function index()
//     {
//         $techniques = Technique::all();

//         return Inertia::render('Techniques/Index', [
//             'techniques' => $techniques,
//         ]);
//     }

//     public function show($id)
//     {

//         $technique = Technique::findOrFail($id);
        
//         return Inertia::render('../Techniques/Show', [
//             'technique' => $technique,
//         ]);

//     }
//}