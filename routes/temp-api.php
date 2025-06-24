<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/test', function() {
    return response()->json([
        'status' => 'success',
        'message' => 'API temporária funcionando!'
    ]);
});

Route::post('/test-post', function(Request $request) {
    return response()->json([
        'status' => 'success',
        'received' => $request->all()
    ]);
});