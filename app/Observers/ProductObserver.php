<?php
namespace App\Observers;

use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ProductObserver
{
    public function created(Product $product)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Ajout produit',
            'url' => request()?->fullUrl() ?? 'CLI',
            'method' => request()?->method() ?? 'CLI',
            'ip_address' => request()?->ip() ?? 'CLI',
            'details' => json_encode($product->toArray()),
        ]);
    }

    public function updated(Product $product)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Modification produit',
            'url' => request()?->fullUrl() ?? 'CLI',
            'method' => request()?->method() ?? 'CLI',
            'ip_address' => request()?->ip() ?? 'CLI',
            'details' => json_encode($product->toArray()), // On stocke toutes les infos
        ]);
    }

    public function deleted(Product $product)
    {
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Suppression produit',
            'url' => request()?->fullUrl() ?? 'CLI',
            'method' => request()?->method() ?? 'CLI',
            'ip_address' => request()?->ip() ?? 'CLI',
            'details' => json_encode($product->toArray()),
        ]);
    }
}
