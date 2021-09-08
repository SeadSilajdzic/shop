<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::create([
            'name' => 'Accepted'
        ]);

        OrderStatus::create([
            'name' => 'Declined'
        ]);

        OrderStatus::create([
            'name' => 'Pending'
        ]);
    }
}
