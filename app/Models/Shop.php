<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'nom',
        'adresse',
        'description',
        'telephone',
        'user_id',
    ];

    public function users()
    {

        return $this->hasMany(User::class);
    }

    public function u()
    {

        return $this->belongsTo(User::class);
    }

    public function products()
    {

        return $this->hasMany(Product::class);
    }
}
