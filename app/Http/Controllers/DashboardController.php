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

        $prods = Product::where('shop_id', $shop_id)->get();

        $en_stock = $prods->filter(fn ($prod) => $prod->quantite > $prod->quantite_min)->count();

        $nbventes = Sale::where('shop_id', $shop_id)->count();

        $totalventes = Sale::where('shop_id', $shop_id)->sum('total');

        $sales = Sale::where('shop_id', $shop_id)

        ->orderBy('created_at', 'desc')

        ->get();

        $sales = Sale::where('shop_id', $shop_id)

        ->orderBy('created_at', 'desc')

        ->get();

        $period = $request->input('period', '30'); 

        $dateStart = match ($period) {

            '7' => Carbon::now()->subDays(7),

            '30' => Carbon::now()->subDays(30),

            '90' => Carbon::now()->subMonths(3),

            default => Carbon::now()->subDays(30),
        };

        $salesByDay = Sale::select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as total'))

            ->where('shop_id', $shop_id)

            ->where('created_at', '>=', $dateStart)

            ->groupBy('date')

            ->orderBy('date', 'asc')

            ->get();

        $dates = $salesByDay->pluck('date');

        $totals = $salesByDay->pluck('total');


        $faibles = Product::whereColumn('quantite', '<=', 'quantite_min')->where('shop_id', $shop_id)->get();

        return view('dashboard.proprietaire.dashboard', compact('shop', 'nbventes', 'en_stock', 'totalventes', 'dates', 'period', 'totals', 'nbprods','faibles'));
    }
}
