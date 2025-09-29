<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Starter',
                'price' => 5000,
                'currency' => 'XAF',
                'duration_days' => 30,
            ],
            [
                'name' => 'Professional',
                'price' => 15000,
                'currency' => 'XAF',
                'duration_days' => 30,
            ],
            [
                'name' => 'Enterprise',
                'price' => 30000,
                'currency' => 'XAF',
                'duration_days' => 30,
            ],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}