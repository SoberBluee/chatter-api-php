<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetMessageRequest;
use App\Models\Messages;
use \Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MessagesController extends Controller
{
    public function setMessage(SetMessageRequest $request){
        try{

            $messages = new Messages();

            $messages->user_sender_id = $request->input('sender');
            $messages->user_reciever_id = $request->input('reciever');
            $messages->message = $request->input('message');
            $messages->created_at = Carbon::now();
            $messages->updated_at = Carbon::now();

            $messages->save();

            return([
                'data' => $messages->toArray(),
                'message' => 'messages created successfully',
                'status' => 200,
            ]);

        }catch(\Exception $e){
            return([
                'data' => '',
                'message' => $e->getMessage,
                'status' => 400,
            ]);
        }
    }

    public function getMessages($sender){
        try{
            dd('something');
            $result_sender = DB::table('message_table')->where('user_sender_id', $sender)->get();
            $result_reciever = DB::table('message_table')->where('user_reciever_id', $sender)->get();
            return([
                'data' => array_merge($result_sender->toArray(), $result_reciever->toArray()),
                'message'=> "",
                "status" => 200,
            ]);
        }catch(\Exception $e){
            return([
                'data' => '',
                'message'=> 'failed to get messages',
                'status' => 400,
            ]);
        }

    }

    public function deleteMessages(){
        dd("del");

    }

    public function editMessage(){
        dd("edit");

    }
}
