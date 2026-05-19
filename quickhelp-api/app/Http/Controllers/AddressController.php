<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:user,id_user',
            'state_address' => 'required|string|max:85',
            'city_address' => 'required|string|max:85',
            'neighborhood_address' => 'required|string|max:85',
            'street_address' => 'required|string|max:85',
            'number_address' => 'required|string|max:20',
            'complement_address' => 'nullable|string|max:255',
        ]);

        $address = Address::create($validated);

        return response()->json(['message' => 'Endereço criado', 'address' => $address], 201);
    }

    public function index(Request $request)
    {
        $id_user = $request->query('id_user');
        $query = Address::query();
        if ($id_user) {
            $query->where('id_user', $id_user);
        }
        return response()->json($query->get());
    }

    public function update(Request $request, $id)
    {
        $address = Address::find($id);
        if (!$address) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }
        $address->update($request->all());
        return response()->json($address);
    }

    public function destroy($id)
    {
        $address = Address::find($id);
        if (!$address) {
            return response()->json(['message' => 'Endereço não encontrado'], 404);
        }
        $address->delete();
        return response()->json(['message' => 'Endereço deletado com sucesso']);
    }
}
