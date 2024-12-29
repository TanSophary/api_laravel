<?php

namespace App\Http\Controllers;
use DB;
use Hash;
use Illuminate\Http\Request;



class AuthController extends Controller
{
    public function register(Request $request){
        $validData = $request->validate([
            'name'      => 'required|max:40',
            'email'     => 'required|email:rfc,dns|max:50|unique:users,email',
            'password'  => 'required|max:30|min:8'
        ]);

        $result = DB::table('users')->insert([
            'name' => $validData['name'],
            'email' => $validData['email'],
            'password' => Hash::make($validData['password']),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($result) {
            return response()->json(['message' => 'Register Success', 'status' => 201], 201);
        } else {
            return response()->json(['message' => 'Register Failed', 'status' => 500], 500);
        }
    }
    public function login(){
        
    }
}
