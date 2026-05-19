<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_message' => 'required|string|max:85',
            'email_message' => 'required|email|max:85',
            'message_message' => 'required|string|max:500',
        ]);

        $message = Message::create($validated);

        return response()->json(['message' => 'Mensagem enviada com sucesso!', 'data' => $message], 201);
    }

    public function index()
    {
        $messages = Message::orderBy('date_message', 'desc')->get();
        return response()->json($messages);
    }

    public function destroy($id)
    {
        $message = Message::find($id);
        if ($message) {
            $message->delete();
            return response()->json(['message' => 'Mensagem apagada']);
        }
        return response()->json(['message' => 'Não encontrada'], 404);
    }
}
