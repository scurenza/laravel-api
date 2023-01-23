<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        // $projects = Project::with('type', 'technologies')->get();

        // $projects = Project::with('type', 'technologies')->paginate(3);

        // Se nel request c'è technology_id
        //  allora seleziono dal database i project della tipologia corrispondente
        // Altrimenti
        //  seleziono tutti i project
        if ($request->has('type_id')) {
            $projects = Project::with('type', 'technologies')->where('type_id', $request->type_id)->paginate(3);
        } else {
            $projects = Project::with('type', 'technologies')->paginate(3);
        }
        return response()->json([
            'success' => true,
            'results' => $projects
        ]);
    }

    public function show($slug)
    {
        $project = Project::with('type', 'technologies')->where('slug', $slug)->first();
        if ($project) {
            return response()->json([
                'success' => true,
                'project' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Nessun progetto trovato'
            ]);
        }
    }
}
