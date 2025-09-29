<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    public function index(Request $request)
    {
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

        $prods = Product::where('shop_id', $shop_id)->get();
        $nbprods = Product::where('shop_id', $shop_id)->count();
        $nbventes = \App\Models\Sale::where('shop_id', $shop_id)->count();

        // Choisir la vue selon le rôle
        if ($user->role === 'employe') {
            return view('dashboard.employe.sales', compact('shop', 'prods', 'nbprods', 'nbventes'));
        } else {
            return view('dashboard.proprietaire.sales', compact('nbprods', 'prods','shop', 'nbventes'));
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        
        $shop_id = $request->input('shop_id', session('shop_id'));

        try {
            $sale = Sale::create([
                'client_name'   => $request->client_name,
                'montant_recu'  => $request->montant_recu,
                'mode_paiement' => $request->mode_paiement,
                'total'         => $request->total,
                'user_id'       => auth()->id(),
                'status'        => 'validée',
                'shop_id'       => $shop_id,
            ]);

            // Gérer les produits du formulaire
            $products = $request->input('products', []);
            $quantities = $request->input('quantities', []);
            
            if (!empty($products) && !empty($quantities)) {
                foreach ($products as $index => $productId) {
                    if (!empty($productId) && !empty($quantities[$index])) {
                        $product = Product::find($productId);
                        if ($product) {
                            $sale->items()->create([
                                'product_id' => $productId,
                                'quantite'   => $quantities[$index],
                                'prix'       => $product->prix,
                            ]);

                            Product::where('id', $productId)
                                ->decrement('quantite', $quantities[$index]);
                        }
                    }
                }
            }

            DB::commit();
            
            // Pour les routes API, toujours retourner du JSON
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Vente enregistrée avec succès',
                    'redirect' => route('vente'),
                ]);
            }
            
            return redirect()->route('vente')->with('success', 'Vente enregistrée avec succès');
            
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Pour les routes API, toujours retourner du JSON
            if ($request->is('api/*') || $request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
            }
            
            return redirect()->back()->with('error', 'Erreur lors de l\'enregistrement: ' . $e->getMessage());
        }
    }


    
}
