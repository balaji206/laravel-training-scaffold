<?php

namespace App\Http\Controllers;
// use App\Mail\TaskUpdated;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use App\Mail\TaskAssigned;
// use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Services\BrevoMailService;


class TaskController extends Controller
{
    
    public function index(Project $project)
{
    $tasks = $project->tasks;

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

        $task = Task::create([
    'title' => $request->title,
    'description' => $request->description,
    'status' => $request->status,
    'project_id' => $project->id,
    'assigned_to_id' => $request->assigned_to_id,
    'attachment_path' => $path
]);

$task->load('assignee');

if ($task->assignee) {

    BrevoMailService::send(
        $task->assignee->email,
        $task->assignee->name,
        'New Task Assigned',
        "
        <h1>Task Assigned</h1>

        <p>You have been assigned a new task.</p>

        <p><strong>Title:</strong> {$task->title}</p>

        <p><strong>Description:</strong> {$task->description}</p>

        <p><strong>Status:</strong> {$task->status}</p>
        "
    );
}

BrevoMailService::send(
    auth()->user()->email,
    auth()->user()->name,
    'Task Created Successfully',
    "
    <h1>Task Created</h1>

    <p>Your task was created successfully.</p>

    <p><strong>Title:</strong> {$task->title}</p>
    "
);

    return redirect("/projects/{$project->id}/tasks");
    }

    public function show(Project $project,Task $task)
    {
        
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
        
        if ($task->assignee) {

    BrevoMailService::send(
        $task->assignee->email,
        $task->assignee->name,
        'Task Updated',
        "
        <h1>Task Updated</h1>

        <p>Your assigned task has been updated.</p>

        <p><strong>Title:</strong> {$task->title}</p>

        <p><strong>Description:</strong> {$task->description}</p>

        <p><strong>Status:</strong> {$task->status}</p>
        "
    );
}

BrevoMailService::send(
    auth()->user()->email,
    auth()->user()->name,
    'Task Updated Successfully',
    "
    <h1>Task Updated</h1>

    <p>The task was updated successfully.</p>

    <p><strong>Title:</strong> {$task->title}</p>
    "
);


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

    public function completedTasks()
    {
        $tasks = Task::where('status','done')
        ->with('project:id,name')->get();

        return view('tasks.completed-tasks',compact('tasks'));
    }
}