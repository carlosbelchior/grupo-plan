<?php

namespace App\Http\Controllers;

use App\Models\Marca;

class MarcaController extends Controller
{
    // Retorna todos as marcas
    public function todos()
    {
        return response()->json(['marca' => Marca::all(), 'type' => 'data'], 200);
    }
}
