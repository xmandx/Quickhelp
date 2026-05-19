<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:user,id_user',
            'name_contact' => 'required|string|max:85',
            'phone_contact' => 'required|string|max:20',
        ]);

        $contact = Contact::create($validated);

        return response()->json(['message' => 'Contato criado', 'contact' => $contact], 201);
    }

    public function index(Request $request)
    {
        $id_user = $request->query('id_user');
        $query = Contact::query();
        if ($id_user) {
            $query->where('id_user', $id_user);
        }
        return response()->json($query->get());
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return response()->json(['message' => 'Contato não encontrado'], 404);
        }
        $contact->update($request->all());
        return response()->json($contact);
    }

    public function destroy($id)
    {
        $contact = Contact::find($id);
        if (!$contact) {
            return response()->json(['message' => 'Contato não encontrado'], 404);
        }
        $contact->delete();
        return response()->json(['message' => 'Contato deletado com sucesso']);
    }
}
