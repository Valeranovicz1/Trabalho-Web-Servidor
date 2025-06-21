<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{

     public function show(Request $request){

        $user = $request->user()->load('client');
        
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'          => 'required|string|max:255',
            'nickname'      => ['required', 'string', 'max:100', Rule::unique('users')->ignore($user->id)],
            'email'         => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password'      => 'nullable|confirmed|min:8',
            'date_of_birth' => 'required|date:Y-m-d', 
        ]);

        try {
            
            DB::transaction(function () use ($user, $data) {
                
                $user->update([
                    'name' => $data['name'],
                    'nickname' => $data['nickname'],
                    'email' => $data['email'],
                ]);

                if (!empty($data['password'])) {
                    $user->password = Hash::make($data['password']);
                    $user->save(); 
                }
        
                $user->client()->update([
                    'date_of_birth' => $data['date_of_birth'],
                ]);
            });
        } catch (\Exception $e) {

            return response()->json(['message' => 'Ocorreu um erro inesperado ao salvar. Tente novamente.']);
        }

        return response()->json([
            'message' => 'Perfil atualizado com sucesso!',
            'user' => $user->fresh()->load('client')
        ]);
    
    }

}
