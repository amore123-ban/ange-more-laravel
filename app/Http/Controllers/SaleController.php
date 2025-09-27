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

        // $cats = Category::all();

        $prods = Product::where('shop_id', $shop_id)->get();

        $nbprods = Product::where('shop_id', $shop_id)->count();

        return view('dashboard.proprietaire.sales', compact('nbprods', 'prods','shop'));
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

            foreach ($request->items as $item) {
                $sale->items()->create([
                    'product_id'    => $item['product_id'],
                    'quantite'      => $item['quantite'],
                    'prix' => $item['prix'],
                ]);

                Product::where('id', $item['product_id'])
                    ->decrement('quantite', $item['quantite']);
            }

            DB::commit();
             return response()->json([
            'success' => true,
            'message' => 'Vente enregistrée avec succès',
            'redirect' => url()->previous(), 
        ]);    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    
}
