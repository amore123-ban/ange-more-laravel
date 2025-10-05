<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use App\Models\Product;

use App\Models\Sale;

use App\Models\Shop;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Gestion différente selon le rôle
        if ($user->role === 'employe') {
            // Pour les employés, utiliser leur shop_id directement
            if (!$user->shop_id) {
                return redirect('/login-register')->with('error', 'Aucune boutique assignée à ce compte employé.');
            }
            
            $shop_id = $user->shop_id;
            session(['shop_id' => $shop_id]);
        } else {
            // Pour les propriétaires, vérifier la session
            if (!session()->has('shop_id')) {
                return redirect('/select-boutique')->with('error', 'Veuillez sélectionner une boutique.');
            }
            $shop_id = $request->input('shop_id', session('shop_id'));
        }

        $shop = Shop::with(['products'])->findOrFail($shop_id);

        $nbprods = Product::where('shop_id', $shop_id)->count();
        $prods = Product::where('shop_id', $shop_id)->get();
        $en_stock = $prods->filter(fn ($prod) => $prod->quantite > $prod->quantite_min)->count();
        $faible = $prods->filter(fn ($prod) => $prod->quantite <= $prod->quantite_min && $prod->quantite > 0)->count();
        $nbventes = Sale::where('shop_id', $shop_id)->count();
        $totalventes = Sale::where('shop_id', $shop_id)->sum('total');

        $sales = Sale::where('shop_id', $shop_id)->orderBy('created_at', 'desc')->get();

            $period = $request->input('period', '7');
            $dateEnd = Carbon::now()->endOfDay();

            $dateStart = match ($period) {
                '7'  => Carbon::now()->startOfDay()->subDays(6),   
                '30' => Carbon::now()->startOfDay()->subDays(29), 
                '90' => Carbon::now()->startOfDay()->subDays(89), 
                default => Carbon::now()->startOfDay()->subDays(29),
            };

            $salesByDay = Sale::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))
                ->where('shop_id', $shop_id)
                ->whereBetween('created_at', [$dateStart, $dateEnd])
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->pluck('total', 'date')
                ->toArray(); 

            $dates = [];
            $totals = [];
            for ($d = $dateStart->copy(); $d->lte($dateEnd); $d->addDay()) {
                $key = $d->format('Y-m-d');    
                $dates[] = $d->format('d/m');   
                $totals[] = isset($salesByDay[$key]) ? (float) $salesByDay[$key] : 0;
            }

            $faibles = Product::whereColumn('quantite', '<=', 'quantite_min')->where('shop_id', $shop_id)->get();

        // Choisir la vue selon le rôle
        if ($user->role === 'employe') {
            return view('dashboard.employe.dashboard', compact('shop', 'nbventes', 'en_stock', 'totalventes', 'dates', 'period', 'totals', 'nbprods', 'faibles', 'faible', 'sales'));
        } else {
            return view('dashboard.proprietaire.dashboard', compact('shop', 'nbventes', 'en_stock', 'totalventes', 'dates', 'period', 'totals', 'nbprods', 'faibles', 'sales'));
        }
    }
}
