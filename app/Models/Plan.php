<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'price',
        'currency',
        'duration_days',
        'notchpay_plan_id',
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}