<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|exists:roles,name',
            'address' => 'string|max:255|nullable',
            'phone_number' => 'string|max:15|nullable',
            'date_of_birth' => 'date|nullable',
            'verified' => 'boolean|nullable',
            'followers' => 'integer|nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $role = Role::where('name', $request->role)->first();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $role->id,
            'username'=> $request->username
        ]);

        $user->userDetails()->create([
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'date_of_birth' => $request->date_of_birth,
            'verified' => $request->verified,
            'followers' => $request->followers,
        ]);

        $token = $user->createToken('LaravelAuthApp')->accessToken;

        return response()->json(['token' => $token], 200);
    }

  
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $request->email, 'password' => $request->password];
        } else {
            $credentials = ['name' => $request->email, 'password' => $request->password];
        }
    
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $tokenResult = $user->createToken('LaravelAuthApp');
            $token = $tokenResult->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    
}
