<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index() {

        request()->validate([
            'key' => ['nullable','string', 'min:2']
        ]);

        // dd(request()->key);

        if(request()->key){
            $projects = Project::where('title', 'LIKE', '%'. request()->key .'%')->paginate(6);
        } else {
            $projects = Project::paginate(6);
        }

        // $projects = Project::all();
        
        // $projects = Project::paginate(9);

        $projects = Project::with('type','technologies')->paginate(6);

        return response()->json([
            'success' => true,
            'results' => $projects,
        ]);
    }

    public function show(string $slug){

        $project = Project::where('slug', $slug)->with('type','technologies')->first();

        return response()->json([
            'success' => true,
            'result' => $project,
        ]);
    }
}
