<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subtask;

class SubtaskController extends Controller
{
    public function search(Request $request) {
        $search = $request->input('search');
        if($search){
            $subtasks = Subtask::with('task')->where('task_id', 'like', '%'.$search.'%')->get();
        } else {
            $subtasks = Subtask::all();
        }
        return response()->json($subtasks);  
    }

    public function showAllSubtask(){
        return response()->json(Subtask::with('task')->orderBy("id", "desc")->get());
    }

    public function showTaskId($task_id){
        return response()->json(Subtask::with('task')->where('task_id', $task_id)->get());
    }

    public function registerSubtask(Request $request){

        $subtask = new Subtask;
        $subtask->subtasktitle = $request->subtasktitle;      
        $subtask->subtaskdescription = $request->subtaskdescription;                
        $subtask->task_id = $request->task_id;   
               
        $subtask->save();
        return response()->json($subtask);
    }

    public function showSubtask($id){
        return response()->json(Subtask::find($id));
    }

    public function updateSubtask($id, Request $request){
        $subtask = Subtask::find($id);
        $subtask->subtasktitle = $request->subtasktitle;        
        $subtask->subtaskdescription = $request->subtaskdescription;      
                 
        $subtask->save();

        return response()->json($subtask);
    }

    public function updateSubtaskStatus($id, Request $request){
        $subtask = Subtask::find($id);                        
        $subtask->subtaskstatus = $request->subtaskstatus;  
                 
        $subtask->save();

        return response()->json($subtask);
    }

    public function deleteSubtask($id){
        $subtask = Subtask::find($id);
        $subtask->delete();
        return response()->json("deleted successfully", 200);
    }
}
