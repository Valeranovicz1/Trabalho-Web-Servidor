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
        // Verifica se o usuário é uma empresa
        if ($request->user()->type !== 'company') {
            return response()->json(['message' => 'Acesso não autorizado.'], 403);
        }
        
        $games = Game::where('company_id', $request->user()->id)->paginate(15);
        return response()->json($games);
    }
 
    public function store(Request $request)
    {
        // Verifica se o usuário é uma empresa
        if ($request->user()->type !== 'company') {
            return response()->json(['message' => 'Acesso não autorizado.'], 403);
        }
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:games',
            'description' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'image' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'classification' => 'required|string|max:50',
        ]);

        $game = new Game();
        $game->name = $validatedData['name'];
        $game->description = $validatedData['description'];
        $game->category = $validatedData['category'];
        $game->image = $validatedData['image'] ?? null;
        $game->price = $validatedData['price'];
        $game->classification = $validatedData['classification'];
        $game->company_id = $request->user()->id;
        $game->company_user_id = $request->user()->id;
        $game->save();

        return response()->json($game, 201);
    }

    public function show(Game $game)
    {
        // Verifica se o usuário é o proprietário do jogo
        if (Auth::id() !== $game->company_id) {
            return response()->json(['message' => 'Acesso não autorizado.'], 403);
        }

        return response()->json($game);
    }

    public function update(Request $request, Game $game)
    {
        // Verificação de propriedade
        if ($request->user()->id !== $game->company_id) {
            return response()->json(['message' => 'Acesso não autorizado.'], 403);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:games,name,' . $game->id,
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
        // Verificação de propriedade
        if ($request->user()->id !== $game->company_id) {
            return response()->json(['message' => 'Acesso não autorizado.'], 403);
        }

        $game->delete();
        return response()->json(null, 204);
    }
}