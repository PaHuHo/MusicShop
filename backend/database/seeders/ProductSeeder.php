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
        // Schema::disableForeignKeyConstraints();
        // Product::truncate();
        // Schema::enableForeignKeyConstraints();

        for($i=0;$i<10;$i++){
            Product::create([
                'product_id'=>'SP'.substr('0000000000',strlen($i+1)).($i+1),
                'name'=>'Sản phẩm '.($i+1),
                'category_id'=>rand(0,1),
                'price'=>rand(20,100),
                'quantity'=>rand(10,100),
                'description'=>'Mo ta cho san pham '.'SP'.substr('0000000000',strlen($i+1)).($i+1),
            ]);
        }
    }
}
