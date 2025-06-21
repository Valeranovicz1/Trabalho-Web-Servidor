<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{

    public function show(Request $request)
    {
        $user = $request->user()->load('company');
        
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
            'website' => 'required|string|max:255', 
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
        
                $user->company()->update([
                    'website' => $data['website'],
                ]);
            });
        } catch (\Exception $e) {

            return response()->json(['message' => 'Ocorreu um erro inesperado ao salvar. Tente novamente.']);
        }

        return response()->json([
            'message' => 'Perfil atualizado com sucesso!',
            'user' => $user->fresh()->load('company')
        ]);
    
    }

}
