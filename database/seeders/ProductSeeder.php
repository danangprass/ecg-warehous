<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\UserHasProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Engine S',
                'type' => 'engine',
                'price' => 100
            ],
            [
                'name' => 'Body S',
                'type' => 'body',
                'price' => 100
            ],
            [
                'name' => 'Extra Part S',
                'type' => 'extra',
                'price' => 100
            ],
            [
                'name' => 'Engine A',
                'type' => 'engine',
                'price' => 75
            ],
            [
                'name' => 'Body A',
                'type' => 'body',
                'price' => 75
            ],
            [
                'name' => 'Extra Part A',
                'type' => 'extra',
                'price' => 75
            ],
            [
                'name' => 'Engine B',
                'type' => 'engine',
                'price' => 75
            ],
            [
                'name' => 'Body B',
                'type' => 'body',
                'price' => 75
            ],
            [
                'name' => 'Extra Part B',
                'type' => 'extra',
                'price' => 75
            ],
            [
                'name' => 'Engine C',
                'type' => 'engine',
                'price' => 75
            ],
            [
                'name' => 'Body C',
                'type' => 'body',
                'price' => 75
            ],
            [
                'name' => 'Extra Part C',
                'type' => 'extra',
                'price' => 75
            ],
            [
                'name' => 'Engine M',
                'type' => 'engine',
                'price' => 75
            ],
            [
                'name' => 'Body M',
                'type' => 'body',
                'price' => 75
            ],
            [
                'name' => 'Extra Part M',
                'type' => 'extra',
                'price' => 75
            ]
        ];

        foreach ($products as $product) {
            Product::factory()->create($product);
        }
        // $products = [
        //     'S',
        //     'A',
        //     'B',
        //     'C',
        //     'M',
        // ];
        // $extas = [
        //     'Part S',
        //     'Part A',
        //     'Part B',
        //     'Part C',
        //     'Part D',
        // ];

        // foreach (Product::TYPE as $type) {
        //     foreach ($products as $product) {
        //         if ($type == 'extra') {
        //             Product::factory()->create(['name' => ucfirst($type . ' Part ' . $product), 'type' => $type]);
        //         } else {
        //             Product::factory()->create(['name' => ucfirst($type . ' ' . $product), 'type' => $type]);
        //         }
        //     }
        // }

        $users = User::all();
        $allProducts = Product::all();

        foreach ($users as $user) {
            foreach ($allProducts as $product) {
                $uhp = UserHasProduct::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'amount' => rand(5, 30)
                ]);

                $product->increment('amount', $uhp->amount);
                $product->save();
            }
        }
    }
}
