<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Resources\ProjectResource;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::where('user_id', auth()->id())->get();

        return ProjectResource::collection($projects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => 'active',
            'user_id' => auth()->id(),
        ]);

        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        if($project->user_id!=auth()->id()){
            return response()->json([
                'message' => 'You are not authorized to perform this action',
            ], 403);
        }
        return new ProjectResource($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request,Project $project)
    {
        //
        if($project->user_id!=auth()->id()){
            return response()->json([
                'message' => 'You are not authorized to perform this action',
            ], 403);
        }
        $project->update([
            'name' => $request->name ?? $project->name,
            'description' => $request->description ?? $project->description,
            
        ]);  
        return new ProjectResource($project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        if($project->user_id !== auth()->id())
        {
            return response()->json([
                'message' => 'You are not authorized to perform this action',
            ], 403);
        }
        $project->delete();
        return response()->json([
            'message' => 'Project deleted successfully',
        ]);
    }
}
