<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('plans', compact('plans'));
    }

    public function store(Request $request, Plan $plan)
    {
        $user = Auth::user();
        
        // Vérifier si l'utilisateur a déjà un abonnement actif
        if ($user->subscription && $user->subscription->isActive()) {
            return redirect()->back()->with('error', 'Vous avez déjà un abonnement actif.');
        }

        // Créer l'abonnement
        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'status' => 'trial',
            'starts_at' => now(),
            'ends_at' => now()->addDays($plan->duration_days),
        ]);

        return redirect()->route('pay', $plan)->with('success', 'Abonnement créé. Procédez au paiement.');
    }

    public function pay(Plan $plan)
    {
        $user = Auth::user();
        
        return view('payment', compact('plan', 'user'));
    }

    public function callback(Request $request)
    {
        // Vérifier le paiement avec NotchPay
        // Mettre à jour le statut de l'abonnement
        
        return redirect()->route('dashboard')->with('success', 'Paiement effectué avec succès !');
    }
}