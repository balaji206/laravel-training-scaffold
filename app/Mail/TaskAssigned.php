<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;



class TaskAssigned extends Mailable implements ShouldQueue   
{
    use Queueable, SerializesModels;
    
    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'You\'ve been assigned: ' . $this->task->title);
    }

    public function content(): Content
    {
        return new Content(markdown: 'emails.task-assigned',
        with:['task' => $this->task]);
    }

    public function attachments(): array
    {
        return [];
    }
}