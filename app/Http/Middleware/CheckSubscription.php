<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        // Si l'utilisateur n'a pas d'abonnement ou que l'abonnement est expiré
        if (!$user->subscription || !$user->subscription->isActive()) {
            return redirect()->route('plans')->with('error', 'Vous devez avoir un abonnement actif pour accéder à cette fonctionnalité.');
        }
        
        return $next($request);
    }
}