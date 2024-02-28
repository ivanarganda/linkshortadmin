<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('form.login');
    }
    
    public function login(Request $request)
    {
        // Validation rules for email and password
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'password' => 'required',
        ]);

        // If validation fails, return back with errors  
        if ($validator->fails()) { 
            return back()->withErrors($validator)->withInput();
        }
    
        $user = User::where('email', $request->email)->first();

        if ($user->type != 'admin') {
            return back()->withErrors(['admin' => 'Unauthorized access due not to admin user']);
        }

        if ($user && $user->password === base64_encode($request->password)) {
            Auth::login($user); // Log in the user
            return redirect()->intended('/');
        } else {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }
    
    }

    public function logout()
    {
         Auth::logout();
         return redirect()->intended('/');
    }

}
