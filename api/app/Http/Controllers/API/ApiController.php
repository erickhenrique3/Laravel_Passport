<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{

	public function register(Request $request): JsonResponse
	{
		
		$validatedData = $request->validate([
			"name" => "required|string",
			"email" => "required|string|email|unique:users",
			"password" => "required|confirmed" 
		]);

		User::create([
			"name" => $request->name,
			"email" => $request->email,
			"password" => bcrypt($request->password) 
		]);

		return response()->json([
			"status" => true,
			"message" => "User registered successfully",
			"data" =>  $validatedData
		]);
	}

	
	public function login(Request $request): JsonResponse
	{
		$request->validate([
			"email" => "required|email",
			"password" => "required"
		]);

		$user = User::where("email", $request->email)->first();

		if (!empty($user)) {
			if (Hash::check($request->password, $user->password)) {
				$token = $user->createToken("myToken")->accessToken;
				return response()->json([
					"status" => true,
					"message" => "Login sucessfull",
					"data" => [],
					"token" => $token
				]);
			} else {
				return response()->json([
					"status" => false,
					"message" => "Password din'd Match",
					"data" => []
				]);
			}
		} else {
			return response()->json([
				"status" => false,
				"message" => "Invalid email value",
				"data" => []
			]);
		}
	}


	public function profile(): JsonResponse {
		$userData = Auth::user();
		return response()->json([
			"status" => true,
			"message" => "profile information",
			"data" => $userData
		]);
	}
    
	public function logout(Request $request): JsonResponse {
		$request->user()->token()->revoke();

    return response()->json([
        "status" => true,
        "message" => "Usuário deslogado com sucesso"
    ]);
	}
}
