<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display the login form
     */
    public function login_show() {
        return view('login');
    }

    /**
     * Handle account login request
     */
    public function login(Request $request) {
        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required'],        
        ]);         
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();             
            return redirect()->intended();        
        }         
        
        return back()->withErrors([            '
            name' => 'Les informations renseignées sont erronées.',        
        ])->onlyInput('name');   
    }
    
    /**
     * Handle account logout request
     */
    public function logout(Request $request) {    
        Auth::logout();     
        $request->session()->invalidate();     
        $request->session()->regenerateToken();     
        return redirect('/');
    }

    /**
     * Create user
     */
    public function createUser($name, $password) {
        $user = new User();
        $user->password = Hash::make($password);
        $user->email = $name.'@gmail.com';
        $user->name = $name;
        $user->save();

        if ($user->save())
            echo "Créé";
        else 
            echo "Non créé";
    }
}
