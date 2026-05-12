<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Mail\TaskAssigned;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class TaskController extends Controller
{
    
    public function index(Project $project)
    {
    $project->load(['tasks.comments', 'tasks.assignee']);
    $tasks = $project->tasks; // uses relationship

    return view('tasks.index', [
        'tasks' => $tasks,
        'project' => $project
    ]);
}

    public function create(Project $project)
    {
        $users = User::all();
        return view('tasks.create', ['project'=> $project,'users'=>$users]);
        
    }

    public function store(StoreTaskRequest $request, Project $project)
    {
        $path = null;

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
        }

        Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'status'=>$request->status,
        'project_id' => $project->id,
        'assigned_to_id' => $request->assigned_to_id,
        'attachment_path'=>$path
    ]);

    return redirect("/projects/{$project->id}/tasks");
        // TODO Day 11: handle file upload — Storage::disk('public')->put(...)
    }

    public function show(Project $project,Task $task)
    {
        
        //return 'task ' . $task . ' of project ' . $project;
        $task->load('comments', 'assignee');
        

        return view('tasks.show', ['task'=> $task,'project'=>$project]);
    }

    public function edit(Project $project, Task $task)
    {
        
        $this->authorize('update', $task);
       $users = User::all();

        return view('tasks.edit',['task'=>$task,'project'=>$project,'users'=>$users]);
    }

    public function update(UpdateTaskRequest $request ,Project $project, Task $task )
    {
       
        
        // TODO Day 11: when assigned_to_id changes, dispatch TaskAssigned mail (queued)

        $this->authorize('update', $task);

        $oldAssignedTo = $task->assigned_to_id;

        $task->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'status'=>$request->status,
            'assigned_to_id' => $request->assigned_to_id
        ]);

         $task->load('assignee');

        

    // Mail::to($task->assignee->email)
    //     ->send(new TaskAssigned($task));
        
        if(
            $request->assigned_to_id &&
            $oldAssignedTo != $task->assigned_to_id &&
            $task->assignee
        ){
            
            Mail::to($task->assignee->email)->queue(new TaskAssigned($task));
        }


        return redirect("/projects/{$project->id}/tasks");
    }

    public function destroy(Project $project,Task $task)
    {
        $this->authorize('delete', $task);
        if ($task->attachment_path) {
            Storage::disk('public')->delete($task->attachment_path);
        }
        $task->delete();
        return redirect("/projects/{$project->id}/tasks");
    
        
    }
}