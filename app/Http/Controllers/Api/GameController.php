<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{

    public function index(Request $request)
    {
        $games = $request->user()->games()->paginate(15);

        return response()->json($games);
    }
 
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:games',
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'image' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'classification' => 'required|string|max:50',
 
        ]);

        $game = $request->user()->games()->create($validatedData);

        return response()->json($game);
    }

    public function show(Game $game)
    {
        if (Auth::id() !== $game->id_empresa) {
            return response()->json(['message' => 'Acesso não autorizado.']);
        }

        return response()->json($game);
    }

    public function update(Request $request, Game $game)
    {

        if ($request->user()->id !== $game->company_id) {
            return response()->json(['message' => 'Acesso não autorizado.']); 
        }

        $validatedData = $request->validate([
            'name' => 'required','string','max:255',
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'image' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'classification' => 'required|string|max:50',
        ]);

        $game->update($validatedData);

        return response()->json($game);
    }

    public function destroy(Request $request, Game $game)
    {

        if ($request->user()->id !== $game->id_empresa) {
            return response()->json(['message' => 'Acesso não autorizado.']);
        }

        $game->delete();

        return response()->json(null);
    }
}
