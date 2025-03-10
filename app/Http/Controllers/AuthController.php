<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {

        return rescue(function() use ($request){

            // validate the request
            $validated = $request->validate([
                'email' => 'required|string|email|exists:users,email',
                'password' => 'required|string',
            ]);

            $user = $this->userRepository->findByEmail($validated['email']);

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
            ], 400);
        });
    }

    //logout
    public function logout(Request $request)
    {
        return rescue(function() use ($request){
            $request->user()->currentAccessToken()->delete();
        }, function($e){
            return response()->json([
                'status' => true,
                'message' => $e->getMessage(),
                'meta' => [
                    '_time' => now()->timestamp
                ]
            ], 400);
        });
    }
}
