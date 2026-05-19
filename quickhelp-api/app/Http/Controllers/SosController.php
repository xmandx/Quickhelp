<?php

namespace App\Http\Controllers;

use App\Models\Sos;
use Illuminate\Http\Request;

class SosController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:user,id_user'
        ]);

        $sos = Sos::create([
            'id_user' => $request->id_user
        ]);

        return response()->json(['message' => 'SOS enviado com sucesso!', 'sos' => $sos], 201);
    }

    public function index()
    {
        $soses = Sos::with('user')->orderBy('date_sos', 'desc')->get();
        return response()->json($soses);
    }
}
