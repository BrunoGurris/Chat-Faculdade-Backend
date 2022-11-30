<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Exception;
use Illuminate\Http\Request;

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
                'message' => 'Não foi possivel carregar as mensagens'
            ], 400);
        }
    }
}
