<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityAnalysisController extends Controller
{
    // Affiche la liste des logs et leur prédiction
    public function index()
    {
        $logs = ActivityLog::latest()->get();

        // Boucle pour prédire chaque action via le script Python
        foreach ($logs as $log) {
            $command = escapeshellcmd("python3 " . base_path("scripts/predict_activity.py") . " {$log->user_id} {$log->method}");
            $prediction = shell_exec($command);
            $log->predicted_action = trim($prediction);
        }

        return view('dashboard.proprietaire.index', compact('logs'));
    }

    // Voir les détails d’un log
    public function show(ActivityLog $activity)
    {
        return view('dashboard.proprietaire.show', compact('activity'));
    }
}
