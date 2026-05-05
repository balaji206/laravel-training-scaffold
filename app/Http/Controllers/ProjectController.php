<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        
        
        // TODO Day 6: add eager loading — Project::with('tasks')->get() — to fix N+1
        // TODO Day 8: scope to logged-in user — auth()->user()->projects
        
         return view('projects.index', [
        'projects' => Project::all()
    ]);
    }
   

    public function create()
    {
        // TODO Day 2 (stub) → Day 5: return view('projects.create');
       return view('projects.create');
    }

    public function store(Request $request)
    {
        
        // TODO Day 7: replace Request with StoreProjectRequest (Form Request)
        // TODO Day 8: associate with auth()->user() before creating
        $request->validate([
            'name'=> 'required',
            'description'=>'nullable'
        ]);
        
        Project::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'status'=>'active',
            'user_id'=>1
        ]);
        return redirect('/projects');
        
    }

    public function show(Project $project)
    {
        // TODO Day 6: load relationships — $project->load('tasks.comments', 'members');
        // TODO Day 9: $this->authorize('view', $project);
        

        return view('projects.show', compact('project'));
        
    }

    public function edit(Project $project)
    {
        


    return view('projects.edit', compact('project'));
        // TODO Day 9: $this->authorize('update', $project);
        
    }

    public function update(Request $request, Project $project)
    {
        // TODO Day 7: replace Request with UpdateProjectRequest
        // TODO Day 9: $this->authorize('update', $project);
        
        $project->update([
            'name'=>$request->name,
            'description'=>$request->description,
        ]);
        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        // TODO Day 9: $this->authorize('delete', $project);
        
        $project->delete();
        return redirect('/projects');
    }
}