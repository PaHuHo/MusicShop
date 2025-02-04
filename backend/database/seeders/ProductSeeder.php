<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Product::truncate();
        Schema::enableForeignKeyConstraints();

        for($i=0;$i<10;$i++){
            Product::create([
                'product_id'=>'P'.substr('0000000000',strlen($i+1)).($i+1),
                'name'=>'Product '.($i+1),
                'category_id'=>rand(1,3),
                'price'=>rand(20,100),
                'quantity'=>rand(10,100),
                'discount'=>rand(0,50),
                'description'=>'Mo ta cho san pham '.'P'.substr('0000000000',strlen($i+1)).($i+1),
            ]);
        }
    }
}
