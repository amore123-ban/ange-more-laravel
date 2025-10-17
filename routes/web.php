<?php
use App\Http\Middleware\CheckSubscription;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\ActivityLog;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StatsController;
use App\Http\Controllers\SubscriptionController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Models\User;

use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/test-pdf', function () {
    $pdf = Pdf::loadHTML('<h1>Hello, ceci est une facture test</h1>');
    return $pdf->download('facture-test.pdf');
});
Route::get('/', function () {
    return view('home');
})->name('home');

Route::view('/welcome', 'employe_welcome');

Route::get('/login-register', function () {
    return view('auth.login_register');
})->name('login');

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/login', [RegisterController::class, 'login']);

Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

Route::get('/password-forgot', function () {
    return view('password_reset');
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
                                                                                                                                                                                                                                                                                                                                                                                                                                            

Route::middleware(['auth'])->group(function () {

    Route::get('/plans', [SubscriptionController::class,'index'])->name('plans');
    
    Route::post('/subscribe/{plan}', [SubscriptionController::class,'store'])->name('subscribe');

    Route::get('/pay/{plan}', [SubscriptionController::class,'pay'])->name('pay');

    Route::get('/notchpay/callback', [SubscriptionController::class,'callback'])->name('notchpay.callback');

    Route::post('/webhook/notchpay', [PaymentController::class, 'webhook']);

    Route::post('/pay/{plan}', [PaymentController::class, 'pay'])->name('pay');

    Route::get('/callback', [PaymentController::class, 'callback'])->name('payment.callback');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/select-boutique', [ShopController::class, 'select'])->name('shop.select');

    // Route::post('/select-boutique', [shopController::class, 'selected'])->name('shop-selected');

    // Route::post('/select-boutique', [shopController::class, 'storeSelected'])->name('shop-storeSelected');

    Route::post('/shops/select/{id}', [ShopController::class, 'selected'])->name('shop-selected');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/produits', [ProductController::class, 'index'])->name('produit');

    Route::post('/produit-create', [ProductController::class, 'store'])->name('product.store');

    Route::get('/produits/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');

    Route::put('/produits/{id}', [ProductController::class, 'update'])->name('product.update');

    Route::delete('/produits/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::get('/ventes', [SaleController::class, 'index'])->name('vente');
    
    Route::post('/api/sales', [SaleController::class, 'store'])->name('sales.store');

    Route::get('/employes', [EmployeeController::class, 'index'])->name('employee');

    Route::post('/employe-create', [EmployeeController::class, 'store'])->name('employe-store');

    Route::get('/historique', [RecordController::class, 'index'])->name('historique');  

    Route::get('/facture/{sale}', [App\Http\Controllers\FactureController::class, 'show'])->name('facture.show');

    Route::post('/sales/{id}/send-invoice', [SaleController::class, 'sendInvoice'])->name('sales.sendInvoice');

    Route::get('/facture/download/{id}', [App\Http\Controllers\FactureController::class, 'downloadInvoice'])->name('facture.download');

    Route::get('/statistiques', [StatsController::class, 'index'])->name('statistique');
   
    Route::get('/parametres', [SettingController::class, 'index'])->name('setting');

    Route::get('/dashboard/data', [DashboardController::class, 'getChartData'])->name('dashboard.data');


});

Route::get('/fixx', function(){
    $users = User::all();
    foreach($users as $user){
        $user->shop_id = 2;
        $user->save();
    }

    return "ok";
});

Route::view('/vue-test', 'vue_test')->name('vue-test');

Route::post('/checkout',[PaymentController::class,'checkout'])->name('checkout');

Route::post('/notchpay/callback',[PaymentController::class,'callback'])->name('payment.callback');

Route::get('/export-logs', function () {
    $logs = ActivityLog::all();
    $csvData = "user_id,action,url,method,ip_address,details,timestamp\n";

    foreach ($logs as $log) {
        $csvData .= "{$log->user_id},{$log->action},\"{$log->url}\",{$log->method},{$log->ip_address},\"{$log->details}\",{$log->created_at}\n";
    }

    $path = base_path('scripts/activity_logs.csv');

    File::put($path, $csvData);

    return response()->download($path);
});
use App\Http\Controllers\ActivityAnalysisController;

Route::get('/activities', [ActivityAnalysisController::class, 'index']);
Route::get('/activities/{activity}', [ActivityAnalysisController::class, 'show']);


require __DIR__.'/auth.php';


