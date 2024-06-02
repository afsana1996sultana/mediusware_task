<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        //dd($request);
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'account_type' => 'required|in:admin,user,guest',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'account_type' => $request->account_type,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'balance' => 0, // default balance
        ]);

        // Return the newly created user
        return response()->json([
            'user' => $user
        ], 201);
    }
}
