<?php

namespace App\Http\Controllers\API;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CreateTask extends Controller
{
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'nullable|exists:users,id',
            'id' => 'nullable|exists:users,id',
            'title' => 'required|string',
            'description' => 'required|string',
            'status' => 'required|string',
            'due_date' => 'required|date',
            'rate' => 'required|numeric',
        ]);
            if ($validator->fails()) {
                return response()->json([
                    "ok"=>false,
                    "msg"=>"Creating task failed. " . join(". ", $validator->errors()->all()),
                ]);
            }
            $user = DB::table('users')->where("id", $request->id);

            if ($user->doesntExist()) {
                return response()->json([
                    "ok"=>false,
                    "msg"=>"ID is invalid"
                ]);
            }
            // $user = User::find($id)->task;
            
            $user = $user ->first();
            try {
                DB::table('tasks')->insert([
                    "user_id" => $user-> id,
                    "title" => $request->title,
                    "description" => $request->description,
                    "status" => $request->status,
                    "due_date" => date("Y-m-d"),
                    "deleted" => "0",
                    "created_at" => now(),
                    "rate"=> $request->rate
                ]);

                // if (!empty($transactionResult)) {
                //     throw new Exception($transactionResult);
                // }
                // return response()->json([
                //     "ok" => true,
                //     "msg" => "Task created successfully",
                // ]);
            } catch (\Throwable $th) {
                Log::error("Failed creating task: " . $th->getMessage());
                return response()->json([
                    "ok" => false,
                    "msg" => "Creating tasks failed. An internal error occured, if it continues please contact an adminstrator",
                    "error" => [
                        "msg" => "Could not create task. {$th->getMessage()}",
                        "fix" => "Check errors for clues",
                    ]
                    ]);
            }
    }
    public function fetchUserID(){
        $user_id = DB::table('users')->select("id")
        // ->where("deleted", 0)
        ->get();
        return response()->json([
            'ok' => true,
            'data' => $user_id,
        ]);
    }
}
