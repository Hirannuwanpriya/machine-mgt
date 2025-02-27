<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        return rescue(function() use ($request){

            // validate the request
            $validated = $request->validate([
                'email' => 'required|string|email|exists:users,email',
                'password' => 'required|string',
            ]);

            $user = (new User())->newQuery()->where('email', $validated['email'])->first();

            throw_if(!$user || ! Hash::check($validated['password'], $user->password), 'Invalid Password');

            $token = $user->createToken("auth");
        
            return response()->json([
                'status' => true,
                'payload' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'token' => $token->plainTextToken
                ],
                'meta' => [
                    '_time' => now()->timestamp
                ]
            ]);

        }, function($e){
            return response()->json([
                'status' => true,
                'message' => $e->getMessage(),
                'meta' => [
                    '_time' => now()->timestamp
                ]
            ]);
        });




        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }
}
