<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|confirmed|min:6',
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'proprietaire',
        ]);

        Auth::login($user);

        return redirect('/boutique-create');
        // return redirect('/dashboqrd')->with('success', 'Inscription réussie. Connectez-vous.');
    }

   public function login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {

            return redirect('/admin-dashboard')->with('success', 'Connexion réussie');

        } elseif ($user->role === 'proprietaire') {

            return redirect('/select-boutique')->with('success', 'Connexion réussie');

        }elseif ($user->role === 'employe') {

            if ($user->shop_id) {

                return redirect()->route('dashboard', ['shop_id' => $user->shop_id])->with('success', 'Connexion réussie');

            } else {
                
                return redirect('/login-register')->with('error', 'Aucune boutique assignée à ce compte employé.');
            }
        }
    }

    return redirect('/login-register')->with('error', 'Identifiants invalides');
}

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login-register');

    }
}
