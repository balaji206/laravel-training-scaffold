<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Resources\TaskResource;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $tasks = Task::whereHas('project', function ($query) {
        $query->where('user_id', auth()->id());
    })->get();

    return TaskResource::collection($tasks);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'project_id' => $request->project_id,
            'assigned_to_id' => $request->assigned_to_id,
        ]);

        return new TaskResource($task);
        //

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
        if($task->project->user_id != auth()->id()){
            return response()->json([
                'message' => 'You are not authorized to perform this action',
            ], 403);
        }

    

    return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request,Task $task)
    {
        //
        if($task->project->user_id != auth()->id()){
            return response()->json([
                'message' => 'You are not authorized to perform this action',
            ], 403);
        }
        $task->update(
            [
                'title' => $request->title ?? $task->title,
                'description' => $request->description ?? $task->description,
                'status' => $request->status ?? $task->status,
            ]
        );
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        if($task->project->user_id != auth()->id()){
            return response()->json([
                'message' => 'You are not authorized to perform this action',
            ], 403);
        }
        $task->delete();
        return response()->json([
            'message' => 'Task deleted successfully',
        ]);
    }
}
