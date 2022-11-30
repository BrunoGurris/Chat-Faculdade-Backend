<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function getMessages()
    {
        try {
            $messages = Message::orderBy('id', 'asc')->get();
            return response()->json($messages, 200);
        }
        catch(Exception $e) {
            return response()->json([
                'message' => 'Não foi possivel carregar as mensagens!'
            ], 400);
        }
    }


    public function saveMessage(Request $request)
    {
        try {
            if(empty($request->message)) {
                return response()->json([
                    'message' => 'A mensagem não pode ser vazia!'
                ], 400);
            }

            $message = new Message();
            $message->user_id = Auth::id();
            $message->message = $request->message;
            $message->save();

            return response()->json($message, 201);
        }
        catch(Exception $e) {
            return response()->json([
                'message' => 'Não foi possivel salvar a mensagem!'
            ], 400);
        }
    }
}
