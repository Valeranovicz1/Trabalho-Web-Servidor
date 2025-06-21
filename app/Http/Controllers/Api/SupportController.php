<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{

    public function index()
    {
        
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'message' => 'required|string|max:255|unique:games'
        ]);

        $support = $request->user()->support()->create($validatedData);

        return response()->json($support);
    }

    public function show(Support $support)
    {
        return response()->json($support);
    }

}
