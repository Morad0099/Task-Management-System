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
            // 'id' => 'nullable|exists:users,id',
            // 'id' => 'nullable|exists:users,id',
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'due_date' => 'required',
            'rate' => 'required',
        ]);
            if ($validator->fails()) {
                return response()->json([
                    "ok"=>false,
                    "msg"=>"Creating task failed. " . join(". ", $validator->errors()->all())
                ]);
            }
            try {
                DB::table('tasks')->insert([
                    "user_id" => $request-> user_id,
                    "title" => $request->title,
                    "description" => $request->description,
                    "status" => $request->status,
                    "due_date" => $request->due_date,
                    "deleted" => "0",
                    "created_at" => now(),
                    "rate"=> $request->rate
                ]);

                // if (!empty($transactionResult)) {
                //     throw new Exception($transactionResult);
                // }
                return response()->json([
                    "ok" => true,
                    "msg" => "Task created successfully",
                ]);
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

    public function edit_task(Request $request){
        $validator = Validator::make(
            $request->all(),[
                'desc' => 'required'
            ]
            );

            if ($validator->fails()) {
                return response()->json([
                    "ok" => false,
                    "msg" => "Update failed. Please complete all required fields",
                    "error" => [
                        "msg" => "Some required fields are missing: " . join(" ", $validator->errors()->all()),
                        "fix" => "Please complete all required fields",
                    ]
                ]);
            }

            try {
                DB::table('tasks')->where('id', $request->id)
                ->update(['description' => $request->desc]);

                return response()->json([
                    'ok' => true,
                    'msg' => 'Successfully edited task'
                ]);
            } catch (Exception $e) {
                Log::error("Failed editing task: " . $e->getMessage());
                return response()->json([
                    "ok" => false,
                    "msg" => "Editing task failed. An internal error occured, if it continues please contact an adminstrator",
                    "error" => [
                        "msg" => "Could not create task. {$e->getMessage()}",
                        "fix" => "Check errors for clues",
                    ]
                    ]);
            }
    }

    public function delete_task($id){
        DB::table('tasks')->where('id', $id)
        ->update(['deleted' => 1]);

        return response()->json([
            'ok' => true,
            'msg' => 'Task deleted successfully'
        ]);
    }
}
