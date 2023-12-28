<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class task extends Controller
{
    public function task_view(){
        $task = DB::table('tasks')
        ->select('title', 'description', 'due_date', 'rate', 'status', 'id')
        ->where('user_id', Auth::user()->id)
        ->where('deleted', 0)
        ->get();

        return view('tasksview' ,compact('task'));
    }
}
