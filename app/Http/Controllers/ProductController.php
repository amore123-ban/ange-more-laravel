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

        $cats = Category::all();

        $prods = Product::where('shop_id', $shop_id)->get();

        $nbprods = Product::where('shop_id', $shop_id)->count();

        $en_stock = $prods->filter(fn ($prod) => $prod->quantite > $prod->quantite_min)->count();

        $faible = $prods->filter(fn ($prod) => $prod->quantite <= $prod->quantite_min && $prod->quantite > 0)->count();

        $rupture = $prods->where('quantite', 0)->count();

        return view('dashboard.proprietaire.products', compact('shops', 'shop', 'cats', 'prods', 'nbprods', 'en_stock', 'faible', 'rupture'));
    }

    public function store(Request $request)
    {

        $shop_id = $request->input('boutique_id', session('shop_id'));

        if (! $shop_id) {
            return redirect('/select-boutique')->with('error', 'Veuillez selectionner une boutique pour ajouter un produit.');
        }

        $shop = Shop::where('user_id', Auth::id())->findOrFail($shop_id);

        // dd($shop->nom);
        Product::create([

            'nom' => $request->name,
            'description' => $request->description,
            'prix' => $request->price,
            'quantite' => $request->qte,
            'category_id' => $request->id_categorie,
            'shop_id' => $shop->id,
            'quantite_min' => $request->qte_min,

        ]);

        return redirect('/produits')->with('success', 'produits ajoute avec success');

    }
}
