<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Helpers\ActivityLogger;

class LogActivity
{
    /**
     * Intercepte la requête et enregistre l'activité.
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // On logue seulement les requêtes critiques
        if (in_array($request->method(), ['POST', 'PUT', 'DELETE'])) {
            $action = $request->method() . ' ' . $request->path();
            $category = 'modification';
            $description = 'Utilisateur a effectué une action sur ' . $request->path();

            ActivityLogger::log($action, $category, $description);
        }

        return $response;
    }
}
