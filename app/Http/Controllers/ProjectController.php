<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    public function index()
    {
        
        $projects = auth()->user()
    ->projects()
    ->with('tasks')
    ->get();
        auth()->user()->can('view',$projects);
         return view('projects.index', [
        'projects' => $projects
    ]);
    }
   

    public function create()
    {
       return view('projects.create');
    }

    public function store(StoreProjectRequest $request)
    {
       
       
        auth()->user()->can('create',$project);
        Project::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>'active',
            'user_id' => auth()->id()
        ]);
        return redirect('/projects');
        
    }

    public function show(Project $project)
    {
        
        
        $project->load('tasks.comments', 'members','owner');

        $this->authorize('view', $project);
        return view('projects.show', compact('project'));
        
    }

    public function edit(Project $project)
    {
        
        $this->authorize('update', $project);

    return view('projects.edit', compact('project'));
        
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {
        
        $this->authorize('update', $project);
        
        $project->update([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        return redirect('/projects');
    }
}