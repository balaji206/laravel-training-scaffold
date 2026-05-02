<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index($project)
    {
        // TODO Day 5: return view('tasks.index', ['tasks' => $project->tasks]);
        // TODO Day 6: eager load — $project->load('tasks.comments', 'tasks.assignee');
        
       // abort(501, 'TODO Day 5 — implement task index');
        $tasks = [
            ['id' => 1, 'title' => 'Task 1', 'status' => 'Pending'],
            ['id' => 2, 'title' => 'Task 2', 'status' => 'Completed']
        ];

        return view('tasks.index', compact('tasks', 'project'));
    }

    public function create(Project $project)
    {
        // TODO Day 5: return view('tasks.create', ['project' => $project]);
          return view('tasks.create', compact('project'));
        //abort(501, 'TODO Day 5 — implement task create');
    }

    public function store(Request $request, Project $project)
    {
        // TODO Day 5: $project->tasks()->create([...]);
        // TODO Day 7: use StoreTaskRequest
        // TODO Day 11: handle file upload — Storage::disk('public')->put(...)
        abort(501, 'TODO Day 5 — implement task store');
    }

    public function show($project, $task)
    {
        // TODO Day 5: return view('tasks.show', ['task' => $task]);
        //abort(501, 'TODO Day 5 — implement task show');
        //return 'task ' . $task . ' of project ' . $project;
         $task = [
            'id' => $task,
            'title' => 'Task ' . $task,
            'description' => 'Sample description',
            'status' => 'Pending'
        ];

        return view('tasks.show', compact('task', 'project'));
    }

    public function edit(Task $task)
    {
        // TODO Day 5: return view('tasks.edit', ['task' => $task]);
        // TODO Day 9: $this->authorize('update', $task);
        // abort(501, 'TODO Day 5 — implement task edit');
        $task = [
            'id' => $task,
            'title' => 'Task ' . $task,
            'description' => 'Sample description',
            'status' => 'Pending'
        ];

        return view('tasks.edit', compact('task', 'project'));
    }

    public function update(Request $request, Task $task)
    {
        // TODO Day 5: $task->update([...]);
        // TODO Day 7: use UpdateTaskRequest
        // TODO Day 9: $this->authorize('update', $task);
        // TODO Day 11: when assigned_to_id changes, dispatch TaskAssigned mail (queued)
        abort(501, 'TODO Day 5 — implement task update');
    }

    public function destroy(Task $task)
    {
        // TODO Day 5: $task->delete();
        // TODO Day 9: $this->authorize('delete', $task);
        abort(501, 'TODO Day 5 — implement task destroy');
    }
}