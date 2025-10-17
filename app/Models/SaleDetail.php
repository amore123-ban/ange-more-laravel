<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'category',
        'details'
    ];

    protected $casts = [
        'details' => 'array', // pour convertir automatiquement JSON <-> tableau
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function saleItem()
    {
       return $this->belongsTo(SaleItem::class, 'sale_item_id');
    }
}
