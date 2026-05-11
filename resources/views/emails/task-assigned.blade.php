

<x-mail::message>
# Task Assigned

Hello,

You have been assigned a new task.

## Task Details

**Title:** {{ $task->title }}

**Description:** {{ $task->description }}

@if($task->due_date)
**Due Date:** {{ $task->due_date }}
@endif

<x-mail::button :url="url('/projects/' . $task->project_id . '/tasks/' . $task->id)">
View Task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>