<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {        
        $validated = request()->validate([
            'name' => 'required|string|min:5|max:32|unique:users,name'
            , 'email' => 'required|email|unique:users,email'
            , 'password' => ['required', Password::min(8)->letters()->numbers()->symbols()->uncompromised()]
            , 'repeat_password' => 'required|same:password' ]);

        $user = User::create($validated);
        
        Auth::Login($user);
        return redirect()->route('products')->with('success', 'Registration successful, '. $request['name'] .'!');
    }

    public function login (Request $request)
    {
        $validated = request()->validate([
            'name' => 'required|string'
            , 'password' => 'required']);

            if (Auth::attempt($validated)) {
                $request->session()->regenerate();
                return redirect()->route('products')->with('success', 'Login successful, '. $request['name'] .'!');
            } else {
                return back()->with('error', 'Login failed, please check your credentials!');
            }

    }

    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->with('success', 'Logout successful!');
    }
}
