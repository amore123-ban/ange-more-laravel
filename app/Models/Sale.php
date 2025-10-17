<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['client_name','client_email','montant_recu','mode_paiement','user_id', 'total', 'status','shop_id'];

    public function items()
    {
        return $this->hasMany(SaleItem::class, 'sale_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function shop()
    {
        return $this->belongsTo(Shop::class);
    }
    public function details()
    {
        return $this->hasMany(SaleDetail::class);
    }

}
