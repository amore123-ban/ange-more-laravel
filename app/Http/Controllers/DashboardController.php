<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        // dd(Shop::where('user_id', Auth::id())->toSql());

        // $shops=Shop::find()->where('user_id', Auth::id())->first();

        // $shops = Auth::id()->shop;

        // dd($shops);
        //   return view('dashboard', compact('shops'));
        if (! session()->has('shop_id')) {
            return redirect('/select-boutique')
                ->with('error', 'Veuillez sélectionner une boutique.');
        }

        $shop = Shop::with(['products'])
            ->findOrFail(session('shop_id'));

        $shop_id = $request->input('shop_id', session('shop_id'));

        $nbprods = Product::where('shop_id', $shop_id)->count();

        // $prods = Product::where('shop_id', $shop_id)->get();

        $faibles = Product::whereColumn('quantite', '<=', 'quantite_min')->where('shop_id', $shop_id)->get();

        return view('dashboard', compact('shop', 'nbprods','faibles'));
    }
}
