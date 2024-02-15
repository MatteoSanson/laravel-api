<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {

        // $projects = Project::all();
        
        // $projects = Project::paginate(9);

        $projects = Project::with('type','technologies')->paginate(19);

        return response()->json([
            'success' => true,
            'results' => $projects,
        ]);
    }
}
