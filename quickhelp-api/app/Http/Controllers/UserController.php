<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with(['soses', 'addresses', 'contacts'])->get();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name_user' => 'required|string|max:85',
            'email_user' => 'required|email|unique:user,email_user|max:85',
            'password_user' => 'required|string|min:6',
            'rule_user' => 'in:backoffice,user',
        ]);

        $validated['password_user'] = Hash::make($validated['password_user']);

        $user = User::create($validated);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::with(['soses', 'addresses', 'contacts'])->find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $user->update($request->all());

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso']);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email_user' => 'required|email',
            'password_user' => 'required'
        ]);

        $user = User::where('email_user', $request->email_user)->first();

        if (!$user || !\Illuminate\Support\Facades\Hash::check($request->password_user, $user->password_user)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'user' => $user
        ]);
    }
}
