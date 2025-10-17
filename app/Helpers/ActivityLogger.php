<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    /**
     * Enregistre une action dans la table activity_logs.
     */
    public static function log($action, $category = null, $description = null)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'category' => $category,
            'description' => $description,
            'ip_address' => request()->ip(),
            'status' => 'normal', // L'IA pourra le réévaluer plus tard
        ]);
    }
}
