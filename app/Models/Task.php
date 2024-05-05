<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = "task";

    protected $fillable = [
        'id','task_title','task_description','task_due_date', 'tasks_status'
    ];


    public function subtasks(){
        return $this->hasMany(Subtask::class, 'task_id', 'id');
    }
}
