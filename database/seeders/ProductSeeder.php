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
            'S',
            'A',
            'B',
            'C',
            'M',
        ];
        $extas = [
            'Part S',
            'Part A',
            'Part B',
            'Part C',
            'Part D',
        ];

        foreach (Product::TYPE as $type) {
            # code...
            foreach ($products as $product) {
                Product::factory()->create(['name' => $product, 'type' => $type]);
            }
        }
       
        $users = User::whereRelation('roles', 'name', 'employee')->get();
        $allProducts = Product::all();

        foreach ($users as $user) {
            foreach ($allProducts as $product) {
                $uhp = UserHasProduct::create([
                    'user_id' => $user->id,
                    'product_id' => $product->id,
                    'amount' => rand(5,30)
                ]);

                $product->increment('amount', $uhp->amount);
                $product->save();
            }
        }
    }
}
