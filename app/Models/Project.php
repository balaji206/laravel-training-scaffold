<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // TODO Day 6: define relationships
    //   - tasks()    → $this->hasMany(Task::class)
    //   - owner()    → $this->belongsTo(User::class, 'user_id')
    //   - members()  → $this->belongsToMany(User::class, 'project_user')
}