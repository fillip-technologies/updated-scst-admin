<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shippings')->insert(
            [
                [
                    'name' => 'Standard Delivery',
                    'order_id' => 1,
                    'type' => 'regular',
                    'zone' => 'North Zone',
                    'charge' => 50.00,
                    'min_order_amount' => 500.00,
                    'estimated_time' => '3-5 Days',
                    'status' => 'active',
                    'description' => 'Standard delivery within North Zone in 3 to 5 working days.',
                ],
                [
                    'name' => 'Express Delivery',
                    'order_id' => 2,
                    'type' => 'express',
                    'zone' => 'West Zone',
                    'charge' => 120.00,
                    'min_order_amount' => 1000.00,
                    'estimated_time' => '1-2 Days',
                    'status' => 'active',
                    'description' => 'Fast express delivery within 1 to 2 days.',
                ],
                [
                    'name' => 'Same Day Delivery',
                    'order_id' => 3,
                    'type' => 'same-day',
                    'zone' => 'South Zone',
                    'charge' => 200.00,
                    'min_order_amount' => 1500.00,
                    'estimated_time' => 'Same Day',
                    'status' => 'active',
                    'description' => 'Delivery on the same day for urgent orders.',
                ],
            ]
        );
    }
}
