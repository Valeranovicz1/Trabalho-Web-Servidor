<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function registerClient(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'nickname' => 'required|string|max:100|unique:users,nickname',
            'password' => ['required', 'confirmed', Password::min(8)], 
            'date_of_birth' => 'required|date_format:Y-m-d', 
        ]);

        try {

            $user = DB::transaction(function () use ($validatedData) {

                $user = User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'nickname' => $validatedData['nickname'],
                    'password' => Hash::make($validatedData['password']),
                    'type' => 'client', 
                ]);

                $user->client()->create([
                    'date_of_birth' => $validatedData['date_of_birth'],
                ]);

                return $user;
            });

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Cliente registrado com sucesso!',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user->load('client'), 
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro interno ao registrar cliente.'], 500);
        }
    }

    public function registerCompany(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'nickname' => 'required|string|max:100|unique:users,nickname',
            'password' => ['required', 'confirmed', Password::min(8)],
            'website' => 'nullable|url',
        ]);

        try {
            $companyUser = DB::transaction(function () use ($validatedData) {
                $user = User::create([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'nickname' => $validatedData['nickname'],
                    'password' => Hash::make($validatedData['password']),
                    'type' => 'company',
                ]);

                $user->company()->create([
                    'website' => $validatedData['website'],
                    'cnpj' => $validatedData['cnpj'],
                ]);

                return $user;
            });

            $token = $companyUser->createToken('auth_token')->plainTextToken;

            return response()->json([
                'message' => 'Empresa registrada com sucesso!',
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $companyUser->load('company'),
            ]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro interno ao registrar empresa.'], 500);
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas estão incorretas.'],
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        return response()->json([
            'message' => 'Login bem-sucedido!',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }

    
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout realizado com sucesso.']);
    }
}
