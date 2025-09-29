<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;

use App\Models\Employe;

use App\Models\Sale;

use App\Models\Shop;

use App\Models\User;

use App\Mail\EmployeeWelcomeMail;

use App\Models\Product;

use App\Models\Category;

class RecordController extends Controller
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

        // Choisir la vue selon le rôle
        if ($user->role === 'employe') {
            return view('dashboard.employe.historique', compact('shop', 'sales', 'nbventes', 'totalventes', 'prixMoyenVentes', 'cats', 'prods', 'nbprods', 'en_stock', 'faible', 'rupture'));
        } else {
            return view('dashboard.proprietaire.historique', compact('shops', 'sales','shop', 'nbventes', 'totalventes', 'prixMoyenVentes', 'cats', 'prods', 'nbprods', 'en_stock', 'faible', 'rupture','employes'));
        }
    }
}
