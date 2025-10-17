<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
        'sale_id', 'product_id', 'quantite', 'prix',
    ];

   public function sale()
    {
        return $this->belongsTo(Sale::class, 'sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function details()
    {
         return $this->hasMany(SaleDetail::class, 'sale_id', 'sale_id')
                ->whereColumn('product_id', 'product_id'); 
    }
}
