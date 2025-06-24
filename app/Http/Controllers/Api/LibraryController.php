<?php
    namespace App\Http\Controllers\Api; // Atualizado

    use App\Http\Controllers\Controller; // Mantido
    use App\Models\Library;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
    {
        // GET /api/library
        public function index()
        {
            return Library::where('user_id', Auth::id())->get();
        }

        // POST /api/library
        public function store(Request $request)
        {
            $request->validate([
                'game_id' => 'required|exists:games,id'
            ]);

            return Library::create([
                'user_id' => Auth::id(),
                'game_id' => $request->game_id
            ]);
        }

        // DELETE /api/library/{id}
        public function destroy($id)
        {
            Library::where('user_id', Auth::id())
                ->findOrFail($id)
                ->delete();
                
            return response()->json(null, 204);
        }
    }