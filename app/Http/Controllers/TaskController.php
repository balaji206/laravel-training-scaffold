<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    
    public function index(Project $project)
    {
    // TODO Day 6: eager load — $project->load('tasks.comments', 'tasks.assignee');
    $tasks = $project->tasks; // uses relationship

    return view('tasks.index', [
        'tasks' => $tasks,
        'project' => $project
    ]);
}

    public function create(Project $project)
    {
        
         return view('tasks.create', ['project'=> $project]);
        
    }

    public function store(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'status'=>'todo',
        'project_id' => $project->id,
        'assigned_to_id'=>1
    ]);

    return redirect("/projects/{$project->id}/tasks");
        // TODO Day 7: use StoreTaskRequest
        // TODO Day 11: handle file upload — Storage::disk('public')->put(...)
    }

    public function show(Project $project,Task $task)
    {
        
        //return 'task ' . $task . ' of project ' . $project;
        

        return view('tasks.show', ['task'=> $task,'project'=>$project]);
    }

    public function edit(Project $project, Task $task)
    {
        // TODO Day 9: $this->authorize('update', $task);
        

       

        return view('tasks.edit',['task'=>$task,'project'=>$project]);
    }

    public function update(Request $request ,Project $project, Task $task )
    {
       
        // TODO Day 7: use UpdateTaskRequest
        // TODO Day 9: $this->authorize('update', $task);
        // TODO Day 11: when assigned_to_id changes, dispatch TaskAssigned mail (queued)


        $task->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status
        ]);
        return redirect("/projects/{$project->id}/tasks");
    }

    public function destroy(Project $project,Task $task)
    {
        $task->delete();
        return redirect("/projects/{$project->id}/tasks");
        
        // TODO Day 9: $this->authorize('delete', $task);
        
    }
}