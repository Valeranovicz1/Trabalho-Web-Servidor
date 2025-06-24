<?php


namespace App\Http\Controllers\Api; // Atualizado

use App\Http\Controllers\Controller; // Mantido
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // GET /api/cart
public function index()
{
    $cartItems = Cart::where('user_id', auth()->id())
                    ->with('game') // Carrega os dados do jogo
                    ->get();
    
    return response()->json([
        'status' => 'success',
        'data' => $cartItems
    ]);
}

    // POST /api/cart
public function store(Request $request)
{

    $request->validate(['game_id' => 'required|exists:games,id']);
    
    $cartItem = Cart::create([
        'user_id' => auth()->id(),
        'game_id' => $request->game_id
    ]);

    // Carregue o relacionamento com o jogo
    $cartItem->load('game');

    return response()->json([
        'status' => 'success',
        'data' => $cartItem
    ], 201);
}


    // DELETE /api/cart/{id}
    public function destroy($id)
    {
        Cart::where('user_id', Auth::id())
            ->findOrFail($id)
            ->delete();
            
        return response()->json(null, 204);
    }
}