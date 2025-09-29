<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
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

        $cats = Category::all();
        $prods = Product::where('shop_id', $shop_id)->get();
        $nbprods = Product::where('shop_id', $shop_id)->count();
        $en_stock = $prods->filter(fn ($prod) => $prod->quantite > $prod->quantite_min)->count();
        $faible = $prods->filter(fn ($prod) => $prod->quantite <= $prod->quantite_min && $prod->quantite > 0)->count();
        $rupture = $prods->where('quantite', 0)->count();
        $nbventes = \App\Models\Sale::where('shop_id', $shop_id)->count();

        // Choisir la vue selon le rôle
        if ($user->role === 'employe') {
            return view('dashboard.employe.products', compact('shop', 'cats', 'prods', 'nbprods', 'en_stock', 'faible', 'rupture', 'nbventes'));
        } else {
            return view('dashboard.proprietaire.products', compact('shops', 'shop', 'cats', 'prods', 'nbprods', 'en_stock', 'faible', 'rupture', 'nbventes'));
        }
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Gestion différente selon le rôle
        if ($user->role === 'employe') {
            $shop_id = $user->shop_id;
            if (!$shop_id) {
                return redirect('/login-register')->with('error', 'Aucune boutique assignée à ce compte employé.');
            }
        } else {
            $shop_id = $request->input('boutique_id', session('shop_id'));
            if (!$shop_id) {
                return redirect('/select-boutique')->with('error', 'Veuillez selectionner une boutique pour ajouter un produit.');
            }
            $shop = Shop::where('user_id', Auth::id())->findOrFail($shop_id);
        }

        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'qte' => 'required|integer|min:0',
            'qte_min' => 'required|integer|min:0',
            'id_categorie' => 'required|exists:categories,id',
        ]);

        Product::create([
            'nom' => $request->name,
            'description' => $request->description,
            'prix' => $request->price,
            'quantite' => $request->qte,
            'category_id' => $request->id_categorie,
            'shop_id' => $shop_id,
            'quantite_min' => $request->qte_min,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Produit ajouté avec succès']);
        }

        return redirect('/produits')->with('success', 'Produit ajouté avec succès');
    }

    public function update(Request $request, Product $product)
    {
        $user = Auth::user();
        
        // Vérifier les permissions
        if ($user->role === 'employe') {
            if ($product->shop_id !== $user->shop_id) {
                return response()->json(['success' => false, 'message' => 'Accès non autorisé'], 403);
            }
        } else {
            $shop = Shop::where('user_id', Auth::id())->find($product->shop_id);
            if (!$shop) {
                return response()->json(['success' => false, 'message' => 'Accès non autorisé'], 403);
            }
        }

        // Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'qte' => 'required|integer|min:0',
            'qte_min' => 'required|integer|min:0',
            'id_categorie' => 'required|exists:categories,id',
        ]);

        $product->update([
            'nom' => $request->name,
            'description' => $request->description,
            'prix' => $request->price,
            'quantite' => $request->qte,
            'category_id' => $request->id_categorie,
            'quantite_min' => $request->qte_min,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Produit modifié avec succès']);
        }

        return redirect('/produits')->with('success', 'Produit modifié avec succès');
    }

    public function destroy(Product $product)
    {
        $user = Auth::user();
        
        // Vérifier les permissions
        if ($user->role === 'employe') {
            if ($product->shop_id !== $user->shop_id) {
                return response()->json(['success' => false, 'message' => 'Accès non autorisé'], 403);
            }
        } else {
            $shop = Shop::where('user_id', Auth::id())->find($product->shop_id);
            if (!$shop) {
                return response()->json(['success' => false, 'message' => 'Accès non autorisé'], 403);
            }
        }

        $product->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true, 'message' => 'Produit supprimé avec succès']);
        }

        return redirect('/produits')->with('success', 'Produit supprimé avec succès');
    }
}
