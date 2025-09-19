<?php
use App\Http\Middleware\CheckSubscription;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShopController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Models\User;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/welcome', 'employe_welcome');
Route::get('/login-register', function () {
    return view('login_register');
})->name('login');

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/login', [RegisterController::class, 'login']);

Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

Route::get('/password-forgot', function () {
    return view('password_forgot');
});
Route::post('/forgot-password', [RegisterController::class, 'forgotPassword']);

// Route::get('/dashboard', [DashboardController::class,'index'])->middleware('auth')->name('dashboard');

// Route::get('/produits', [ProductController::class,'index'])->name('produit');

Route::view('/categorie', 'categorie');
Route::post('/category', [CategoryController::class, 'store']);

Route::get('/boutique-create', function () {
    return view('shop_form');
})->name('shop.create');

Route::post('/boutique-create', [ShopController::class, 'store'])->middleware('auth');

// Route::middleware(['auth'])->group(function () {
//     Route::redirect('settings', 'settings/profile');

//     Route::get('settings/profile', Profile::class)->name('settings.profile');
//     Route::get('settings/password', Password::class)->name('settings.password');
//     Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
// });


// Route::middleware(['auth'])->group(function () {

//     Route::get('/plans', [PaymentController::class,'index'])->name('plans');
    
//     Route::post('/subscribe/{plan}', [SubscriptionController::class,'store'])->name('subscribe');

//     // Route::get('/pay', [SubscriptionController::class,'pay'])->name('pay');

//     // Route::get('/notchpay/callback', [SubscriptionController::class,'callback'])->name('notchpay.callback');

//     Route::post('/webhook/notchpay', [PaymentController::class, 'webhook']);

//     Route::post('/pay/{plan}', [PaymentController::class, 'pay'])->name('pay');

//     Route::get('/callback', [PaymentController::class, 'callback'])->name('payment.callback');
// });

Route::middleware(['auth'])->group(function () {

    Route::get('/select-boutique', [ShopController::class, 'select'])->name('shop.select');
    // Route::post('/select-boutique', [shopController::class, 'selected'])->name('shop-selected');

    // Route::post('/select-boutique', [shopController::class, 'storeSelected'])->name('shop-storeSelected');

    Route::post('/shops/select/{id}', [ShopController::class, 'selected'])->name('shop-selected');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/produits', [ProductController::class, 'index'])->name('produit');

    Route::post('/produit-create', [ProductController::class, 'store']);

    Route::get('/ventes', [SaleController::class, 'index'])->name('vente');

    Route::get('/employes', [EmployeeController::class, 'index'])->name('employee');

    Route::post('/employe-create', [EmployeeController::class, 'store'])->name('employe-store');

    Route::post('/api/sales', [SaleController::class, 'store'])->name('sales.store');

    Route::get('/parametres', [SettingController::class, 'index'])->name('setting');

});

Route::get('/fixx', function(){
    $users = User::all();
    foreach($users as $user){
        $user->shop_id = 2;
        $user->save();
    }

    return "ok";
});

require __DIR__.'/auth.php';
