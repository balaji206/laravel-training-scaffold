<x-mail::message>
# Task Updated

Hello,

A task has been updated successfully.

## Task Details

**Title:** {{ $task->title }}

**Description:** {{ $task->description }}

**Status:** {{ $task->status }}

<x-mail::button :url="url('/projects/' . $task->project_id . '/tasks/' . $task->id)">
View Task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>