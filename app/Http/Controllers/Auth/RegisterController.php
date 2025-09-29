<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'proprietaire',
        ]);

        Auth::login($user);

        return redirect('/boutique-create')->with('success', 'Inscription réussie. Créez votre boutique.');
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

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $request->email)->first();
        
        // Générer un token de réinitialisation
        $token = Str::random(64);
        
        // Stocker le token en session ou en base de données
        session(['password_reset_token' => $token, 'password_reset_email' => $request->email]);
        
        // Envoyer l'email de réinitialisation
        Mail::to($user->email)->send(new ForgotPasswordMail($token));
        
        return redirect('/password-forgot')->with('success', 'Un email de réinitialisation a été envoyé.');
    }
}
