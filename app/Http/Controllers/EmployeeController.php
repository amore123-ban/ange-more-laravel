<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Str;

use App\Models\Employe;

use App\Models\Shop;

use App\Models\User;

use App\Mail\EmployeeWelcomeMail;

use App\Models\Product;

use App\Models\Category;

class EmployeeController extends Controller
{
    public function index(Request $request){

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

        $employes = $shop->users()->whereRole('employe')->get(); 

        return view('employees', compact('shops', 'shop', 'cats', 'prods', 'nbprods', 'en_stock', 'faible', 'rupture','employes'));
    
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
        ]);

        $shop_id = $request->input('shop_id', session('shop_id'));
        
        $plainPassword = Str::random(10);

         $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($plainPassword),
        'role' => 'employe',
        'shop_id' => $shop_id,
    ]);

        Mail::to($user->email)->send(new EmployeeWelcomeMail($user, $plainPassword));
    
        return redirect('/employes');
    }

}
