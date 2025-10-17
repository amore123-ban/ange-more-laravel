<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;

use App\Models\Employe;

use App\Models\Sale;

use App\Models\SaleItem;

use App\Models\Shop;

use App\Models\User;

use App\Mail\EmployeeWelcomeMail;

use App\Models\Product;

use App\Models\Category;

class StatsController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        
        // Gestion différente selon le rôle
        if ($user->role === 'employe') {
            if (!$user->shop_id) {
                return redirect('/login-register')->with('error', 'Aucune boutique assignée à ce compte employé.');
            }
            $shop_id = $user->shop_id;
            session(['shop_id' => $shop_id]);
            $shop = Shop::with(['products'])->findOrFail($shop_id);
        } else {
            $shops = Auth::user()->shops;
            $shop_id = $request->input('shop_id', session('shop_id'));

            if ($shop_id) {
                $shop = Shop::with(['products'])
                    ->where('user_id', Auth::id())
                    ->findOrFail($shop_id);
                session(['shop_id' => $shop->id]);
            } else {
                $shop = null;
            }
        }

        $cats = Category::all();

        $prods = Product::where('shop_id', $shop_id)->get();

        $nbprods = Product::where('shop_id', $shop_id)->count();

        $en_stock = $prods->filter(fn ($prod) => $prod->quantite > $prod->quantite_min)->count();

        $faible = $prods->filter(fn ($prod) => $prod->quantite <= $prod->quantite_min && $prod->quantite > 0)->count();

        $rupture = $prods->where('quantite', 0)->count();

        $employes = User::where('shop_id', $shop_id)->where('role', 'employe')->get(); 

        $sales = Sale::where('shop_id', $shop_id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        $nbventes = Sale::where('shop_id', $shop_id)->count();
        $totalventes = Sale::where('shop_id', $shop_id)->sum('total');
        $prixMoyenVentes = Sale::where('shop_id', $shop_id)->avg('total');


         $chiffreAffaire = Sale::where('shop_id', $shop_id)->sum('total');

        $produitsEnStock = Product::where('shop_id', $shop_id)->sum('stock');

        $nouveauxClients = User::where('role', 'client')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $annee = now()->year;

        $ventesMensuelles = Sale::select(
                DB::raw("strftime('%m', created_at) as mois"),
                DB::raw('SUM(total) as total')
            )
            ->where('shop_id', $shop_id)
            ->whereRaw("strftime('%Y', created_at) = ?", [$annee])
            ->groupBy('mois')
            ->orderBy('mois')
            ->get();

        $labels = [];
        $data = [];
        foreach ($ventesMensuelles as $vente) {
            $labels[] = date('M', mktime(0, 0, 0, $vente->mois, 1));
            $data[] = $vente->total;
        }


       $produitsTop = SaleItem::select(
                'products.nom',
                DB::raw('SUM(sale_items.quantite) as total_vendus')
            )
            ->join('products', 'sale_items.product_id', '=', 'products.id')
            ->join('sales', 'sale_items.sale_id', '=', 'sales.id')
            ->where('sales.shop_id', $shop_id)
            ->groupBy('products.nom')
            ->orderByDesc('total_vendus')
            ->limit(5)
            ->get();

      
        // Choisir la vue selon le rôle
        if ($user->role === 'employe') {
            return view('dashboard.employe.stats', compact('shop', 'chiffreAffaire','produitsEnStock','nouveauxClients','labels','data','produitsTop', 'sales', 'nbventes', 'totalventes', 'prixMoyenVentes', 'cats', 'prods', 'nbprods', 'en_stock', 'faible', 'rupture'));
        } else {
            return view('dashboard.proprietaire.stats', compact('shop', 'chiffreAffaire','produitsEnStock','nouveauxClients','labels','data','produitsTop','shops', 'sales','shop', 'nbventes', 'totalventes', 'prixMoyenVentes', 'cats', 'prods', 'nbprods', 'en_stock', 'faible', 'rupture','employes'));
        }
    }

}